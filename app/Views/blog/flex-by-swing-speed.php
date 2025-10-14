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
                <source src="<?= base_url('serve-audio.php?file=Flex by Swing Speed.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>October 21, 2025</time> • 9 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Flex by swing speed, driver and six iron
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Flex by Swing Speed.mp3.json') ?>')
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
            
            <p style="margin-bottom: 2rem;">
                He came in with two numbers written on a scorecard, 97 Driver speed, six iron speed," he said, a little sheepish like he'd been caught peeking at the answers. "So I'm stiff, right?" He was hoping the math would save him. It almost could.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The numbers that don't lie.</h2>
            
            <p style="margin-bottom: 2rem;">
                We set the driver behind a foam tee in the quiet of the workshop. The hum of the monitor, the faint solvent smell, the small clink of ferrules in a tray. He had that unhurried back swing some golfers are lucky enough to be born with. Not slow exactly, smooth. His first three drives drew a soft question mark in the air. One perfect, one hanging right, one with a little spinny stall at the top. The numbers were honest. The story wasn't finished.
            </p>

            <p style="margin-bottom: 2rem;">
                Flex is not a badge, it's a match. It's how the shaft bends under your speed and then returns under your tempo. That tiny moment at the top when your swing changes direction and the club decides whether to come with you or fight you. Speed pushes the choice one way, tempo pushes just as hard the other. When both forces agree, the face finds the ball on time and the ball flight looks like something you can live with on the 16th tee.
            </p>

            <p style="margin-bottom: 2rem;">
                He set the six iron down next. We kept the head the same and bracket tested two shafts. One a true stiff, firming the tip. The other, a regular that was a hair heavier than most people expect, designed for smooth transitions. The stiff gave him two postcards and three apologies. The heavier regular gave him fewer headlines and far fewer arguments. That's what the right flex does. It makes your good swing repeat without demanding that you become someone else, finding the right flex based on your swing speed.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The speed charts.</h2>

            <p style="margin-bottom: 2rem;">
                Below are the typical windows, driver and six iron, so you have a map before you walk in. They're guidelines, not laws. Brands label differently, profiles vary. Your tempo can push you up or down a rung. Read these like road signs, then test.
            </p>
            
            <p style="margin-bottom: 2rem;">
                Driver club head speed, typical flex. Under 75 miles per hour, L, ladies. 75 to 85 miles per hour, AM, senior amateur. 85 to 95 miles per hour, R, regular. 95 to 110 miles per hour, S, stiff. 110 plus miles per hour, X, extra stiff. TX, tour extra. Only when very high speed meets a decisively aggressive transition, and even X feels like it's folding on you.
            </p>

            <p style="margin-bottom: 2rem;">
                Six iron club head speed rough cues. Under 60 miles per hour, L. 60 to 70 miles per hour, AM. 70 to 80 miles per hour, R. 80 to 90 miles per hour, S. 90 plus miles per hour, X. Consider Texas only if your transition truly mulls the shaft.
            </p>

            <p style="margin-bottom: 2rem;">
                Why list both? Because the driver tells us how fast you can move when the club is long and the ball is teed, while the six iron tells us how your speed and delivery live when the club is shorter and the strike has to be clean. If the two windows disagree, tempo is usually the tiebreaker.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Beyond the numbers, what else matters?</h2>
            
            <p style="margin-bottom: 2rem;">
                Labels aren't standardized. One brand's stiff can feel like another brand's firm regular. Feel the shaft bend and return in your hands.
            </p>
                
            <p style="margin-bottom: 2rem;">
                Weight matters as much as flex. A 65 gram stiff with a friendly mid-section may be easier than an 80 gram regular with a locked tip. Get weight right first. Flex will make sense after.
            </p>
                
            <p style="margin-bottom: 2rem;">
                Profile matters. Where it bends but mid dog tip changes how the shaft loads for you. Smooth transitions often love mid-soft tip stable designs. Snap and go transitions often need firmer tips so the face doesn't show up late.
            </p>
                
            <p style="margin-bottom: 2rem;">
                TX isn't a trophy. It's a tool for a very small slice of players. If you aren't already overpowering an X and timing it easily, TX will cost you more than it gives.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">What the wrong flex feels like.</h2>

            <p style="margin-bottom: 2rem;">
                Too soft. The head arrives early. Right-handers see left starts that keep turning. Flight climbs and stalls. Under pressure, the timing turns whippy.
            </p>
            
            <p style="margin-bottom: 2rem;">
                Too stiff. The club won't load. Flight flattens and leans right. You swing harder just to wake it up. Impact feels boardy, like the shaft didn't want to help.
            </p>

            <p style="margin-bottom: 2rem;">
                And the right one? The right one makes you breathe out. You feel the shaft gather elastic, not wobbly, and then nudge the face back to the ball on time. Your swing doesn't feel different, it feels clear.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Testing at home.</h2>

            <p style="margin-bottom: 2rem;">
                If you're working on this at home, here's an honest way to test without turning the range into a laboratory.
            </p>
            
            <p style="margin-bottom: 2rem;">
                Bracket by speed. If your driver's speed is approximately 97 miles per hour and your six iron is approximately 82,Test R heavy versus S friendly, with the same head and length.
            </p>

            <p style="margin-bottom: 2rem;">
                Watch patterns, not heroes. 10 balls with each, toss the two strangest. Which window is calmer? Which miss is kinder?
            </p>
                
            <p style="margin-bottom: 2rem;">
                Mind the six iron. If the six iron begs for stiff but the driver's a wash, you likely need a more stable profile, firmer tip, or a touch more weight rather than jumping all the way to a boardy X in the driver.
            </p>
                
            <p style="margin-bottom: 2rem;">
                Don't chase spin with flex alone, loft, face tech, and strike point drive spin as much as flex. Fix strike first, back to our scorecard guy.
            </p>
                
            <p style="margin-bottom: 2rem;">
                With driver at 97 and six iron at 82, the chart says stiff. His tempo said don't over tighten. In the bay, the heavier regular read his rhythm better, launch settled, spin stopped arguing, and the miss got boring. That's a compliment.
            </p>

            <p style="margin-bottom: 2rem;">
                We left his driver in a friendly, stiff profile midsection that let him load tip that didn't give up. The numbers matched the map. The feel made the map worth following.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Key takeaways.</h2>
            
            <p style="margin-bottom: 2rem;">
                You don't have to swing angrier to earn a stiffer shaft. If the club fits, it will meet you where you already live.
            </p>
                
            <p style="margin-bottom: 2rem;">
                If you're between sizes, fit the six iron first. It's the truth serum of the set. Get the iron right, then echo that, feel up the bag.
            </p>
                
            <p style="margin-bottom: 2rem;">
                TX is a yes or no question. If you're wondering, the answer is no. If you're a Texas golfer, you already know. You've been folding X without trying.
            </p>
                
            <p style="margin-bottom: 2rem;">
                The best shaft won't make you someone else, it will make you easier to repeat.
            </p>

            <p style="margin-bottom: 2rem;">
                He came back after a week and didn't brag about a single 320-yard outlier. He told me his 10-yard window looked the same all day. That's what the right flex by speed and tempo buys you, not fireworks, but fidelity.
            </p>

            <p style="margin-bottom: 3rem;">
                If you're done guessing, bring us a swing you own. We'll measure driver and six iron speed, read your tempo, bracket two or three sensible builds, and keep the one that turns your best swing into a habit.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Flex by Swing Speed? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    We'll measure your driver and six iron speed, read your tempo, and bracket sensible builds.
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
                    Schedule your Flex Fitting Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    Not fireworks, but fidelity.
                </p>
            </div>
        </article>
    </div>
</section>
