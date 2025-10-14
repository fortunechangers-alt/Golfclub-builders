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
                <source src="<?= base_url('serve-audio.php?file=Hybrids vs Long Irons.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>October 20, 2025</time> • 9 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Hybrids versus long irons, the day your long par 3 stopped feeling like a dare
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Hybrids vs Long Irons2.mp3.json') ?>')
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
            
            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Ben's dilemma: iron pride versus hybrid mercy.</h2>
            
            <p style="margin-bottom: 2rem;">
                The wind at Penn National has a way of telling the truth. Left to right, a little cool, just enough to make a 195-yard par 3 feel like a negotiation. Ben stood over his 4-iron and remembered every thin he'd ever hit. Those low skittering please that never reached the green. The hybrid in his bag felt like a confession. "I don't know which one I am," he said. "An iron guy or a hybrid guy."
            </p>

            <p style="margin-bottom: 2rem;">
                We brought him into the shop to find out. No speeches, just swings. I taped a classic 4-iron and a 4 hybrid to tell the face where the strikes were living. Same length classes he plays, same ball, same man. The room hummed with the quiet noises I love. The little fan over the monitor, the soft clink of ferrules, the rubbery hush of a mat settling after a shot.
            </p>

            <p style="margin-bottom: 2rem;">
                The long iron went first. When Ben found center, the ball flew like it had a spine, purposeful, the kind of flight you imagine when golf commercials get it right. But his ordinary misses lived low on the face. Those fell out of the sky like birds that forgot how to be birds. Then the hybrid, the very next slightly thin strike climbed as if an invisible hand held it up, glided on a higher window and covered the front edge that the iron had missed. He looked at me like he just seen a card trick. "That shouldn't have carried," he said and smiled. Because a mercy still surprises us when we're used to being punished.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's the plain truth without catalog poetry. Hybrids put more weight low and back with a broader soul and a face designed to keep speed on off-center hits. They launch easier, spin enough to hold the green and slide through rough instead of digging. Shaft length sits closer to a fairway wood than an iron, which can add speed for some players. They are built to forgive the misses we actually hit.
            </p>

            <p style="margin-bottom: 2rem;">
                Long irons are compact and honest. They fly lower, pierce wind, and reward a centered strike that the iron had missed. He looked at me like he just seen a card trick. "That shouldn't have carried," he said and smiled, because a mercy still surprises us when we're used to being punished.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's the plain truth without catalog poetry. Hybrids put more weight low and back, with a broader soul and a face design to keep speed on off-center hits. They launch easier, spin enough to hold a green and slide through rough instead of digging. Shaft length sits closer to a fairway wood than an iron, which can add speed for some players. They are built to forgive the misses we actually hit.
            </p>

            <p style="margin-bottom: 2rem;">
                Long irons are compact and honest. They fly lower, pierce wind, and reward a centered strike with a feeling that might be the real reason we all play. The souls are narrower, the center of gravity is higher relative to a hybrid, and the club ask more of your strike quality to get height and carry.
            </p>

            <p style="margin-bottom: 2rem;">
                And because numbers on a soul can mislead, loft is the truth. A 4H from one brand might replace another brand's 3 iron. Typical for hybrids, live around 22 to 24 degrees. Three hybrids around 19 to 21 degrees, but you should check the actual lofts and gap carry distance, not labels. Your set should read like a sentence without missing words.
            </p>

            <p style="margin-bottom: 2rem;">
                The wrong choice isn't a moral failure, it's a tax. If your long irons ask you to be perfect before they'll be kind, your heart will learn to be small on big holes. When, if your hybrid is too upright or too offset for your delivery, you'll fight that quick left that feels like the club turned the page before you finished the sentence.
            </p>

            <p style="margin-bottom: 2rem;">
                That's why we test quietly and carefully what we look at in a long club fit. Strike height on the face. Thin with irons, a hybrid rescues height. High on the face with hybrids. An iron or a lower spinning hybrid profile may tighten things.
            </p>

            <p style="margin-bottom: 2rem;">
                Launch and descent angle. Can you stop a long approach on a normal green? Hybrids should help. Irons must prove they do.
            </p>

            <p style="margin-bottom: 2rem;">
                Start line and curve, hybrids can go left for some players. If lie, loft, shaft are wrong, we adjust until the lefts behave and the rights don't run.
            </p>

            <p style="margin-bottom: 2rem;">
                Turf and rough. Hybrids glide and escape. Irons dig and drive. Your angle of attack and where you play matter more than a forum argument.
            </p>

            <p style="margin-bottom: 2rem;">
                Gapping. We match carry distances so your 5 wood/3H/4H/4. I don't step on each other. It's a ladder, not a pile.
            </p>

            <p style="margin-bottom: 2rem;">
                There's also a middle road that deserves its name. Utility irons, driving irons, hollow body constructions with thin faces and hidden weighting, more help than a blade-style long iron, less wood-like than a hybrid. If your iron needs iron at address but your score needs a cushion, a utility can be the honest handshake.
            </p>

            <p style="margin-bottom: 2rem;">
                Back to Ben. We gave the hybrid a fair chance, then gave the iron every kindness. Shaft profile he liked, swing weight he could feel, lie angle that stopped the toe from writing its own plot twist. His best with the iron remained a postcard, something to admire. His average with the hybrid got kind. Same target window, fewer apologies. And on that left to right breeze at 195, forgiveness isn't a theory. It's a par you get to keep.
            </p>

            <p style="margin-bottom: 2rem;">
                A few truths worth carrying into the week. Judge patterns, not heroes. One perfect bullet with the 3-iron doesn't beat five hybrids finding the green.
            </p>

            <p style="margin-bottom: 2rem;">
                Pick by turf and task. If your course asks for shots from the rough or into elevated greens, hybrids save strokes. If you play in wind and like flight control off the tee, a long iron or utility might be your voice.
            </p>

            <p style="margin-bottom: 2rem;">
                Fit the lefts. If your hybrid wants to go left, we fix lie, loft, shaft, and swing weight until it listens.
            </p>

            <p style="margin-bottom: 2rem;">
                Gap it cleanly. Use loft and measured carry, not the stamp, to build your ladder.
            </p>

            <p style="margin-bottom: 2rem;">
                Fairway arrow, hybrid/utility arrow, longest iron, you're allowed both. Many golfers keep a hybrid for carry and a utility or long iron for tee shots. You're not a brand, you're a bag.
            </p>

            <p style="margin-bottom: 2rem;">
                We walked out to the evening wind and put the two clubs in Ben's hands again. He hit a hybrid that rose, rode the breeze, and sat softly. Then a utility iron we'd built a touch heavier in the handle so it wouldn't run left on him. It flew lower. A tee shot bullet for the par 4s he likes to cut down to size.
            </p>

            <p style="margin-bottom: 2rem;">
                He didn't ask which one he should be. He asked which one belonged on this course. In this season of his swing, that's the only question that matters.
            </p>

            <p style="margin-bottom: 3rem;">
                If you're tired of daring your long par 3s to forgive you, come in. We'll try a hybrid that respects your start lines, a utility that keeps its promises, and a long iron that earns its place. We'll choose the tool that makes your average shot better without stealing your best so the win can tell the truth, and you can answer without fear.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Long Club Solution? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    We'll try a hybrid, a utility, and a long iron. You'll choose the tool that makes your average shot better.
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
                    Schedule your Hybrid vs Long Iron Fitting<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    Answer without fear.
                </p>
            </div>
        </article>
    </div>
</section>
