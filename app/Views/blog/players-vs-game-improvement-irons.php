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
        
        <!-- Audio Player - Sticky -->
        <div id="audioPlayerSticky" style="position: -webkit-sticky; position: sticky; top: 0; z-index: 1000; background: linear-gradient(135deg, var(--deep-green), #0a5a42); padding: 1rem; border-radius: 0 0 10px 10px; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                <span style="font-size: 1.5rem;">🎧</span>
                <h3 style="color: white; margin: 0; font-size: 1rem;">Listen to This Article</h3>
            </div>
            <audio id="blogAudio" controls preload="auto" style="width: 100%; margin-bottom: 0.5rem;">
                <source src="<?= base_url('serve-audio.php?file=Players Irons vs Game Improvement Irons.mp3') ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <button onclick="setPlaybackSpeed(1)" style="background: white; color: var(--deep-green); border: none; padding: 0.4rem 0.8rem; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">1x</button>
                <button onclick="setPlaybackSpeed(1.5)" style="background: white; color: var(--deep-green); border: none; padding: 0.4rem 0.8rem; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">1.5x</button>
                <button onclick="setPlaybackSpeed(2)" style="background: white; color: var(--deep-green); border: none; padding: 0.4rem 0.8rem; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 0.9rem;">2x</button>
            </div>
        </div>
        
        <!-- Article Header -->
        <header style="margin-bottom: 3rem;">
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Players irons versus game improvement irons, a personal journey to choosing the right clubs
            </h1>
            <div style="color: #666; font-size: 1.1rem; margin-bottom: 2rem;">
                <p style="margin: 0;">Published October 12th, 2025 Fifteen minutes read</p>
            </div>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Players Irons vs Game Improvement Irons.mp3.json') ?>')
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
                // Include h1, h2, p, and li elements
                const textElements = container.querySelectorAll('h1, h2, h3, p, li');
                
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
                    // - Has italic font style (image captions)
                    // - Inside CTA section
                    if (element.querySelector('.word-highlight') || 
                        audioPlayer.contains(element) ||
                        element.closest('a') ||
                        element.querySelector('a') ||
                        element.closest('button') ||
                        element.querySelector('button') ||
                        element.querySelector('a[href*="tel:"]') ||
                        element.style.fontStyle === 'italic' && element.style.fontSize === '0.9rem') {
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
            console.log('Setting up click listeners for', wordElements.length, 'words');
            
            wordElements.forEach((element, idx) => {
                element.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const wordIndex = parseInt(element.getAttribute('data-word-index'));
                    console.log('=== WORD CLICKED ===');
                    console.log('Element:', element.textContent);
                    console.log('DOM Index:', idx);
                    console.log('Word Index attr:', wordIndex);
                    console.log('allWords.length:', allWords.length);
                    console.log('Alignment data:', allWords[wordIndex]);
                    
                    if (!isNaN(wordIndex) && allWords[wordIndex]) {
                        const seekTime = allWords[wordIndex].start;
                        console.log('Seeking to:', seekTime, 'seconds');
                        console.log('Audio readyState:', audio.readyState);
                        
                        // Check if audio has metadata loaded (readyState >= 2)
                        if (audio.readyState >= 2) {
                            // Has at least metadata and first frames - can seek
                            console.log('Audio is ready, seeking now');
                            audio.currentTime = seekTime;
                            console.log('currentTime set to:', audio.currentTime);
                            if (audio.paused) {
                                audio.play();
                            }
                        } else {
                            console.log('Audio not ready, waiting for loadeddata');
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
                    } else {
                        console.error('Invalid word index or no alignment data:', wordIndex);
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
                padding: 2px 4px;
                border-radius: 3px;
            }
            </style>
            
            <p style="font-size: 1.2rem; margin-bottom: 2rem; color: #555; font-style: italic;">
                I still remember the first time I gazed down at a shiny blade iron behind the ball. It was a hand-me-down muscle back from a better player and it looked beautiful. Thin top line, compact head, gleaming chrome. In my mind, playing players irons meant I had arrived as a serious golfer. Nevermind that I was a 20 handicap struggling to make consistent contact. My ego was along for the ride.
            </p>
            
            <p style="margin-bottom: 2rem;">
                What followed was a season of bruised pride, poor scores, and a hard lesson in choosing the right irons. From weekend warriors to tour players, every golfer eventually faces the blades versus cavity backs dilemma.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Blades versus cavity backs, a golfer's crossroads</h2>
            
            <p style="margin-bottom: 2rem;">
                Players irons typically refer to blade or small muscle back irons favored by low handicap players. They have compact club heads, thinner top lines, and little to no offset. These design traits put performance in the golfer's hands. If you strike the tiny sweet spot pure, you're rewarded with exquisite feel and workability. But miss by a hair and a player's iron will let you know with a harsh vibration and a ball veering off target.
            </p>

            <p style="margin-bottom: 2rem;">
                Conversely, game improvement, GI irons, are engineered to be your supportive friend on the course. They're usually larger in size with a cavity back design, meaning much of the club head's mass is spread around the perimeter. GI irons sport thicker top lines, wider soles, and more generous offset to inspire confidence at address. Advanced weighting technology in these clubs helps launch the ball higher and straighter even if contact isn't perfect.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">You know, club head size and shape</h2>
            
            <!-- Blades vs Cavity Backs Image -->
            <div style="text-align: center; margin: 3rem 0;">
                <img src="<?= base_url('images/Blades vs cavitybacks.jpg') ?>" 
                     alt="Blades vs Cavity Backs - Visual comparison of iron designs" 
                     style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"
                     loading="lazy">
                <p style="font-size: 0.9rem; color: #666; margin-top: 0.5rem; font-style: italic;">
                    Visual comparison of blade vs cavity back iron designs
                </p>
            </div>
            
            <p style="margin-bottom: 2rem;">
                Players irons have compact heads with weight concentrated behind the sweet spot. GI irons have larger heads with deep cavity back constructions that push weight to the perimeter for stability.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Top line and sole width</h2>
            
            <p style="margin-bottom: 2rem;">
                A blade's top line is razor thin and its sole narrow. GI irons feature thicker top lines and wider soles, which lower the center of gravity and help get the ball airborne more easily.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Offset</h2>
            
            <p style="margin-bottom: 2rem;">
                Players irons usually have little to no offset. Game improvement models add more offset, which can help reduce A slice and promote straighter shots.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Forgiveness, MOI</h2>
            
            <p style="margin-bottom: 2rem;">
                The blade design offers minimal forgiveness. GI irons are built with high MOI, meaning they resist twisting on off-center hits.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Feeling feedback</h2>
            
            <p style="margin-bottom: 2rem;">
                Many players irons are forged from soft carbon steel, delivering buttery feel and clear feedback. Game improvement irons are often cast or multi-piece designs that prioritize performance over feel.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Lofts and distance</h2>
            
            <p style="margin-bottom: 2rem;">
                GI irons tend to have stronger lofts to help amateurs hit it further. Players irons keep more traditional weaker lofts for better distance control and spin.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Who should play what?</h2>
            
            <h3 style="color: var(--deep-green); font-size: 1.5rem; margin: 2rem 0 1rem 0;">High handicap golfers, 15 to 20 plus</h3>
            <p style="margin-bottom: 2rem;">
                You will benefit most from game improvement irons. These clubs are designed to make the game easier, larger sweet spots for more consistent distance, help getting the ball in the air, and forgiveness on frequent miss hits. Don't worry about any stigma. These clubs exist to help you build confidence.
            </p>

            <h3 style="color: var(--deep-green); font-size: 1.5rem; margin: 2rem 0 1rem 0;">Low handicap golfers, zero to five</h3>
            <p style="margin-bottom: 2rem;">
                Players irons are generally aimed at skilled consistent ball strikers. If you're routinely around par or single digit handicap and you have no trouble finding the center of the club face, a set of players irons can offer you ultimate control. These irons allow you to shape shots, fade, draw, flight it low or high more easily.
            </p>

            <h3 style="color: var(--deep-green); font-size: 1.5rem; margin: 2rem 0 1rem 0;">Mid-handicap golfers, 6 to 15</h3>
            <p style="margin-bottom: 2rem;">
                This is the gray zone where many golfers could reasonably go either way or find a happy medium. Some mid-handicappers gravitate to players' distance irons, a modern category blending features of both players and GI irons. The right answer often comes down to honest self-assessment.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The ego factor. Why golfers resist game improvement clubs</h2>
            
            <p style="margin-bottom: 2rem;">
                If game improvement irons are so helpful, why would anyone not want them? The honest answer, ego and aesthetics often get in the way of smart decisions. Golfers can be a stubborn bunch. We sometimes choose what we want over what we need, even if it hurts our scores.
            </p>

            <p style="margin-bottom: 2rem;">
                The truth, one of the biggest reasons golfers play the wrong irons, is simply because players' irons look cool. There's a certain pride in pulling a sleek, thin blade out of your bag. It feels like you're a better golfer already.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The fitting epiphany when data defeats assumptions</h2>
            
            <p style="margin-bottom: 2rem;">
                I scheduled an in-home club fitting at the end of that tumultuous season. The club technician came to my garage with a launch monitor and a van full of club heads and shafts.He had me hit shots with my 7-iron while the launch monitor recorded the numbers. As expected, my good swings were fine, but the bad ones were ugly.
            </p>

            <p style="margin-bottom: 2rem;">
                Then he handed me a popular game improvement 7-iron. I half cringed at the offset and thicker top line, but he just smiled and said [laughs], "Hit a few. No judgment." The first swing felt strange, but the ball sailed high and true. Shot after shot, I found the iron incredibly easy to hit. My swing didn't magically change, but suddenly slight mishits were still flying 150-plus yards and finding the green.
            </p>

            <h3 style="color: var(--deep-green); font-size: 1.5rem; margin: 2rem 0 1rem 0;">The Revelation</h3>
            
            <p style="margin-bottom: 2rem;">
                The fitting revealed a surprising truth. I, a prideful mid-handicapper who fancied himself a decent ball striker, performed better with game improvement irons, full stop. Better in every category that mattered; distance, consistency, dispersion, and confidence.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">When and Why to Switch Iron Types</h2>
            
            <p style="margin-bottom: 2rem;">
                The question of when to move up to a player's iron or move to a more forgiving iron is common among serious golfers. The right time to switch is when you feel that your current clubs are holding you back more than helping you. Listen to your scores and your enjoyment. If either is suffering and equipment could be the culprit, it's worth exploring a change.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Finding Confidence and Identity in the Right Clubs</h2>
            
            <p style="margin-bottom: 2rem;">
                After my fitting, I ended up with a new set of game improvement irons custom-built to my needs. On the very first hole, I had 150 yards to the green. I made an easy swing and watched the ball soar high, straight at the flag. It hit the front of the green and rolled up to about 12 feet. I'll never forget the mix of emotions: pure joy, a bit of sheepishness, and mostly confidence blooming inside me.
            </p>

            <p style="margin-bottom: 3rem;">
                By the 18th hole, I didn't care one bit that I was using game improvement irons. What I cared about was the score I was writing down, one of my best ever. The club should be extensions of your game, not definitions of it. I didn't become a lesser golfer because I switched to more forgiving irons. I became a better golfer.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Elevate Your Game? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    If my journey resonates with you, the next step might be to experience your own "fitting epiphany." A professional club fitting is one of the best investments an improving golfer can make. It takes the guesswork and bias out of the equation and replaces it with evidence-based knowledge about what works for your swing.
                </p>
                
                <p style="font-size: 1.1rem; margin-bottom: 2.5rem; color: rgba(255,255,255,0.9);">
                    As a club-fitting specialist and club builder, I bring the equipment and expertise to your home. Together, we'll explore what combination gives you the best feel and best results, so you can step onto the course with equipment that empowers your game.
                </p>
                
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?= base_url('/ai-fitting') ?>" class="btn btn-primary" style="background: var(--gold); color: var(--deep-green); font-weight: 700; padding: 1rem 2rem; font-size: 1.1rem; text-decoration: none; border-radius: 6px;">Schedule Your Fitting</a>
                    <a href="<?= base_url('/custom-club-building') ?>" class="btn btn-outline" style="border: 2px solid var(--gold); color: var(--gold); font-weight: 700; padding: 1rem 2rem; font-size: 1.1rem; text-decoration: none; border-radius: 6px;">Custom Club Building</a>
                </div>
                
                <p style="margin-top: 2rem; font-size: 1rem; color: rgba(255,255,255,0.9);">
                    The ultimate players club is the one that makes you a better player. Let's find it together! 🏆⛳
                </p>
            </div>
        </article>
    </div>
</section>
