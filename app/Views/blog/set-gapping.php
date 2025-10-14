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
                <source src="<?= base_url('serve-audio.php?file=Set Gapping.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>October 19, 2025</time> • 9 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Set gapping, the night your bag became a ladder
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('audio/Set Gapping.mp3.json') ?>')
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
            
            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The night your bag became a ladder.</h2>
            
            <p style="margin-bottom: 2rem;">
                He walked in with a tidy set and a messy story. Evan is the kind of golfer who keeps his grips clean, his yardage book dog-eared, his hopes reasonable. "I can't tell the difference between my 8-iron and 9-iron anymore," he said, not angry, just tired. "And my wedges feel like strangers. One flies forever, the next sits down like a scared rabbit."
            </p>

            <p style="margin-bottom: 2rem;">
                We dimmed the lights the way we always do, not to be dramatic, but to let the screen and the swing do the talking. There's a heartbeat to a builder's shop at night. Fans, the soft click of the launch monitor, a ferrel tapping the bench like a metronome. I put impact tape on his 9-iron and 8-iron, then the pitching wedge, gap and sand. Same ball, same swing. We asked for 10 shots with each club, normal swings, not audition swings, and we threw out the outliers without ceremony.
            </p>

            <p style="margin-bottom: 2rem;">
                Then the truth appeared in numbers that were somehow gentler than the scorecard had been. His 9-iron and 8-iron carried within 3 yards of each other. His gap wedge and sand wedge were a full club apart, like cousins who'd stopped talking.
            </p>

            <p style="margin-bottom: 2rem;">
                People think gapping is a spreadsheet thing. It isn't. It's a peace of mind thing. Your bag should read like a ladder you can climb, even rungs, no missing steps, no duplicates. On the course, it feels like this. You stand over a number, and you already know which club says, "I've got this," not, "I might have this if the wind remembers to help."
            </p>

            <p style="margin-bottom: 2rem;">
                We started where gapping actually lives, carry distance, not total. Total changes with firm greens and cheeky slopes. Carry is the honest part. "Hit your normal," I told Evan, and he did, the way he would on a Tuesday evening with friends who tell the truth. His averages stacked up like a sentence with some words repeated and some words missing. We didn't scold the swing. We looked at the tools.
            </p>

            <p style="margin-bottom: 2rem;">
                There are a dozen ways a ladder gets crooked. Modern, strong, loft sets that stretch the top and crush the middle, a pitching wedge stamped 45 degrees pretending it's an old 9-iron, a gap wedge that never got the memo, a sand wedge with a heavy head that launches high but goes sleepy in wind. Sometimes it's simpler, a factory tolerance drifted or a loft moved a degree after a year of hard turf, or two clubs that were supposed to be four degrees apart were, in fact, two.
            </p>

            <p style="margin-bottom: 2rem;">
                We rolled the loft lie machine to the bench. This isn't magic; it's manners. We measure every club, not just the suspects. Evan's 8-iron had crept half a degree stronger, the 9-iron half a degree weaker, and there was the overlap he'd been living with. Two rungs trying to occupy the same space.
            </p>

            <p style="margin-bottom: 2rem;">
                Down in the scoring end, his pitching wedge was a modern 45 degrees, the gap wedge a soft 50 degrees, and the sand wedge a true 56 degrees. That's a fine spec if the carries live 12 to 15 yards apart. His didn't. The 50th and 56th were a chasm. His half swings were guesswork. His full swings felt like dice.
            </p>

            <p style="margin-bottom: 2rem;">
                We bent the 8-iron and 9-iron into honest distance separation. No bravado, just the degrees they were meant to be. Then we rebuilt the wedge ladder the way I like to see it when a golfer wants clarity, 46 to 48 degrees for the pitching wedge, depending on the set. Then a 50 to 52-degree gap wedge, then 54 to 56 degrees, and finally, 58 to 60 degrees with the actual choices driven by the course, tight lies versus lush, firm versus soft, and the player, steep versus shallow, full swing versus partial. We didn't chase even numbers. We chased even carries.
            </p>

            <p style="margin-bottom: 2rem;">
                Back on the mat, we mapped reality. Ten ball sets, quietly. Pitching wedge, full and three-quarter. Gap wedge, full, three-quarter, and a little chippy, nine-to-three motion. Sand wedge, same dance. The monitor doesn't need to shout. It just needs to be repeated. The pattern finally showed up like railroad ties. 8-iron here, 9-iron 12 yards below, pitching wedge another 10 down, gap wedge another 12, sand 10 more, lob the last. No duplicates. No missing steps. Evan didn't grin. He exhaled. That's the tell in this work.
            </p>

            <p style="margin-bottom: 2rem;">
                If you've never done it this way, here's the simple version you can take to the range this week. Measure carries, not totals. Ten balls per club, normal swing, same ball. Toss the two strangest. Write down the average carry and the height.
            </p>

            <p style="margin-bottom: 2rem;">
                Look for duplicates and gaps. Two irons the same distance, a wedge jump that's a cliff, circle them.
            </p>

            <p style="margin-bottom: 2rem;">
                Check the spec, then the feel. Loft and lie tell you the map. Your hands tell you if the club is asking for something you don't have.Fix with tools, not hope. A first loft change can separate siblings. A lie adjustment can stop a start line from lying to you. A different wedge loft can stitch the scoring end into a sentence. You can actually read under pressure.
            </p>

            <p style="margin-bottom: 2rem;">
                Name the partials. Own a three-quarter wedge that flies a number on purpose. Own a 9 to 3. Don't audition them on 16, learn them on a mat where your heartbeat isn't quite so loud.
            </p>

            <p style="margin-bottom: 2rem;">
                Evan asked what everyone asks when the ladder looks straight: What about bounce and grinds? I told him the part I believe most, the sole is your turf insurance. Your attack angle and turf decide the bounce, not a catalog photo. If you're steep on soft ground, more bounce saves your sole. If you're shallow on tight lies, a slimmer sole keeps the leading edge from scaring you. But distance gapping lives in lofts and swings. First, build the ladder, then pick the shoes you wanna climb it in.
            </p>

            <p style="margin-bottom: 2rem;">
                We took one last reading, 9 iron at a carry he could count on, 8 iron at a believable step above, then the wedges, each one a sentence fragment that added up to a paragraph he could use. He didn't ask for miracles anymore. He asked for numbers he could love. That's the quiet romance of gapping, knowing how far your swing goes before you try to write poetry with it.
            </p>

            <p style="margin-bottom: 2rem;">
                Out on the course a week later, Evan texted me in the small voice golfers save for good news, "112 yards. Knew it was the gap wedge. Didn't think, just swung." That's what fairness feels like in golf. Not fireworks, just stories that read straight through.
            </p>

            <p style="margin-bottom: 3rem;">
                If your 8 and 9 keep arguing, if your 54 degrees and 58 degrees don't talk, if your half swings feel like auditions, bring the bag you own. We'll measure every loft and lie, bend what should bend, and map carries with your ball until your ladder climbs evenly from long iron to lob wedge. Then we'll write the three partials you actually use and leave the heroics to Saturday mornings.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Fix Your Set Gapping? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    We'll measure every loft and lie, bend what should bend, and map carries until your ladder climbs evenly.
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
                    Schedule your Set Gapping Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    Stories that read straight through.
                </p>
            </div>
        </article>
    </div>
</section>
