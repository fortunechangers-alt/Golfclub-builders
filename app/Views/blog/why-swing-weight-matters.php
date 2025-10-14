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
                <source src="<?= base_url('serve-audio.php?file=When the Club Found its Weight.mp3') ?>" type="audio/mpeg">
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
                When the club found its weight and he found his swing
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/When the Club Found its Weight.mp3.json') ?>')
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
            
            <p style="font-size: 1.2rem; margin-bottom: 2rem; color: #555; font-style: italic;">
                He kept the bucket under the bench like a secret. Late after work, lights humming over the range, Cal lined up a 7-iron the way he had a thousand times—feet squared, breath held, jaw set. The first ball started on the flag and then, like so many lately, faded weak and fell short. The next went higher but thinner, a stinging reminder in his hands. He wasn't lost, exactly. Just… untethered.
            </p>
            
            <p style="margin-bottom: 2rem;">
                Truth was, Cal hadn't changed much. Two kids, long days, less practice. But something about his irons felt different—floaty on good days, jittery on bad ones, as if the head arrived a fraction early or late and he was always negotiating at impact. He blamed tempo, grip pressure, tempo again. He never blamed the clubs. His father had taught him that the club is honest; it tells you the truth. So when it lied every third swing, Cal wondered if the lie was his.
            </p>

            <p style="margin-bottom: 2rem;">
                A friend insisted: "Go see the builder."
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The Discovery</h2>
            
            <p style="margin-bottom: 2rem;">
                The workbench was a shrine to small miracles—solvent and ferrules, a rack of heads winking under fluorescent light, a swing-weight scale like a quiet judge. The builder measured Cal's irons and raised an eyebrow. The 7-iron sat at D0, the 9-iron at D4, the 5-iron barely C9. Not broken. Not ideal. A set that would ask for three different tempos in three different places.
            </p>

            <p style="margin-bottom: 2rem;">
                "Let's try something," the builder said, soft as a confession. He added two tiny squares of weight—four grams total—to the back of the 7-iron. A little rule of thumb: around +2 grams at the head ≈ +1 swing-weight point. The scale settled at D2. "Swing this."
            </p>

            <p style="margin-bottom: 2rem;">
                Cal did, and the sound changed. <em>Thunk</em>, not clink. The ball climbed and held a truer line. It wasn't farther. It was cleaner. The second swing started slightly on the toe—and still flew useful. His left eyebrow lifted without permission.
            </p>

            <p style="margin-bottom: 2rem;">
                "What did you do?"
            </p>

            <p style="margin-bottom: 2rem;">
                "Gave your hands something to follow," the builder said. "Right now your long irons feel too light—they run ahead of your body and you're chasing them with your hands. The short irons feel too heavy—you steer them. We'll meet you in the middle."
            </p>

            <div style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 2rem; border-radius: 12px; margin: 2rem 0; border-left: 4px solid var(--deep-green);">
                <h3 style="color: var(--deep-green); margin-top: 0;">Understanding Swing Weight</h3>
                <p style="margin-bottom: 1rem;">Swing weight is not total weight. It's how heavy the club feels while swinging, the balance of head vs. handle, measured on a 14-inch fulcrum swing-weight scale.</p>
                
                <!-- Swing Weight Image -->
                <div style="text-align: center; margin: 2rem 0;">
                    <img src="<?= base_url('images/Swing weight matters.jpg') ?>" 
                         alt="Swing Weight Matters - Professional club fitting and swing weight measurement" 
                         style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"
                         loading="lazy">
                    <p style="font-size: 0.9rem; color: #666; margin-top: 0.5rem; font-style: italic;">
                        Professional swing weight measurement in action
                    </p>
                </div>
                
                <ul style="margin: 0; padding-left: 1.5rem;">
                    <li>Add ~2g at the clubhead → +1 swing-weight point</li>
                    <li>Add ~5g at the grip/butt → −1 swing-weight point</li>
                    <li>Change ~9g in shaft weight → ≈1 point</li>
                    <li>Change ½ inch of length → ≈±3 points</li>
                </ul>
            </div>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The Transformation</h2>
            
            <p style="margin-bottom: 2rem;">
                They moved in small steps. A couple grams at the head here, a half-point there. Heavier grip on the wedge to steady the hands (add roughly +5 g in the grip ≈ −1 point on the scale, a neat counterbalance trick). No lectures, no jargon storm. Just hits and quiet yes or quiet no. When he tried too heavy—a clumsy D6—his transition got thick and late, like he was dragging luggage through mud. So they backed away. When it was right—D2–D3 in the mid-irons, a whisper more in the wedge—the club felt like it waited for him, then went with him.
            </p>

            <p style="margin-bottom: 2rem;">
                On the walk to the car, the range lights buzzed, the grass wore that summer-night perfume men remember for years. Cal set a ball down one more time with the tuned 7-iron. His practice swing had a new metronome in it. He didn't try to make speed; he let weight make timing. The ball leapt, rose on the flag, and sat. He laughed—not loud, but from somewhere old and good.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The Results</h2>
            
            <p style="margin-bottom: 2rem;">
                Over the next few weeks, the changes proved real. His worst swings weren't catastrophic. His best ones stopped feeling like accidents. The 5-iron that used to skid and leak right now started on line and stayed brave. The wedge that once dove left when he got handsy now held the face and clipped shots with a proper flight. Yardages got honest. And with honesty came something men don't talk about enough: relief. The relief of not explaining yourself to a game that doesn't listen.
            </p>

            <p style="margin-bottom: 2rem;">
                Swing weight didn't turn Cal into someone else. It took who he already was—the tempo he had, the strength he'd kept—and made it repeatable. There's romance in distance, sure. But there's a deeper romance in trust. When the club's weight is right, you stop bargaining with impact. You stop flinching. You just swing.
            </p>

            <div style="background: #f8f9fa; padding: 2rem; border-radius: 12px; margin: 3rem 0; text-align: center; border: 2px solid var(--deep-green);">
                <h3 style="color: var(--deep-green); margin-top: 0; font-size: 1.5rem;">Is Your Swing Weight Right?</h3>
                <p style="margin-bottom: 1.5rem; font-size: 1.1rem;">If you've had that floaty-then-heavy feeling, if your mid-iron goes to two different places with the same swing, if you've been blaming grip pressure and tempo for months—maybe your swing is fine. Maybe your balance is off.</p>
            </div>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Balance? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Bring your set. We'll measure where you are, move in two-gram footsteps, and let the ball tell us when it's right. You don't need a new you. You need a club that keeps its promise.
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
                    Schedule your Swing-Weight & Build Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    So Saturday morning feels like yours again.
                </p>
            </div>
        </article>
    </div>
</section>