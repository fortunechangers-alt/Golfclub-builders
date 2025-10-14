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
                <source src="<?= base_url('serve-audio.php?file=Graphite vs Steel Shafts.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>October 16, 2025</time> • 9 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Graphite versus steel shafts, finding the sound your hands believe
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Graphite vs Steel Shafts.mp3.json') ?>')
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
            
            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The golfer who discovered his hands could sing.</h2>
            
            <p style="margin-bottom: 2rem;">
                He rubbed the inside of his elbow with his thumb, the way carpenters rub a nick in their favorite chisel, absently, like an old habit. "I've always played steel," he said, setting a seven iron on our bench. "Feels honest. But by the 12th hole, my forearm hums." He grinned like a man saying something half forbidden. "My daughter told me to try graphite. Said I'm stubborn."
            </p>

            <p style="margin-bottom: 2rem;">
                In the quiet of the shop, you can hear truths arrive. Epoxy settling, the little fan over the launch monitor, a shaft laid down along the grain of the mat. We taped his current seven iron and a graphite-shafted twin. Same head, same length, same swing weight, because the head should tell the story first. He hit three with steel. The best one rang like a bell, a low round note you can feel in your teeth. The thin miss stung a bit. He shook his right hand once and laughed, "That's the one I remember."
            </p>

            <p style="margin-bottom: 2rem;">
                Then the graphite. The sound was softer, the kind of thud a pillow makes when it lands square. And the sting didn't show up. Ball flight, not a miracle. Just a few more shots that climbed into a believable window and stayed there. He stared at the screen and then at the club like he'd been caught liking a song he swore he'd never listen to.
            </p>

            <div style="text-align: center; margin: 3rem 0;">
                <img src="<?= base_url('images/FEELS LIKE CHEETING.jpg') ?>" alt="Graphite vs Steel Shafts - Finding Your Perfect Fit" style="max-width: 100%; height: auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            </div>

            <p style="margin-bottom: 2rem;">
                "Here's what matters," he said plainly, "Graphite is lighter and soaks up more vibration. In irons that can mean a touch more club head speed for some golfers and a lot less arm fatigue for many. Modern graphite isn't the wobbly stuff you remember. It comes in real weight classes, 80s, 90s, 100 plus grams, and can be built with firm tips and low torque that feel surprisingly steel honest. It's why graphite is standard in drivers, fairways, and hybrids. Speed and comfort matter when the club is long.
            </p>

            <p style="margin-bottom: 2rem;">
                Steel's heavier, simple, and wonderfully consistent. Many players love its feedback, clean and immediate, like the club speaks a little louder about what you did. Heavier total weight can steady a quick transition and tighten dispersion for certain swings. If you like the feeling that the club won't get ahead of you, steel can feel like a friend who walks at your pace. The choice isn't a morality play. It's a conversation with your body."
            </p>

            <p style="margin-bottom: 2rem;">
                He took another run at it. With steel, his best was still the prettiest. A line with spine. The ball landing like it meant to. But by the eighth swing, the low on the face miss got a little flatter, and the right side of the range got busy. With graphite, his best looked nearly the same. What changed was the average. More shots in the window, less flinch in his forearm. A little less bargaining with himself before starting back.
            </p>

            <p style="margin-bottom: 2rem;">
                We talked through the levers... We can actually move to- Total weight versus swing weight. Total weight is the load you carry for 18 holes. Swing weight is how heavy the club feels in motion. You can choose a 95 to 105 gram graphite iron shaft and keep the head feel you trust, or 105 to 120 gram steel and soften the handle with a grip that fits your hands. One is not better. One is yours.
            </p>

            <p style="margin-bottom: 2rem;">
                Tempo decides as much as speed. A smooth unhurried transition can live happily in lighter builds, graphite or steel. A snappy, punchy transition often likes a little more heft or a firmer tip so the face doesn't arrive late.
            </p>

            <p style="margin-bottom: 2rem;">
                Pain's a data point, not a weakness. If tennis elbow or hand numbness is part of your story, graphite's damping isn't a luxury. It's how you make golf last. Comfort is performance over 18.
            </p>

            <p style="margin-bottom: 2rem;">
                Blends are smart. Many golfers run graphite in long slash mid-irons and keep steel in the short irons or wedges. Others go one family all the way through so the set sings in one voice. Both can be right.
            </p>

            <p style="margin-bottom: 2rem;">
                He asked the honest questions, the ones that decide Saturdays. Will I lose control if I go graphite? Not if the weight and profile are right. We can pick a mid-weight graphite with a stable tip that lands in the same dispersion window as your steel, only with less sting and less end-of-round fatigue. Will steel hurt me less if I just try harder? Sometimes more effort's exactly what ruins a good swing. If the pain shows up on 12 and your face starts arriving late on 14, the shaft isn't a character test, it's a tool. The right tool makes the job feel like flow again. What about wedges? Plenty of players stay in steel down low for flight control and feel. If comfort is the priority, graphite and wedges is completely legitimate. Just test distance, control, and spin with your golf ball.
            </p>

            <p style="margin-bottom: 2rem;">
                I set two clubs in his hands, one 105 gram graphite, one 110 gram steel, and told him we'd let his body choose. He hit five with each, rested between sets, then hit five more. With steel, the good ball was the same kind of good and the average got a little worse as he tired. With graphite, the good ball didn't get better, the bad ball got kinder. And by the time he would normally feel that quiet ache in his forearm, he didn't. "Feels like cheating," he said smiling, but it wasn't the smile of someone getting away with something. It was relief. He wasn't changing who he was. He was picking a tool that made his swing possible for longer than his memories.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's what I tell anyone standing where he stood. Judge patterns, not heroes. The best shot isn't the truth. 10 average shots are. Weight first, then flex profile. If the club's load suits your energy level, everything else gets easier. Your hands know... If your grip pressure softens and your breath slows with one choice, that's your future talking. Ego is expensive. No one at the turn cares what your shaft is made of. They care where your ball lands.
            </p>

            <p style="margin-bottom: 2rem;">
                He left with a graphite seven iron to play for a week. Same head, same length, same swing weight we kept in steel, because the course is the only laboratory that matters. When he came back, he didn't have a single monster number to brag about. He had a scorecard that looked quiet. Fewer saves from the trees, fewer bargains with himself on 15. "I wasn't tougher," he said. "I was okay all day."
            </p>

            <p style="margin-bottom: 2rem;">
                That's the whole idea. Not miracles. Not arguments. Just clubs that meet your swing where it lives in a round that feels like one long honest sentence.
            </p>

            <p style="margin-bottom: 3rem;">
                If you're carrying a small ache and a big suspicion that your shafts are part of it, bring the swing you own. We'll build two twins, one steel, one graphite, in the right weights and let you feel the difference without noise. If control lives in steel for you, we'll know. If longevity and calm live in graphite, we'll know that too. Either way, the answer won't come from a label, it'll come from your hands. When you're ready, call 717-387-1643 and ask for a shaft material session. Graphite versus steel. In-home appointment only. We'll listen to the only two experts that matter, your ball flight and your body.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Shaft Material? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    We'll build two twins—one steel, one graphite—and let you feel the difference. The answer will come from your hands.
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
                    Schedule your Shaft Material Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    Just clubs that meet your swing where it lives.
                </p>
            </div>
        </article>
    </div>
</section>
