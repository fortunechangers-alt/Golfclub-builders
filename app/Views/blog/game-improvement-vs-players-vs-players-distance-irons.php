<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section" style="margin-top: 120px;">
    <div class="container" style="max-width: 900px;">
        
        <!-- Audio Player - Fixed Below Header -->
        <div id="audioPlayerSticky" style="position: fixed; top: 152px; left: 50%; transform: translateX(-50%); z-index: 999; background: linear-gradient(135deg, var(--deep-green), #0a5a42); padding: 1rem 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.3); max-width: 900px; width: calc(100% - 2rem); border-radius: 12px;">
            <!-- Back to Blog - Part of Player -->
            <div style="margin-bottom: 0.75rem;">
                <a href="<?= base_url('/blog') ?>" style="color: white; text-decoration: none; font-weight: 600; font-size: 0.9rem; opacity: 0.9; transition: opacity 0.2s;">← Back to Blog</a>
            </div>
            
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                <span style="font-size: 1.5rem;">🎧</span>
                <h3 style="color: white; margin: 0; font-size: 1.1rem; font-weight: 600; letter-spacing: 0.5px;">Listen to Article</h3>
            </div>
            <audio id="blogAudio" controls preload="auto" style="width: 100%; margin-bottom: 0.75rem; border-radius: 8px;">
                <source src="<?= base_url('serve-audio.php?file=Game Improvement vs Players vs Players%E2%80%91Distance Irons.mp3') ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <button onclick="setPlaybackSpeed(1)" style="background: white; color: var(--deep-green); border: none; padding: 0.4rem 0.9rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">1x</button>
                <button onclick="setPlaybackSpeed(1.5)" style="background: white; color: var(--deep-green); border: none; padding: 0.4rem 0.9rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">1.5x</button>
                <button onclick="setPlaybackSpeed(2)" style="background: white; color: var(--deep-green); border: none; padding: 0.4rem 0.9rem; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">2x</button>
            </div>
        </div>
        
        <style>
        @media (max-width: 768px) {
            #audioPlayerSticky {
                top: 100px !important;
                left: 0 !important;
                right: 0 !important;
                transform: none !important;
                max-width: 100% !important;
                width: 100% !important;
                border-radius: 0 !important;
                padding: 0.75rem 1rem !important;
            }
            #audioPlayerSticky h3 {
                font-size: 0.95rem !important;
            }
            #audioPlayerSticky span {
                font-size: 1.2rem !important;
            }
        }
        </style>
        
        <!-- Spacer to prevent content from hiding under fixed player -->
        <div style="height: 180px;"></div>
        
        <!-- Article Header -->
        <header style="margin-bottom: 3rem;">
            <div style="color: #666; font-size: 1.1rem; margin-bottom: 1rem;">
                <p style="margin: 0;">Published: <time>October 22, 2025</time> • 9 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Game Improvement versus Players versus Players Distance Irons
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Game Improvement vs Players vs Players%E2%80%91Distance Irons.mp3.json') ?>')
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
                        // Filter out spaces, newlines, and ellipsis, convert start_time/end_time to start/end
                        allWords = allWordsFromSegments
                            .filter(w => w.text && w.text.trim().length > 0 && w.text !== ' ' && w.text !== '\n' && w.text !== '...')
                            .map(w => ({
                                text: w.text,
                                start: w.start_time || w.start,
                                end: w.end_time || w.end
                            }));
                        console.log('Loaded', allWords.length, 'aligned words (filtered out spaces and ellipsis)');
                        
                        // Wrap blog text with spans for highlighting
                        wrapBlogTextWithSpans();
                    } else {
                        console.error('No words found in alignment JSON');
                    }
                })
                .catch(err => console.error('Error loading timestamps:', err));
            
            function wrapBlogTextWithSpans() {
                const container = document.querySelector('.container');
                // Include h1 from header AND h2, h3, p, li from article
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
                    // - Is a link
                    // - Inside CTA section
                    // - Inside info boxes
                    // - Contains images (not the caption, just skip images themselves)
                    // - Contains metadata (time elements)
                    if (element.querySelector('.word-highlight') || 
                        audioPlayer.contains(element) ||
                        element.closest('a') ||
                        element.querySelector('a') ||
                        element.closest('button') ||
                        element.querySelector('button') ||
                        element.querySelector('a[href*="tel:"]') ||
                        element.closest('div[style*="background: linear-gradient"]') ||
                        element.closest('div[style*="background: #f8f9fa"]') ||
                        element.querySelector('img') ||
                        element.querySelector('time')) {
                        return;
                    }
                    
                    const text = element.textContent;
                    // Remove bullet characters, ellipsis, and [laughs] that might be in the text
                    const cleanText = text.replace(/[•·]/g, '').replace(/^\d+\.\s*/gm, '').replace(/\.\.\./g, '').replace(/\[laughs\]/g, '');
                    const words = cleanText.split(/\s+/);
                    
                    element.innerHTML = '';
                    words.forEach((word, index) => {
                        if (word.trim()) {
                            const span = document.createElement('span');
                            span.textContent = word;
                            span.className = 'word-highlight';
                            span.dataset.wordIndex = globalWordIndex;
                            globalWordIndex++;
                            element.appendChild(span);
                            
                            if (index < words.length - 1) {
                                element.appendChild(document.createTextNode(' '));
                            }
                        }
                    });
                });
                
                wordElements = Array.from(document.querySelectorAll('.word-highlight'));
                console.log('Wrapped', wordElements.length, 'word elements');
                
                // Add click-to-seek functionality
                wordElements.forEach((element, index) => {
                    element.addEventListener('click', function() {
                        const wordIndex = parseInt(this.dataset.wordIndex);
                        if (allWords[wordIndex]) {
                            const seekTime = allWords[wordIndex].start;
                            console.log('Seeking to:', seekTime);
                            
                            if (audio.readyState >= 2) {
                                audio.currentTime = seekTime;
                                if (audio.paused) audio.play();
                            } else {
                                audio.addEventListener('loadeddata', function onReady() {
                                    audio.removeEventListener('loadeddata', onReady);
                                    audio.currentTime = seekTime;
                                    audio.play();
                                });
                            }
                        }
                    });
                });
                
                console.log('Setting up click listeners for', wordElements.length, 'words');
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
                        const isVisible = rect.top >= 250 && rect.bottom <= window.innerHeight - 50;
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
                // Reset when user seeks
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
                border-radius: 3px;
            }
            </style>
            
            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The Crossroads of Iron Choice.</h2>
            
            <p style="margin-bottom: 2rem;">
                He carried two kinds of hope into the shop, the kind that loves the look of a thin top line and the kind that wants mercy when Tuesday hands you your ordinary swing. Tyler set his old 7 iron on the bench. Compact, sharp, a little intimidating even when it slept, and said almost apologetically, "I want to get better. I also don't want to feel punished." That sentence is the crossroads for almost everyone.
            </p>

            <p style="margin-bottom: 2rem;">
                And we let the room go quiet. The monitor woke with its gentle hum. Epoxy bottles clicked softly in their tray. And the air picked up that clean steel smell you only notice when you care about this stuff. I put impact tape on three heads that told three different stories, a Player's iron that looked like courage at address, a Game Improvement, GI, iron that promised help without apology, and a Player's Distance, PD, head that stood sincerely somewhere between.
            </p>

            <p style="margin-bottom: 2rem;">
                Tyler's first swing with the Player's iron were like a musician warming up in a concert hall. A few notes ordinary and then one perfect tone that rang warm and true. On that centered strike, the ball flew low piercing and obedient, the kind of flight that whispers, "You earned me." But his misses low on the face, a hair toward the toe, fell out of the sky as if gravity had been waiting.
            </p>

            <p style="margin-bottom: 2rem;">
                Then GI. The head looked friendlier at address, slightly wider sole, a touch more offset, weight pushed to the perimeter. The first slightly thin strike climbed anyway, carried the front and landed like it knew the green. He wasn't thrilled by the silhouette. He was thrilled by the mercy. "That didn't deserve to be that good," he said softly, which is another way of remembering why golf breaks and repairs the same heart.
            </p>

            <p style="margin-bottom: 2rem;">
                Finally, PD sleeker than the GI, calmer than the blade. Inside the head, thin face, clever weighting, that quiet technology modern irons carry so forgiveness doesn't have to look loud. His best strike looked almost identical to the Player's shot. Same line, same hush after landing, but his ordinary miss kept 10 yards he used to lose. The room changed temperature the way it always does when a golfer realizes he doesn't have to choose between pride and peace.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Visual comparison of iron categories, GI, Players, and Players Distance.</h2>

            <p style="margin-bottom: 2rem;">
                Let me say the simple truths out loud. Game Improvement, GI. Irons put more mass around the perimeter, higher MOI, sit a little wider on the turf, and often lower the center of gravity so the ball launches easier. They're designed to protect your ordinary swing, bigger sweet spot, more height from low face contact, calmer curves when you're a little late.
            </p>

            <p style="margin-bottom: 2rem;">
                Player's irons keep things compact, thinner top lines, narrower soles, less offset, a center of gravity that keeps trajectory down and controllable. They reward center face strikes and communicate everything, sweetness when you deserve it, the sting when you don't.
            </p>

            <p style="margin-bottom: 2rem;">
                Players Distance, PD, tries to give you both, the look your eye trusts with the tech that keeps ball speed up and small misses from becoming big problems. Think Player's silhouette, modern forgiveness.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">There are trade-offs, and it's loving to name them.</h2>

            <p style="margin-bottom: 2rem;">
                GI can sometimes look bulkier, and if poorly fit, over-help a face that already wants to close. But fitted right, they are not training wheels. They're a fair fight.
            </p>

            <p style="margin-bottom: 2rem;">
                Players irons can feel like poetry on your best day and like a grading rubric on your worst. They won't lie for you. That's beautiful and exhausting if you're still finding center.
            </p>

            <p style="margin-bottom: 2rem;">
                PD irons often use stronger lofts to keep flight windows right with that hot face. That's fine. Just gap your wedges after the switch so your scoring club still speak in whole sentences.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">What about the ground?</h2>

            <p style="margin-bottom: 2rem;">
                Turf matters as much as the face. A wider sole in GI can save a dig. A slimmer sole in Players can save a bounce. Your delivery, steep or shallow, early or late should choose the sole, not a catalog photo. We always test on grass when we can. Mats forgive sins. Soil tells the truth.
            </p>

            <p style="margin-bottom: 2rem;">
                Back to Tyler. He cared about looks. That matters. Calm at address makes braver swings. But he also cared about scorecards written without apologies. We kept shafts and lengths the same so the head did the talking, and PD told a story he could live with. Best balls like the blade, misses with a cushion.
            </p>

            <p style="margin-bottom: 2rem;">
                Then we made the small, unromantic decisions that good golf lives on, a shaft weight that matched his energy, a flex that met his transition without picking a fight, a swing weight that let him feel the head without the head bossing him around, line loft that put start lines where his eyes were and kept the ladder of distances even.
            </p>

            <p style="margin-bottom: 2rem;">
                He hit five more with the PD 7-iron, then five more.The window looked like twins. He didn't hit farther, he hit truer. The room breathed out with him.
            </p>

            <p style="margin-bottom: 2rem;">
                If you're standing at the same crossroads, here's a pocket guide worth keeping. Judge patterns, not heroes. One post card swing with a blade doesn't out-vote 10 PD shots that hold greens.
            </p>

            <p style="margin-bottom: 2rem;">
                Pick the club that makes your average shot better without stealing what you love about your best.
            </p>

            <p style="margin-bottom: 2rem;">
                Blend sets on purpose. Many golfers play PD in long slash mid irons and players in short irons. Courage where you want precision, mercy where you need it.
            </p>

            <p style="margin-bottom: 2rem;">
                Mind the turf. Your course in your delivery, pick the soul. We'll listen to divots before we listen to marketing, regap after you change. Stronger loft PD or GI will stretch distances. Set your wedge lofts to keep 10 to 12 yard steps you can trust.
            </p>

            <p style="margin-bottom: 2rem;">
                Your eye matters. The right look relaxes your grip pressure and steadies your breath. Calm hands make brave swings.
            </p>

            <p style="margin-bottom: 2rem;">
                He packed up slowly, the way people do when they don't wanna scare off a good feeling. The old seven iron went back into the bag like a framed photo, kept honored, maybe still perfect for certain evenings. The PD Demo rode in his hand like a new chapter. That's not compromise. That's a choice to play the game you love with tools that love you back.
            </p>

            <p style="margin-bottom: 3rem;">
                If this tugged on something inside you, if you're done being brave with the wrong companions, bring the swing you already own. We'll put a player's, a PD, and a GI. Head behind the ball, watch where your strike truly lives, and choose the iron that turns courage into a habit instead of a negotiation.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Iron Category? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    We'll put all three categories behind the ball and watch where your strike truly lives.
                </p>
                
                <p style="font-size: 1.2rem; margin-bottom: 2.5rem; color: white; font-weight: 600;">
                    <em>Precision. Performance. Every Swing.</em>
                </p>
                
                <div style="margin-bottom: 2rem;">
                    <a href="tel:7173871643" class="btn btn-primary" style="background: var(--gold); color: var(--deep-green); font-weight: 700; padding: 1rem 2.5rem; font-size: 1.2rem; text-decoration: none; border-radius: 6px; display: inline-block;">
                        📞 Call (717) 387-1643
                    </a>
                </div>
                
                <p style="font-size: 1rem; color: rgba(255,255,255,0.9);">
                    Schedule your Iron Category Fitting<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    Courage into a habit instead of a negotiation.
                </p>
            </div>
        </article>
    </div>
</section>
