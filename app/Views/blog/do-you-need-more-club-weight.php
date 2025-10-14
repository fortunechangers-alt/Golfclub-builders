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
                <source src="<?= base_url('serve-audio.php?file=Do You Need More Club Weight?.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>October 15, 2025</time> • 8 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Do you need more club weight? Nate and Ellen, two sides of the weight story
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Do You Need More Club Weight_.mp3.json') ?>')
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
                    const cleanText = text.replace(/[•·]/g, '').replace(/^\d+\.\s*/gm, '').replace(/\.\.\./g, '');
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
            
            <div style="text-align: center; margin: 2rem 0 3rem 0;">
                <img src="<?= base_url('images/girl boy.jpg') ?>" alt="Nate and Ellen - Club Weight Fitting Story" style="max-width: 100%; height: auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            </div>

            <p style="margin-bottom: 2rem;">
                By the time Nate came in, his tempo had a tremor in it. Not nerves, fatigue. He'd been swinging a set that looked fast on paper, feather-light shafts, heads shaved of every gram, grips that felt like air. "I thought lighter meant easier," he said. And then he showed me the flight, a thin that climbed and stalled, a block that held onto the right edge like a ledge. Then, one perfect ball that only showed up when he swung harder than he wanted to.
            </p>

            <p style="margin-bottom: 2rem;">
                Our shop is small and quiet on purpose. When you set a club on the bench, the room tells the truth back. We measured his irons and driver static weight, what a scale sees, and swing weight, how heavy the club feels in motion. The balance between head and hands, Nate's totals were low end. His swing weights too. The numbers only confirmed what his hands already knew. He couldn't feel the head long enough to time it.
            </p>

            <p style="margin-bottom: 2rem;">
                We didn't start with a lecture. We started with two grams, a sliver of head weight on the 7-iron, then another. Two grams is almost nothing to the eye and everything to your sense of the club head, about plus one swing weight point for each approximately two grams at the head. He hit three balls. The first didn't look miraculous. It looked karma. The face arrived like it had an invitation. The thin miss came off the bottom groove, but didn't surrender its carry. His shoulders dropped. "I can feel it," he said, which is another way of saying, "I can trust it."
            </p>

            <p style="margin-bottom: 2rem;">
                We added a touch more to the long iron and this time feathered a small counterweight in the butt of the grip to keep the head presence without letting the downswing feel bossy. At the hands, approximately five grams tends to lower measured swing weight about a point and can smooth over quick transitions. He didn't swing faster. He didn't have to. A better timing showed up. His only job was to keep breathing.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's the unromantic truth that saves a lot of golfers, total weight and swing weight are different levers. Total static weight is the mass you carry for 18 holes. Too heavy and your body tires, the face arrives late, and the end of a round feels like a chore. Swing weight is the balance your hands feel. Add a little at the head and the head feels present. Add at the butt and the system feels steadier. Change length and the lever changes about plus three swing weight points for every plus one-half inch, all else equal. A few grams in the right place can make your swing feel like yours again.
            </p>

            <p style="margin-bottom: 2rem;">
                But it isn't always about more. A week later, Ellen came in with the opposite problem. Her set was honest, maybe a touch too honest. Heavy shafts she loved in her 40s that now made the back nine feel longer than the front. Her best shot still had that round complete sound, but the average ball fell a club short and her misses were late because she was tired.
            </p>

            <p style="margin-bottom: 2rem;">
                We respected what her hands liked, a head she could sense, and we trimmed the total weight responsibly. A lighter shaft, not the lightest. Keep the swing weight in a window that preserved head feel. Remember, shaft weight changes can nudge swing weight on the order of approximately one point per approximately nine grams depending on balance. We left the head weight alone on the scoring irons and gave back a touch of head feel in the long irons so she didn't have to swing harder to hear the same story.
            </p>

            <p style="margin-bottom: 2rem;">
                On the monitor, nothing exploded. It just added up. The end of the round looked like the beginning, and the late face disappeared with her fatigue.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">If you're trying to choose a direction this week, start with what your body and ball flight keep telling you.</h2>

            <p style="margin-bottom: 2rem;">
                Signs you may need a bit more effective head feel or total weight. Your transition feels jittery. The club wants to race from the top. You lose the head. Can't sense it long enough to time the release. Misses balloon or float toe side smudges show up on face tape. Your best shot only appears when you swing harder than you want to.
            </p>

            <p style="margin-bottom: 2rem;">
                Signs you may need a little less total weight or a steadier balance. You're fine for nine holes and fading by 15. You feel late, face open, low bullets or weak blocks when you're tired. The club feels like effort, not rhythm. Hands squeeze more as the day goes on. Recovery swings, punches, control shots are better than full ones.
            </p>

            <p style="margin-bottom: 2rem;">
                Ways we tune it gently. Head weight, lead slivers, tip weights, hot melt-in metal woods about plus one swing weight point per approximately two grams at the head. But counterweight a small weight under the grip, so about minus one swing weight point per approximately five grams to calm quick transitions without killing head feel. Length. A half inch change is a big lever. Roughly plus or minus three swing weight points plus changes to lie strike, use sparingly and test. Shaft weight and profile. Small jumps up or down to match your energy level and tempo. Consider how the shaft balances. Counterbalanced models can keep head feel while trimming total weight.
            </p>

            <p style="margin-bottom: 2rem;">
                None of this is about being strong enough or fast enough. It's about peace. The right weight picture lets you make the motion you already own without bracing, without forcing, without bargaining with your confidence every swing.
            </p>

            <p style="margin-bottom: 2rem;">
                When Nate came back after his round, he didn't bring numbers. He brought a feeling. "My misses didn't scare me," he said. That's what a few grams can do when they're in the right place. Take the drama out of ordinary shots so your courage is free for the ones that deserve it.
            </p>

            <p style="margin-bottom: 2rem;">
                And Ellen, she sent a message I keep on the wall. "The 17th no longer feels like a hill." That's weight telling the truth where it matters, at the end of the day with the match in the balance, with your body asking whether you chose wisely.
            </p>

            <p style="margin-bottom: 3rem;">
                If you're reading this because your tired of guessing, bring us the swing you have. We'll measure static weight and swing weight on the bench. Put a mid-iron and a driver on the mat and test in grams, not guesses. Two here, maybe five there until your tempo and your strike stop arguing. Maybe you need more, maybe less. What you need is yours.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Club Weight? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Bring us the swing you have. We'll measure and test in grams until your tempo and strike stop arguing.
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
                    Schedule your Club Weight Fitting Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    What you need is yours.
                </p>
            </div>
        </article>
    </div>
</section>
