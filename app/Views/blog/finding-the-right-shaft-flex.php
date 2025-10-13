<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section" style="margin-top: 120px;">
    <div class="container" style="max-width: 900px;">
        <!-- Back to Blog -->
        <div style="margin-bottom: 2rem;">
            <a href="<?= base_url('/blog') ?>" style="color: var(--deep-green); text-decoration: none; font-weight: 600;">← Back to Blog</a>
        </div>
        
        <!-- Audio Player - Fixed Below Header -->
        <div id="audioPlayerSticky" style="position: fixed; top: 80px; left: 0; right: 0; z-index: 500; background: linear-gradient(135deg, var(--deep-green), #0a5a42); padding: 0.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3); max-width: 100vw;">
            <div style="max-width: 900px; margin: 0 auto;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <span style="font-size: 1.2rem;">🎧</span>
                    <h3 style="color: white; margin: 0; font-size: 0.9rem;">Listen to Article</h3>
                </div>
                <audio id="blogAudio" controls preload="auto" style="width: 100%; margin-bottom: 0.5rem; max-width: 100%;">
                    <source src="<?= base_url('serve-audio.php?file=Finding the Right Shaft Flex.mp3') ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <button onclick="setPlaybackSpeed(1)" style="background: white; color: var(--deep-green); border: none; padding: 0.3rem 0.7rem; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 0.85rem;">1x</button>
                    <button onclick="setPlaybackSpeed(1.5)" style="background: white; color: var(--deep-green); border: none; padding: 0.3rem 0.7rem; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 0.85rem;">1.5x</button>
                    <button onclick="setPlaybackSpeed(2)" style="background: white; color: var(--deep-green); border: none; padding: 0.3rem 0.7rem; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 0.85rem;">2x</button>
                </div>
            </div>
        </div>
        
        <!-- Spacer to prevent content from hiding under fixed player -->
        <div style="height: 140px;"></div>
        
        <!-- Article Meta (not in audio) -->
        <div style="color: #666; font-size: 1.1rem; margin-bottom: 2rem; text-align: center;">
            <p style="margin: 0;">Published <?= date('F j, Y', strtotime($post['date'])) ?> • <?= $post['read_time'] ?></p>
        </div>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Finding the Right Shaft Flex.mp3.json') ?>')
                .then(response => response.json())
                .then(data => {
                    // This JSON has segments with words inside
                    let allWordsFromSegments = [];
                    
                    if (data.segments && data.segments.length > 0) {
                        // Extract all words from all segments
                        data.segments.forEach(segment => {
                            if (segment.words) {
                                allWordsFromSegments = allWordsFromSegments.concat(segment.words);
                            }
                        });
                    }
                    
                    if (allWordsFromSegments.length > 0) {
                        // Filter out spaces and newlines, convert start_time/end_time to start/end
                        allWords = allWordsFromSegments
                            .filter(w => w.text && w.text.trim().length > 0 && w.text !== ' ' && w.text !== '\n')
                            .map(w => ({
                                text: w.text,
                                start: w.start_time || w.start,
                                end: w.end_time || w.end
                            }));
                        console.log('Loaded', allWords.length, 'aligned words (filtered out spaces)');
                        
                        // Wrap blog text with spans for highlighting
                        wrapBlogTextWithSpans();
                    } else {
                        console.error('No words found in alignment JSON');
                    }
                })
                .catch(err => console.error('Error loading timestamps:', err));
            
            function wrapBlogTextWithSpans() {
                const container = document.querySelector('.container');
                // Include h1, h2, p, and li elements ONLY from article tag
                const article = container.querySelector('article');
                const textElements = article.querySelectorAll('h1, h2, h3, p, li');
                
                // Get the audio player div to completely skip it
                const audioPlayer = document.querySelector('#audioPlayerSticky');
                
                // GLOBAL word counter across ALL elements
                let globalWordIndex = 0;
                
                textElements.forEach(element => {
                    // Skip if:
                    // - Already wrapped
                    // - Inside the audio player div
                    // - Inside a button
                    // - Contains buttons or phone links
                    // - Is a link (Back to Blog)
                    // - Inside CTA section
                    if (element.querySelector('.word-highlight') || 
                        audioPlayer.contains(element) ||
                        element.closest('a') ||
                        element.querySelector('a') ||
                        element.closest('button') ||
                        element.querySelector('button') ||
                        element.querySelector('a[href*="tel:"]')) {
                        return;
                    }
                    
                    const text = element.textContent;
                    // Remove the bullet/dot separator (•) that's not spoken
                    const cleanText = text.replace(/•/g, '');
                    const words = cleanText.split(/\s+/); // Split on spaces but don't keep them
                    
                    element.innerHTML = '';
                    words.forEach((word, index) => {
                        if (word.trim()) { // Only wrap non-empty words
                            const span = document.createElement('span');
                            span.textContent = word;
                            span.className = 'word-highlight';
                            span.style.cursor = 'pointer';
                            span.setAttribute('data-word-index', globalWordIndex);
                            element.appendChild(span);
                            globalWordIndex++; // Increment GLOBAL counter
                            
                            // Add space after word (except last word)
                            if (index < words.length - 1) {
                                element.appendChild(document.createTextNode(' '));
                            }
                        }
                    });
                });
            
            wordElements = Array.from(document.querySelectorAll('.word-highlight'));
            console.log('Wrapped', wordElements.length, 'word elements');
            
            // Add click-to-seek functionality
            wordElements.forEach((element) => {
                element.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const wordIndex = parseInt(element.getAttribute('data-word-index'));
                    if (!isNaN(wordIndex) && allWords[wordIndex]) {
                        const seekTime = allWords[wordIndex].start;
                        
                        // Check if audio has metadata loaded (readyState >= 2)
                        if (audio.readyState >= 2) {
                            // Has at least metadata and first frames - can seek
                            audio.currentTime = seekTime;
                            if (audio.paused) {
                                audio.play();
                            }
                        } else {
                            // Wait for loadeddata event (Safari compatibility)
                            const onReady = function() {
                                audio.removeEventListener('loadeddata', onReady);
                                audio.currentTime = seekTime;
                                audio.play();
                            };
                            audio.addEventListener('loadeddata', onReady);
                        }
                        
                        // Reset highlight state
                        lastWordIndex = -1;
                        wordElements.forEach(el => el.classList.remove('active-word'));
                    }
                });
            });
        }
            
            // Word-by-word highlighting with JSON timestamps
            const audio = document.getElementById('blogAudio');
            let isPlaying = false;
            let lastWordIndex = -1;
            
            // Use requestAnimationFrame for smooth 60fps updates
            function tick() {
                if (!isPlaying || allWords.length === 0 || wordElements.length === 0) {
                    if (isPlaying) requestAnimationFrame(tick);
                    return;
                }
                
                const currentTime = audio.currentTime;
                
                // Find current word being spoken
                let currentWordIndex = -1;
                for (let i = 0; i < allWords.length; i++) {
                    if (currentTime >= allWords[i].start && currentTime <= allWords[i].end) {
                        currentWordIndex = i;
                        break;
                    }
                }
                
                // Update highlighting if word changed
                if (currentWordIndex !== lastWordIndex && currentWordIndex !== -1) {
                    // Remove previous highlight
                    if (lastWordIndex !== -1 && wordElements[lastWordIndex]) {
                        wordElements[lastWordIndex].classList.remove('active-word');
                    }
                    
                    // Add new highlight
                    if (wordElements[currentWordIndex]) {
                        wordElements[currentWordIndex].classList.add('active-word');
                        // Gentle scroll - only if word is not visible
                        const rect = wordElements[currentWordIndex].getBoundingClientRect();
                        const isVisible = rect.top >= 150 && rect.bottom <= window.innerHeight - 50;
                        if (!isVisible) {
                            wordElements[currentWordIndex].scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'center',
                                inline: 'nearest'
                            });
                        }
                    }
                    
                    lastWordIndex = currentWordIndex;
                }
                
                requestAnimationFrame(tick);
            }
            
            audio.addEventListener('play', function() {
                isPlaying = true;
                requestAnimationFrame(tick);
            });
            
            audio.addEventListener('pause', function() {
                isPlaying = false;
            });
            
            audio.addEventListener('ended', function() {
                isPlaying = false;
                // Remove all highlights
                wordElements.forEach(el => el.classList.remove('active-word'));
                lastWordIndex = -1;
            });
            
            audio.addEventListener('seeked', function() {
                // Clear highlights when user manually seeks (using scrubber)
                // Don't reset currentTime - that causes the reset-to-beginning bug
                lastWordIndex = -1;
                wordElements.forEach(el => el.classList.remove('active-word'));
            });
            
            
            function setPlaybackSpeed(speed) {
                const audio = document.getElementById('blogAudio');
                audio.playbackRate = speed;
                
                // Highlight active button
                event.target.parentElement.querySelectorAll('button').forEach(btn => {
                    btn.style.background = 'white';
                    btn.style.color = 'var(--deep-green)';
                });
                event.target.style.background = 'var(--gold)';
                event.target.style.color = 'var(--graphite)';
            }
            </script>
            
            <style>
            .word-highlight {
                transition: background 0.15s ease, color 0.15s ease;
                display: inline;
                cursor: pointer;
            }
            
            .word-highlight:hover {
                background: rgba(200, 200, 200, 0.3);
                border-radius: 2px;
            }
            
            .word-highlight.active-word {
                background: linear-gradient(135deg, rgba(255, 255, 0, 0.6), rgba(255, 200, 0, 0.6));
                color: #000;
                padding: 2px 0;
                border-radius: 2px;
            }
            </style>
            
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 2rem; text-align: center;">
                Finding the right shaft flex, a golfer's journey from frustration to confidence
            </h1>
        
            <p style="margin-bottom: 2rem;">Meet Jake, a dedicated weekend golfer who loves the game, but has been stuck in a rut. Every tee shot feels like a gamble. One day, he hits a low, weak fade that barely reaches the fairway. The next, a wild slice sails out of bounds. On the range, he swings harder and harder in frustration, wondering why his ball flight is so inconsistent.</p>

            <p style="margin-bottom: 2rem;">Jake's story is all too common. Many golfers struggle with timing, ball flight, or control, not realizing their club's shaft flex might not match their swing. In this emotionally charged journey from confusion to clarity, we'll follow Jake as he discovers the impact of shaft flex on his game. Along the way, we'll break down the technical facts, what shaft flex is, how it's categorized, L, A, R, S, X, TX, what happens when a shaft is too stiff or too soft, the telltale signs you're using the wrong flex, and how to match flex to your swing speed and tempo.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">What is shaft flex and why does it matter?</h2>
            
            <p style="margin-bottom: 2rem;">Shaft flex refers to how much a golf club's shaft will bend during the swing. It's essentially the flexibility or stiffness of the shaft. When you swing, the shaft loads bends and unloads, acting like a spring that helps propel the ball. Too much or too little flex can drastically alter where your club face is pointing at impact, and how energy is transferred to the ball. In other words, the shaft is often called the engine of the golf club because it has a huge influence on your shot's trajectory, shape, distance, and consistency.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Flex categories</h2>
            
            <p style="margin-bottom: 2rem;">Manufacturers classify shafts into general flex categories, usually labeled by letters. These range from the softest, most flexible shafts, to the stiffest, least flexible.</p>

            <p style="margin-bottom: 2rem;"><strong>Ladies, L.</strong> The softest flex, typically for the slowest swing speeds, roughly up to approximately 75 miles per hour driver swing speed. Despite the name, not only women use this flex. Any golfer with a very smooth, slow swing can benefit from an L flex.</p>

            <p style="margin-bottom: 2rem;"><strong>Amateur, A, or senior.</strong> A bit stiffer than L, generally for swing speeds from approximately 75 to 85 miles per hour. Again, it's not exclusively for senior players. Anyone whose swing fits that speed and tempo range can do well here.</p>

            <p style="margin-bottom: 2rem;"><strong>Regular, R.</strong> The most common flex, suited to moderate swing speeds from approximately 85 to 95 miles per hour with a reasonably smooth tempo. This is what most recreational golfers use.</p>

            <p style="margin-bottom: 2rem;"><strong>Stiff, S.</strong> For faster swingers, typically 95 to 105 miles per hour or those with an aggressive transition. Many low handicap players and strong athletes prefer stiff flexes.</p>

            <p style="margin-bottom: 2rem;"><strong>Extra stiff, X.</strong> Designed for very high swing speeds, generally 105 plus miles per hour with a fast, forceful downswing. Tour level players often use X flex or even stiffer custom options.</p>

            <p style="margin-bottom: 2rem;"><strong>Tour extra stiff, TX.</strong> The stiffest commonly available flex. For those who need maximum resistance under high loading forces, think professional or elite amateur level swings.</p>

            <p style="margin-bottom: 2rem;">It's important to understand that flex letters aren't perfectly standardized across brands. An R flex from one manufacturer might feel slightly different than another's R flex. That's why a fitting session is so valuable. It takes your specific swing, not just a label, into account.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">What happens when the flex is wrong?</h2>
            
            <p style="margin-bottom: 2rem;"><strong>Shaft too stiff.</strong> If your shaft is stiffer than you need, it won't load enough during your downswing. This usually results in a lower ball flight, potential loss of distance, and sometimes a tendency for the ball to fade or slice. It can also make the club feel heavy and unresponsive. You might also experience fatigue faster because you're fighting that stiff shaft on every swing.</p>

            <p style="margin-bottom: 2rem;"><strong>Shaft too flexible.</strong> On the flip side, if your shaft is too flexible, it can overload and snap back too early. This commonly leads to inconsistent ball flight, sometimes ballooning shots, or pronounced hooks. You lose accuracy and predictability because you can't trust the shaft's timing. The club head position at impact becomes erratic, making it hard to square the face consistently.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Signs you might be using the wrong flex</h2>
            
            <p style="margin-bottom: 2rem;">Let's return to Jake. When he came into the fitting bay, I saw classic signs right away. Inconsistent ball flight, sometimes a straight-ish shot, sometimes a severe slice. No rhyme or reason. Loss of distance compared to what he used to hit. Constant doubt on the tee box, which creates tension in his body. These are hallmarks of a bad shaft match.</p>

            <p style="margin-bottom: 2rem;">Other common symptoms include, excessive fatigue in your hands, forearms, or shoulders. The club feeling dead at impact, no feedback. Frequent mishits that don't correlate with obvious swing errors. Overall frustration, you feel like you're not improving, no matter how much you practice.</p>

            <p style="margin-bottom: 2rem;">If you recognize yourself in Jake's situation, you're not alone. Many golfers play with incorrect shaft flex because they either bought off the rack without a fitting, or they upgraded their swing speed but never re-evaluated their equipment.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The fitting process</h2>
            
            <p style="margin-bottom: 2rem;">When Jake and I began his fitting, the first thing I did was measure his swing speed using a launch monitor. His driver swing speed came in at about 92 miles per hour, right in that regular to stiff transition zone. But speed alone didn't tell the whole story. I watched his tempo. Jake's downswing was smooth, not particularly aggressive. That told me he'd likely do better with a regular flex, even though his speed was borderline stiff territory. I handed him a club with an R flex shaft, same head and grip as his current set, and told him to take a few swings without trying to kill it.</p>

            <p style="margin-bottom: 2rem;">The difference was immediate. His ball flight straightened out. The club felt lighter and more responsive in his hands. He started smiling, not because he was hitting bombs, but because the ball was going where he aimed. That's the hallmark of a proper shaft fit. It's less about maximum distance, though that often improves, and more about consistency and feel.</p>

            <p style="margin-bottom: 2rem;">We tested a few more shafts, including a slightly stiffer option just to compare. But it was clear, the regular flex was his match. His dispersion tightened. His confidence grew. By the end of the session, he was hitting shots he couldn't produce before, not because his swing changed, but because the shaft was finally working with him instead of against him.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Matching flex to swing speed and tempo</h2>
            
            <p style="margin-bottom: 2rem;">Here's a general guideline to help you narrow things down. Remember, these are approximations. Your individual tempo and swing mechanics will influence the final choice.</p>

            <p style="margin-bottom: 2rem;"><strong>75 miles per hour or below, L or senior flex.</strong></p>

            <p style="margin-bottom: 2rem;"><strong>75 to 85 miles per hour, A or senior flex, or even a softer R flex if your tempo is aggressive.</strong></p>

            <p style="margin-bottom: 2rem;"><strong>85 to 95 miles per hour, regular R flex is typically the sweet spot. If you have a very smooth tempo, you might be comfortable here even at the high end.</strong></p>

            <p style="margin-bottom: 2rem;"><strong>95 to 105 miles per hour, stiff S flex. If you're on the higher end of this range with a forceful transition, you might even consider X flex.</strong></p>

            <p style="margin-bottom: 2rem;"><strong>105 plus miles per hour, extra stiff X flex or TX flex. These are for serious players who generate tour level speed and load.</strong></p>

            <p style="margin-bottom: 2rem;">Tempo matters as much as speed. Two golfers with the same swing speed can need different flexes depending on how aggressively they start the downswing. A smooth swinger can often use a slightly softer flex and still get great results, while someone with a quick, aggressive transition might need something stiffer to keep the club face stable.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The transformation</h2>
            
            <p style="margin-bottom: 2rem;">Three weeks after his fitting, Jake sent me a message. He'd just shot his best round in 2 years. More importantly, he was looking forward to his next tee time instead of dreading another day of inconsistency. That's what the right equipment does. It doesn't fix a bad swing, but it allows your natural swing to work at its best. Jake didn't suddenly become Rory McIlroy. He just became a better version of himself because the club was finally cooperating.</p>

            <p style="margin-bottom: 2rem;">For Jake, the right shaft flex meant regaining his confidence. He could step up to the tee knowing the ball would react predictably. He wasn't compensating for a shaft that was too stiff or too whippy. He could trust his motion and focus on his target rather than worrying about where the ball might go. That mental shift is huge. Golf is challenging enough without fighting your equipment.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Practical next steps</h2>
            
            <p style="margin-bottom: 2rem;">If you suspect your shaft flex might be off, here's what I recommend. First, get a basic assessment of your swing speed. Many pro shops or fitting centers can measure this for free or a nominal fee. Pay attention to your tempo. Are you smooth and gradual or quick and explosive? Consider your ball flight. Are you consistently hitting a shot shape you don't want? Or is it all over the place? Look at your physical response. Are you getting sore, tired, or frustrated more than you should?</p>

            <p style="margin-bottom: 2rem;">Armed with that information, schedule a proper fitting. Not just a quick demo, but a session where a fitter can watch you hit multiple shafts and analyze the data. A good fitter will consider your swing speed, tempo, ball flight tendencies, and even your feel preferences. They'll match you with a shaft that complements your natural motion rather than forcing you to adapt.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Final thoughts</h2>
            
            <p style="margin-bottom: 3rem;">Shaft flex is one of those behind the scenes factors that casual golfers often overlook, yet it has a profound impact on performance. It's not about ego or picking the stiffest shaft because you think it sounds better. It's about finding the flex that lets your swing shine. Jake's story is a reminder that sometimes the solution to our golf struggles isn't more lessons or drastic swing changes. Sometimes it's as simple as putting the right tool in your hands. If you've been fighting your clubs, if you feel like your swing is inconsistent for no clear reason, or if you just want to unlock a bit more performance and enjoyment from your game, consider getting your shaft flex evaluated. It might be the key that opens the door to a whole new level of confidence and consistency on the course. Trust the process, trust the data, and most importantly, trust that the right shaft flex is out there waiting for you.</p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Shaft? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Don't let the wrong shaft hold back your potential. A professional fitting can transform your game just like it did for Jake.
                </p>
                
                <p style="font-size: 1.1rem; margin-bottom: 2.5rem; color: rgba(255,255,255,0.9);">
                    As a club-fitting specialist and club builder, I bring the equipment and expertise to your home. Together, we'll find the shaft flex that matches your swing speed, tempo, and style—so you can play with confidence and consistency.
                </p>
                
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?= base_url('/ai-fitting') ?>" class="btn btn-primary" style="background: var(--gold); color: var(--deep-green); font-weight: 700; padding: 1rem 2rem; font-size: 1.1rem; text-decoration: none; border-radius: 6px;">Schedule Your Fitting</a>
                    <a href="<?= base_url('/custom-club-building') ?>" class="btn btn-outline" style="border: 2px solid var(--gold); color: var(--gold); font-weight: 700; padding: 1rem 2rem; font-size: 1.1rem; text-decoration: none; border-radius: 6px;">Custom Club Building</a>
                </div>
                
                <p style="margin-top: 2rem; font-size: 1rem; color: rgba(255,255,255,0.9);">
                    The right shaft makes all the difference. Let's find yours together! 🏆⛳
                </p>
            </div>
        </article>
    </div>
</section>
