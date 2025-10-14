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
                <source src="<?= base_url('serve-audio.php?file=The Golfer Who Found Trust in His Shaft 2.mp3') ?>" type="audio/mpeg">
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
                The golfer who found trust in his shaft
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/The Golfer Who Found Trust in His Shaft 2.mp3.json') ?>')
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
            
            <p style="margin-bottom: 2rem;">
                The bucket was almost empty when the first ball finally obeyed. It didn't launch higher than the treeline or leak into the gray of late afternoon. It rose on a quiet arc, held its line, and fell with a soft, certain thud. "Same swing as the ones before," he swore. Same pre-shot routine, same breath, same target. So why did this one behave?
            </p>

            <p style="margin-bottom: 2rem;">
                When he walked into our in-home shop, a small room that smells like epoxy and clean steel, a little haven of lie boards, ferrules, and a launch monitor humming like a steady heart, he didn't ask for a miracle. He asked for something far more human and far harder to fake, trust. "I just wanna swing once," he said, "and know what I'm going to get."
            </p>

            <p style="margin-bottom: 2rem;">
                We started where trust begins, with feel. He handed me his 7-iron. I handed him a question. "When you miss, what does it feel like? Whippy or boardy?" He grimaced. "Both. Some days it's a fishing rod, some days a broomstick."
            </p>

            <p style="margin-bottom: 2rem;">
                People talk about flex like it's a label on a shirt, but shaft flex is a conversation between your swing and the club. It's how the shaft bends during your move and kicks back before impact. When that conversation is in tune, when your speed and your tempo match the shaft's personality, the face returns more square, the launch and spin live in a believable window, and your hands get the same story every time. When it's out of tune, the club and your timing argue all afternoon.
            </p>

            <p style="margin-bottom: 2rem;">
                Too soft, and the head has a habit of arriving early. Shots climb high, spin more than they should. And for a right handed golfer, the ball can start left and go more left as the face closes too soon. Too stiff, and it's as if the shaft refuses to come with you. Flight turns flat and low. The right side of the range gets a lot of attention. And the sensation at impact is a little like swinging a metal rod through rain. Almost everyone recognizes both extremes because almost everyone has lived there for at least a round or two.
            </p>

            <p style="margin-bottom: 2rem;">
                I set his 7-iron on the bench, logged the build details, and asked for ten swings. Five "don't think, just swing" shots, and five with a simple cue he used when he was playing well. On the monitor, the story came out in numbers. Ball speed steady, spin scattered, face angle wandering by degrees that look small on a spreadsheet and feel enormous in a fairway. Then we swapped only the shaft. Same head, same length, same grip. And asked the same swing the same question.
            </p>

            <p style="margin-bottom: 2rem;">
                The first ball with the new shaft sounded different. There's a note to center face contact that isn't loud so much as it is complete. He looked back at me with the smallest laugh, half disbelief, half relief. The arc settled into the air like it belonged there. That's the moment you see it click. Not some myth of perfect technique, but the practical peace of matched gear. Your body stops bracing against surprises.
            </p>

            <p style="margin-bottom: 2rem;">
                This is usually where people ask for a rule. Here are the only ones I trust. Your tempo matters as much as your speed, and labels are not laws. The common ladder runs L, Ladies, A, M, Senior, Amateur, R, Regular, S, Stiff, X, Extra stiff, and TX, Tour extra. TX isn't a badge of honor. It's a tool for a very specific kind of player. Tour level speed and a strong, aggressive transition. Plenty of fast golfers live their best golf in S or X because their tempo is smooth. Plenty of average speed golfers need a touch firmer in the tip because their transition is sharp. There are no bribes you can pay a shaft to make you. It has to meet you where you swing.
            </p>

        <!-- Flex Matters Image -->
        <div style="text-align: center; margin: 3rem 0;">
            <img src="<?= base_url('images/Flex Matters.jpg') ?>" 
                 alt="Flex Matters - Professional shaft flex fitting and analysis" 
                 style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"
                 loading="lazy">
            <p style="font-size: 0.9rem; color: #666; margin-top: 0.5rem; font-style: italic;">
                Professional shaft flex analysis in action
            </p>
        </div>

        <!-- Straight and True Image -->
        <div style="text-align: center; margin: 3rem 0;">
            <img src="<?= base_url('images/Straight and true.jpg') ?>" 
                 alt="Straight and True - Perfect shaft alignment and ball flight" 
                 style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"
                 loading="lazy">
            <p style="font-size: 0.9rem; color: #666; margin-top: 0.5rem; font-style: italic;">
                The result of proper shaft fitting - straight and true ball flight
            </p>
        </div>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">So how do you know right now, without a fitting cart in your trunk, if your flex is wrong?</h2>

            <p style="margin-bottom: 2rem;">
                Start with the pattern your eyes already know. If your misses are consistently high and spinny, if they start left and turn more left, again, for right handers, if the club feels like it's snapping before your hands are ready, you're probably living on the soft side. If your flight is habitually low and flat, if you fight blocks and slices, if you only get the ball moving when you swing harder than you want to, you're probably living on the stiff side. Neither is a character flaw. Both are a mismatch.
            </p>

            <p style="margin-bottom: 2rem;">
                Then listen to your body. A good flex lets you breathe. You feel the club load during the transition, an elastic gather rather than a wobble, and then you feel it return. Not like a slap, but like a quiet nudge that helps the face arrive on time. The wrong flex makes you play defense. You squeeze a little tighter. You guard the face. You try to save shots with your hands. Over eighteen holes, that strain writes a story you don't want to keep reading.
            </p>

            <p style="margin-bottom: 2rem;">
                Back at the bench, I gave him a few anchors he could keep. Think of these as honest heuristics, not commandments carved on a shaft label.
            </p>

            <ul style="margin-bottom: 2rem; padding-left: 2rem;">
                <li style="margin-bottom: 1rem;"><strong>Soft side clues.</strong> High, ballooning flight. Left tilting curve for right handers. Timing feels whippy. Toe side contact shows up when the head outruns your hands.</li>
                <li style="margin-bottom: 1rem;"><strong>Stiff side clues.</strong> Low, flat bullets. Right tilting curve for right handers. No kick feel. Heel side skims as you fight the face back to square.</li>
                <li style="margin-bottom: 1rem;"><strong>Tempo first.</strong> Smooth transitions can live happily in softer options. Snappy transitions crave firmer control.</li>
                <li style="margin-bottom: 1rem;"><strong>TX reality check.</strong> It's there for very fast, very strong transitions. Most golfers won't swing better with it, even if the ego likes the label.</li>
        </ul>

            <p style="margin-bottom: 2rem;">
                We circled back to the range story that brought him in. Same swing, he'd said. And maybe it was. But the club had been speaking a different language on every shot. With a shaft whose flex and weight matched his move, nothing exotic, nothing heroic, his swing didn't change. His timing did. And timing is what golf is after all. The moment your intention and your motion share a single beat.
            </p>

            <p style="margin-bottom: 2rem;">
                He stuck around after we finished building the test club. I watched from the doorway as he set three balls down and let the evening have them. The first rose and fell on a line you could draw with a pencil. The second and third traced the same window. No fist pumps. No drama. Just a small, private nod between a golfer and his tools. I've seen that nod a thousand times, and it never gets old.
            </p>

            <p style="margin-bottom: 2rem;">
                Maybe that's why I love this work. Clubs aren't magic, and neither are we. We're human beings with hands and habits and hopes, trying to make a game we care about a little more honest. The right shaft flex won't turn you into someone you're not. It will let the best version of your swing show up more often and with less fight. And that to me is romance enough. The humble grace of a shot that flies like the picture you held in your mind.
            </p>

            <p style="margin-bottom: 3rem;">
                When you're ready, bring us the swing you already own. We'll measure your speed and your tempo. Test a couple of flexes on the same head. Watch your start lines, your curves, your strike. And then we'll build toward the one that tells the same story every time. That's all trust is. Repetition with a heart.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Shaft Flex? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Bring your swing. We'll measure your speed and tempo, test flexes on the same head, and build toward the one that tells the same story every time.
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
                    Schedule your Shaft Flex Fitting Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    That's all trust is. Repetition with a heart.
                </p>
        </div>
        </article>
    </div>
</section>
