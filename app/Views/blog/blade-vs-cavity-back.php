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
                <source src="<?= base_url('serve-audio.php?file=Blade vs cavity-back.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>January 15, 2025</time> • 7 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Blade versus cavity back, the day you stop apologizing to your irons
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Blade vs cavity-back.mp3.json') ?>')
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
                    // Remove bullet characters and ellipsis that might be in the text
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
            
            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Rosa's choice between pride and peace.</h2>
            
            <p style="margin-bottom: 2rem;">
                She kept them as if they were a promise, polished thin top blades and a sun-worn head cover, the kind that make golfers whisper when you set one behind the ball. "Oh, they were my dad's," Rosa said, laying the 7 iron on the bench, "and I'm not ready to give up the look." Her voice had that mix of pride and fatigue you hear when someone's been playing brave golf with the wrong tool for longer than they'll admit.
            </p>

            <p style="margin-bottom: 2rem;">
                We let the room go quiet, the way we always do before a good decision. Grips. Epoxy ferrules. The launch monitor blinking to life. I put a little strip of impact tape on her blade and one on a compact cavity back that matched it for length and lie. Same shaft weight and flex, same swing weight. If we're going to tell the truth, we let the head do the talking.
            </p>

            <div style="text-align: center; margin: 3rem 0;">
                <img src="<?= base_url('images/two ladies.jpg') ?>" alt="Blade vs Cavity Back - Making the Choice" style="max-width: 100%; height: auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            </div>

            <p style="margin-bottom: 2rem;">
                Rosa's best with the blade was art. Flight lower than the clouds, pin-high, like a ruler had drawn it there. But when she was a hair late or a touch thin, the ball fell out of the sky, like it forgot how to be a golf ball. On the face tape, the mark lived half a groove low. She didn't swing badly. She swung like a human.
            </p>

            <p style="margin-bottom: 2rem;">
                Then we put the cavity back down. The address still looked honest to her eye. Sleek enough, not a shovel. Just a touch more soul and a little comfort in the chassis. The first slightly thin strike surprised her. It climbed instead of pleading, carried the front edge and rolled to the middle like it belonged. She looked at the face, then at me, and laughed that half-disbelieving laugh golfers make when mercy shows up where punishment used to live.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's the plain truth without the catalog poetry. Blades, muscle backs, are compact, thin-soled, with minimal offset and mass concentrated behind the center. They reward centered strikes with workability and feedback that feels like a secret handshake. When you miss, they tell the truth fast. Cavity backs move more mass to the perimeter. That raises MOI, resistance to twisting. Makes the sweet spot bigger and keeps ball speed and launch from collapsing on ordinary misses. They're not training wheels. They're forgiveness where you live most often.
            </p>

            <p style="margin-bottom: 2rem;">
                Most golfers don't need a sermon, they need a mirror. If your strike already spends its days on the middle groove and you like drawing and fading shots on purpose, blades will sing to you. If your contact wanders low on a Tuesday after work, a cavity back won't scold you for being human. The modern ones aren't those chunky shovels you remember. They can look calm behind the ball and glide through turf without the digging doom you're afraid of.
            </p>

            <p style="margin-bottom: 2rem;">
                We watched Rosa's swings like a story unfolding. With the blade, the best ball was a photograph you keep in your wallet. With the cavity back, the pattern got kind, the thin miss climbed enough to matter. The toe side nibble didn't yank the shot into exile. Turf went from grabby to glide. Nothing was dramatic. Everything was better. And that's the line I trust in this work. Dramatic is for highlights, better is for scorecards.
            </p>

            <p style="margin-bottom: 2rem;">
                She asked the questions everyone asked, and I gave the answers I always keep close. Will I lose workability? If you already control the center of the face, you can still curve a cavity back. The ball listens because you struck it, not because the head is snobbish. If you don't hit the middle, workability mostly means the ball works away from your target. Do cavity backs fly too high? Many are tuned to launch a touch higher, which is a feature when you need help. We watch your spin and descent angle. If the ball stops on a real green, the window is right. If not, we pick a model loft that tells the truth. What about feel? Blades do talk. Clean, immediate feedback. But feel today is closer than it used to be. Forging methods, face constructions, and polymers have narrowed the gap. The best cavity backs don't sound clattery, they sound complete when you catch one. Turf? A bit more soul can save you from digging, a bit less can save you from bouncing. We choose soul, width, and bounce for your delivery, not for a photograph.
            </p>

            <p style="margin-bottom: 2rem;">
                We finish by making small, unromantic decisions, the kind good golf lives on. A lie angle that kept the toe from writing its own plot. A swing weight that let her feel the head without the head bossing her around. A shaft profile that matched her tempo so she didn't have to swing angrier just to wake the club up. None of it loud, all of it necessary.
            </p>

            <p style="margin-bottom: 2rem;">
                Then the moment I'll remember. She set a cavity back 7 iron down, took a breath, and hit three that looked like sisters. Same window, same fall, same hush after they landed. She slipped the old blade back into her bag with a gentleness you reserve for heirlooms. "I won't forget 'em," she said, "but I'm tired of apologizing to my irons." That's the day you change. Not when you choose power over poetry, but when you realize forgiveness has its own kind of beauty.
            </p>

            <p style="margin-bottom: 3rem;">
                If you're living between pride and peace, if you love the look of a thin top line but your Mondays and Fridays aren't your Saturdays, let us put both dreams on the mat. We'll test where your strike really lives, watch how the turf treats you, and choose the head that makes your average shot better without stealing your best. Keep the romance, add the mercy, play golf that loves you back.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Iron Type? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Let us help you choose between blades and cavity-back irons based on your strike pattern and preferences.
                </p>
                
                <p style="font-size: 1.2rem; margin-bottom: 2.5rem; color: white; font-weight: 600;">
                    <em>Keep the romance, add the mercy, play golf that loves you back.</em>
                </p>
                
                <div style="margin-bottom: 2rem;">
                    <a href="tel:7173871643" class="btn btn-primary" style="background: var(--gold); color: var(--deep-green); font-weight: 700; padding: 1rem 2.5rem; font-size: 1.2rem; text-decoration: none; border-radius: 6px; display: inline-block;">
                        📞 Call (717) 387-1643
                    </a>
                </div>
                
                <p style="font-size: 1rem; color: rgba(255,255,255,0.9);">
                    Schedule your Blade vs Cavity-Back Session<br>
                    In-home, appointment-only service
                </p>
            </div>
        </article>
    </div>
</section>
