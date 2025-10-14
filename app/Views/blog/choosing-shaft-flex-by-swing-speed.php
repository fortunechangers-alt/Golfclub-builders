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
                <source src="<?= base_url('serve-audio.php?file=Eli\'s Journey.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>January 15, 2025</time> • 8 min read</p>
    </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Eli's journey, when numbers meet feel
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Eli\'s Journey.mp3.json') ?>')
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
                    // Remove bullet characters that might be in the text
                    const cleanText = text.replace(/[•·]/g, '').replace(/^\d+\.\s*/gm, '');
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
            
            <p style="margin-bottom: 2rem;">
                The night air smelled like rain and rubber when Eli stepped into our little workshop, half glove tucked in his back pocket, the kind of hopeful tired you feel after a long range session. The monitor says I'm around 97 with the driver, he said as if the number were a verdict. He wanted a stiffer shaft because numbers always sound like destiny. I handed him water and shook my head. Speed matters, I said, but it isn't the whole story. Let's find out what your swing is saying, then we'll pick the shaft that listens.
            </p>

            <p style="margin-bottom: 2rem;">
                We rolled the net down, woke the launch monitor, and let the room fall quiet, except for the hum of the fans and the soft tick of epoxy bottles settling in their tray. Eli's first few drives looked like a heartbeat. One high and floaty, one low and skittering right, one perfect, and he had no idea why. 97 miles per hour can be regular or stiff, even X on the wrong day, depending on what your transition is doing. The club doesn't read a badge, it reacts to how you load it.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's the honest truth, said simply. Flex is a match between your speed and your tempo. Speed pushes the shaft one way, your transition, smooth versus snappy, yanks it another. When they agree, the face comes back to the ball like it was never away. Launch looks believable, spin is tidy, and your miss gets smaller. When they fight, you feel it in your hands long before the ball tells the tale.
            </p>

            <p style="margin-bottom: 2rem;">
                We started with two shafts at the same length and weight. One a touch softer in the middle, one firmer in the tip. Eli's swing isn't violent. He gathers at the top and unwinds like he's finishing a sentence he started well. His speed says borderline stiff, but his tempo whispers, don't over tighten. The softer mid-profile turned his best swings from accidents into habits. Not longer necessarily, just true. He could make the same move and expect the same answer. That's what the right flex does. It keeps your good swing good.
            </p>

            <!-- Flex Image -->
            <div style="text-align: center; margin: 3rem 0;">
                <img src="<?= base_url('images/flex.jpg') ?>" 
                     alt="Flex - Professional shaft flex fitting and analysis" 
                     style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"
                     loading="lazy">
            </div>
            
            <p style="font-size: 0.9rem; color: #666; margin-bottom: 2rem; text-align: center; font-style: italic;">
                Professional shaft flex analysis in action
            </p>

            <p style="margin-bottom: 2rem;">
                Now, because you asked for something practical you can trust, here are typical flex windows. They are guidelines, not laws. Brands vary, profiles differ, and your tempo can push you up or down a rung. Read them like road signs, then test.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Driver club head speed typical flex.</h2>
            
            <p style="margin-bottom: 2rem;">
                Under 75 miles per hour, L, ladies. 75 to 85 miles per hour, AM, senior amateur. 85 to 95 miles per hour, R, regular. 95 to 110 miles per hour, S, stiff. 110 plus miles per hour, X, extra stiff. TX, tour extra. For very high speed and an aggressive forceful transition when X still feels like it's given up on you.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Six iron club head speed rough cues.</h2>
            
            <p style="margin-bottom: 2rem;">
                Under 60 miles per hour, L. 60 to 70 miles per hour, AM. 70 to 80 miles per hour, R. 80 to 90 miles per hour, S. 90 plus miles per hour, X. Consider Texas only if your transition's truly tour strong.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Two warnings that save golfers a lot of money.</h2>
            
            <p style="margin-bottom: 2rem;">
                Flex labels aren't standardized. One brand's stiff can feel like another brand's firm regular. Flex isn't just one number. Shaft weight and profile, where it bends, how stable the tip is change the story. A 65 gram mid-launch stiff can feel friendlier than a 75 gram low-launch stiff with a locked down tip.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">What do the wrong choices feel like?</h2>
            
            <p style="margin-bottom: 2rem;">
                Too soft. The head seems to arrive early. Shots climb and stall. Right handers often see starts left that keep turning. The whole thing feels whippy under pressure. Too stiff. The club refuses to load. Flight flattens. You fight blocks and spinny fades. You start swinging harder than you want just to wake it up.
            </p>

            <p style="margin-bottom: 2rem;">
                And the right one? The right one makes you breathe out. You feel the shaft gather at the top, not wobbling, not rigid, and then return like a nudge that helps the face show up on time. Your swing doesn't become someone else's, it becomes repeatable.
            </p>

            <p style="margin-bottom: 2rem;">
                If you want a quick, honest way to check yourself this week, log five normal drives on a monitor or radar across two sessions. Don't chase numbers. Swing like you play. Watch patterns, not heroes. Is the average window believable? Are the misses predictable? Try a bracket one flex below what your speed suggests and one above. Keep length and head the same. Let your hands vote.
            </p>

            <p style="margin-bottom: 2rem;">
                Back to Eli. We kept the profile that met his rhythm halfway, then trimmed half a swing weight point back into the handle so the head didn't boss the downswing. His dispersion circle shrank like a puddle in August. He didn't hit one world beater that night, he hit several of the same. He gathered his things with that small private smile golfers get when the club finally feels like an ally.
            </p>

            <p style="margin-bottom: 2rem;">
                A word about TX before we close. It's not a badge of courage. It's a tool for a very small slice of players, very high speed and a hard punchy transition who still feel X is folding on them. If that's you, you probably already know because everything softer feels like it's wagging the dog. If it isn't you, stiff or X in the right profile will almost always make better golf, and better golf is the only status symbol worth chasing.
            </p>

            <p style="margin-bottom: 3rem;">
                If you read this far, it's probably because you're tired of guessing. Come in with the swing you own. We'll measure your speed and your tempo, try two or three sensible options, and keep the one that makes your good swing easy to repeat. It won't make you someone you're not, it will make you more yourself. And there's nothing more romantic in golf than a shot that flies exactly like the one you pictured.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Shaft Flex? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Come in with the swing you own. We'll measure your speed and tempo, test a few sensible options, and keep the one that makes your good swing easy to repeat.
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
                    Schedule your Flex & Brand Fitting Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    Better golf is the only status symbol worth chasing.
                </p>
        </div>
        </article>
    </div>
</section>
