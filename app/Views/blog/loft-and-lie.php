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
                <source src="<?= base_url('serve-audio.php?file=Loft & Lie.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>October 17, 2025</time> • 9 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Loft and Lie: The Hidden Compass Inside Every Club
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Loft & Lie.mp3.json') ?>')
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
            
            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The Hidden Compass Inside Every Club.</h2>
            
            <p style="margin-bottom: 2rem;">
                He showed me a 7-iron with a scar on the sole, just a faint crescent where paint had given up to range mats, and he said the sentence I hear a hundred times a year. "I swear my swing's the same. Why does this keep starting left?" He was right-handed, tidy at address, patient at the top, and the ball still walked off the line like it needed to see something on the other side of the fairway.
            </p>

            <p style="margin-bottom: 2rem;">
                In the quiet of the shop, the little things tell the truth. A lie board, a strip of sole tape, a marker line on a brand-new ball. We don't need mysticism for this part, just evidence. He made three swings. The sole mark bit hard toward the toe and the marker line on the ball showed up on the face tilted, not perfectly vertical, leaning like a fence in winter. Upright only a little, but golf is a game where one degree can decide whether you're proud or apologizing.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's the plain English. Lie angle is the angle between the shaft and the ground at address. If it's too upright for your swing, the toe rides up, the heel makes first contact, and because the heel grabs and the face tilts, the ball starts left for right-handed golfers. If it's too flat, the toe digs, the face tilts the other way, and starts right.
            </p>

            <p style="margin-bottom: 2rem;">
                Loft is the face's tilt back from vertical. It sets launch and spin, and together with your speed, creates carry distance. One degree here and there doesn't sound dramatic until your 9-iron and wedge start arguing over who goes 120.
            </p>

            <p style="margin-bottom: 2rem;">
                Back to the bench. I bent his 7-iron one degree flatter just enough to meet his delivery instead of lecturing it. He made three more swings. The sole mark slid towards center. The face mark straightened. The ball started on the flagstick like it had finally read the plan. No new swing, no new shaft, no bargain with his confidence, just a club that stopped whispering left.
            </p>

            <p style="margin-bottom: 2rem;">
                People ask why something so small matters so much. The answer is that lie angle is the club's compass. If the needle points wrong, you can will a shot straight only as long as your courage holds. Over 18 holes, the truth wins. Upright lies will tug you left in a way you only notice when the round is on the line. Flat lies will hold your start line right and make every draw feel like a dare.
            </p>

            <p style="margin-bottom: 2rem;">
                Now about loft, because loft and lie are cousins who always show up together. Loft is your ladder. If two rungs live too close because one club's loft drifted stronger with time or a bend, you get duplicate distances and hard choices. If they live too far apart, you stand over shots with too much club or not enough. Gapping is the dull word for a holy feeling, knowing the 8-iron covers the front and the 9-iron flies to the number without tricks.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's the work we actually do. Measure, don't guess. We read every club in your set on the machine because tolerances from the factory and life on the course move things. A forged head that met a rock can drift. A wedge that's lived in bunkers can soften.
            </p>

            <p style="margin-bottom: 2rem;">
                Lie tests three ways. Lie board with sole tape, marker line test on the ball. The line should stamp the face vertical and contact height on the face. All three should tell the same story.
            </p>

            <p style="margin-bottom: 2rem;">
                Bend carefully. Forged heads move cleanly. Many cast heads move in small, safe amounts. Some models we bend not at all because the risk outweighs the reward. If it shouldn't move, we won't pretend it will.
            </p>

            <p style="margin-bottom: 2rem;">
                Build a ladder. Set loft gapping, typically four to five degrees through most irons, tighter at wedges. Then confirm carry on the monitor with your golf ball. The numbers are the map. Your eyes are the country.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">A Quiet Truth About One Degree.</h2>

            <p style="margin-bottom: 2rem;">
                One degree of lie can move your start line several yards at 7-iron speed. You'll feel it in your miss pattern more than your hero shots. One degree of loft in a mid-iron may gain/lose only a couple of yards, but that couple of yards is how you stop flirting with front edges and back bunkers all day. In wedges, a degree changes spin and trajectory. You can feel. Subtle is not the same as small.
            </p>

            <p style="margin-bottom: 2rem;">
                I tell players to watch for these honest signs. R... You might be too upright if... RH golfer. Start lines live left when you swing normal. Toe marks on the sole, heel scuffs the turf. A good strike still feels like it's arguing with your hands.
            </p>

            <p style="margin-bottom: 2rem;">
                You might be too flat if... RH. Start lines live right, little pushes that don't come back. Heel marks on the sole, toe digs in turf. Your draw lives at the end of a prayer, not a plan.
            </p>

            <p style="margin-bottom: 2rem;">
                Your loft key gapping needs a look if...Two consecutive irons go the same distance too often. Your wedge yardages jump like missing rungs. Your stock swing keeps leaving you on awkward half shots.
            </p>

            <p style="margin-bottom: 2rem;">
                We took his whole set across the machine, couple of irons were a degree upright. Wedges had drifted stronger, less loft than their stamps suggested. We bent the lies to his delivery, restored the loft ladder so every rung sat where the next hand expected it, then walked back to the mat.
            </p>

            <p style="margin-bottom: 2rem;">
                He hit 9 iron, 7 iron, 5 iron, then a wedge. Each ball starting where his eyes were and flying on a story that made sense. It wasn't louder golf, it was clearer golf.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Two cautions worth carrying.</h2>

            <p style="margin-bottom: 2rem;">
                Don't chase a number. D2 swingweight, 34 degrees, 7 iron, 2 degrees up. These are means to an end, not the end. If your start line and height window look right and your dispersion shrinks, your clubs are telling the truth even if the spec sheet offends a forum.
            </p>

            <p style="margin-bottom: 2rem;">
                Recheck after changes. New shafts, different grips, length adjustments, or a season of hard turf can nudge lie/loft. A five-minute check saves two months of second-guessing.
            </p>

            <p style="margin-bottom: 2rem;">
                He left with the smallest smile I know, the kind that belongs to a golfer whose clubs finally agree with his swing. He didn't talk about changing his move, he talked about trusting it. That's what one degree buys you when it's in the right place, permission to play the picture you've always held in your mind.
            </p>

            <p style="margin-bottom: 3rem;">
                If your ball keeps starting on the wrong sentence or your distances read like a book with missing pages, bring us the set you own. We'll measure every club, bend what should bend, and build a ladder that climbs evenly from long iron to lob wedge. And then when you stand over that 7 iron and breathe, the club will stop arguing. It will point where you point, fly how you asked, and land where courage feels like home.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Get Your Loft & Lie Perfect? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Bring us the set you own. We'll measure every club, bend what should bend, and build a ladder that climbs evenly.
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
                    Schedule your Loft & Lie Fitting Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    The club will point where you point, fly how you asked.
                </p>
            </div>
        </article>
    </div>
</section>
