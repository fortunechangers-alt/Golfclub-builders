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
                    <source src="<?= base_url('serve-audio.php?file=Maya and Dan.mp3') ?>" type="audio/mpeg">
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
            
            fetch('<?= base_url('JSON/Maya and Dan.mp3.json') ?>')
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
                Maya and Dan, when labels meet reality
            </h1>
        
            <p style="margin-bottom: 2rem;">They arrived together on a windy Thursday. Maya with a canvas tote full of range tokens, Dan with the kind of grin that says, "I'm here for her, but I'm definitely going to swing something." He carried a men's stiff driver he trusted since college. She held a boxed women's set her sister had sworn by. They wanted me to confirm what the labels already seemed to promise.</p>

            <p style="margin-bottom: 2rem;">I didn't. I asked them to hit balls.</p>

            <p style="margin-bottom: 2rem;">Our shop is quiet on purpose. You can hear the launch monitor wake up, the small fan over the mat, the way a centered strike makes a soft, round note that feels like truth in your hands. Maya went first. Her tempo was smooth, unhurried, the kind of rhythm you see in someone who can walk a hill without changing breath. Her speed was real, faster than she believed, and the ball rose with a bright, confident window when she caught the middle. Dan stepped up next and swung the way men are taught to swing, harder when unsure, firmer when the ball doesn't listen. His best was a postcard. His average lived a little right and a little low. By the end of 10 balls, his shoulders had crept into his ears.</p>

            <p style="margin-bottom: 2rem;">"Tell us about men's versus women's clubs," he said, which is how this conversation always begins. So I told them the simple, accurate version.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">What the labels usually mean</h2>
            
            <p style="margin-bottom: 2rem;">Clubs sold as women's are typically shorter, lighter overall, and use softer flexes than their men's counterparts. Grips are usually smaller in diameter. Lofts may be slightly higher to help launch. Women's drivers, for instance, are often about an inch shorter than standard men's models, and the irons scale down similarly. That's a decent starting point for many smaller or smoother tempo golfers of any gender, because shorter and lighter can make timing easier and launch more honest.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">What the labels do not mean</h2>
            
            <p style="margin-bottom: 2rem;">They do not mean men must always play men's clubs or that women must always play women's. They don't mean every woman needs an L, ladies flex, or that every man belongs in S, stiff. They don't know your height, your wrist to floor, your hand size, your swing speed, your tempo, your strength, your injury history, or your confidence. Labels are scaffolding. Fit is a house.</p>

            <p style="margin-bottom: 2rem;">We put Maya's boxed set aside for a moment and built a test club in a regular flex with a mid-weight shaft, firmer than the L in the box, and a standard diameter grip instead of the undersize. She took one breath and sent a drive with a calm draw that looked like the line you'd sketch if you could draw a perfect shot. She laughed, surprised, and a little proud, because the ball does not care what it says on the shrink wrap.</p>

            <p style="margin-bottom: 2rem;">Dan's turn. He lived on a knife edge with the stiff, best swings, pure enough bullets, ordinary swings, low right compromises. So we tested a slightly lighter shaft with a regular flex in his driver and trimmed length down half an inch so his timing didn't have to sprint to keep up. The change wasn't dramatic. It was better. The low rights became mid-window pushes that curved back. He could make the same move and expect the same answer two shots in a row. That's not a miracle. That's fit.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">We talked through the levers we can pull, the honest ones</h2>
            
            <p style="margin-bottom: 2rem;"><strong>Length,</strong> shorter isn't less. At its leverage, you can time. Most misses live at the ends. Too long pulls the club off plane and delays the face. Too short can make you hunch and lose speed. We fit length to height, posture, delivery, and where you actually strike the face, not to a label.</p>

            <p style="margin-bottom: 2rem;"><strong>Total weight versus swing weight.</strong> Total weight is what you carry for 18 holes. Swing weight is how heavy the club feels in motion. A women's club cut down from a men's shaft without adding head weight often goes too light in swing weight. The head disappears, timing evaporates. If we shorten, we adjust the balance so the club still talks to your hands.</p>

            <p style="margin-bottom: 2rem;"><strong>Flex and profile.</strong> Flex letters, L-A-M-R, S-X-T-X, are rough ladders. Tempo matters as much as speed. Smooth transitions can live in softer options with great results. Punchy transitions often need firmer tips or more mass so the face shows up on time.</p>

            <p style="margin-bottom: 2rem;"><strong>Grip size,</strong> hands decide. Too small and you squeeze. Too big and you lose face awareness. We measure hand size and test. A lot of women land in standard or mid depending on feel and build, not a preset ladies size. Plenty of men with smaller hands play undersize.</p>

            <p style="margin-bottom: 2rem;"><strong>Loft gapping.</strong> If a women's model has a touch more loft and lighter shafts, carries will change. We gap from the top of the bag to the wedges so there are no missing sentences in your distances.</p>

            <p style="margin-bottom: 2rem;">Back on the mat, Maya tried a stiff in a lighter weight just to see it. The ball still flew, but the feel got uptight. The club didn't load as willingly and her draw began to hang on the right side of the range. She shook her head, honest with herself. That regular felt like it wanted to help. Dan, meanwhile, tried to prove the stiff was still his. He found two perfect ones, then chased them, then lost them. He put the regular back down like someone choosing a boot that fits instead of one that flatters at the store mirror.</p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Here are the truths I send home with couples</h2>
            
            <p style="margin-bottom: 2rem;">There is no such thing as men's distance or women's forgiveness. There's only the club that fits the way you swing.</p>

            <p style="margin-bottom: 2rem;">Cut downs aren't free. If you shorten a club and don't rebalance it, the swing weight craters and the head vanishes.We add the right grams back where they belong.</p>

            <p style="margin-bottom: 2rem;">TX is not a trophy. It's for tour-level speed with an aggressive transition. Most golfers, men and women, play better golf in R or S when the weight and tip profile match their move.</p>

            <p style="margin-bottom: 2rem;">Comfort is performance if your elbow sings by the 12th hole. A mid-weight graphite iron shaft isn't giving in, it's choosing golf you can finish.</p>

            <p style="margin-bottom: 2rem;">Your eye matters. At address, choose the look that calms you. Sleek players, players distance, or game improvement. Calm golfers make brave swings.</p>

            <p style="margin-bottom: 2rem;">We built them unlabeled clubs that belong to their swings. Maya in a regular driver with a mid-weight shaft and a grip that filled her hands without asking for tension. A player's distance 7 iron that turned her thin miss into a carry that held. Dan in a regular driver trimmed to his timing, a slightly heavier iron shaft so his transition didn't rush, lie and swing weight tuned so the toe didn't write its own plot twist. If you lined the builds up, you wouldn't see gender, you'd see fit.</p>

            <p style="margin-bottom: 2rem;">They came back a week later with golf on their faces. Maya had carried a par 5 layup she used to fear. Dan had hit two tee balls he didn't have to apologize for. They didn't swap identities. They found equipment that stopped arguing with who they already were.</p>

            <p style="margin-bottom: 3rem;">So if the labels have been telling you a story that doesn't feel like yours, bring the swing you own. We'll measure height and wrist to floor. Note your speed and tempo, size your grips, and then build in grams, inches, and feel instead of engender. The right clubs don't care what shelf they came from. They care that your hands stop bracing, your breath slows at address, and the ball starts flying like the picture you kept in your mind.</p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Fit? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Let our professional fitting help you choose clubs based on your swing, not your gender. We'll build the perfect set for your game.
                </p>
                
                <p style="font-size: 1.1rem; margin-bottom: 2.5rem; color: rgba(255,255,255,0.9);">
                    As a club-fitting specialist and club builder, I bring the equipment and expertise to your home. Together, we'll explore what combination gives you the best feel and best results, so you can step onto the course with equipment that empowers your game.
                </p>
                
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?= base_url('/ai-fitting') ?>" class="btn btn-primary" style="background: var(--gold); color: var(--deep-green); font-weight: 700; padding: 1rem 2rem; font-size: 1.1rem; text-decoration: none; border-radius: 6px;">Book Custom Fitting</a>
                    <a href="<?= base_url('/custom-club-building') ?>" class="btn btn-outline" style="border: 2px solid var(--gold); color: var(--gold); font-weight: 700; padding: 1rem 2rem; font-size: 1.1rem; text-decoration: none; border-radius: 6px;">Custom Club Building</a>
                </div>
                
                <p style="margin-top: 2rem; font-size: 1rem; color: rgba(255,255,255,0.9);">
                    The right clubs make you a better player. Let's find them together! 🏆⛳
                </p>
            </div>
        </article>
    </div>
</section>
