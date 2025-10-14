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
                <source src="<?= base_url('serve-audio.php?file=Grip Size %26 Feel.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>October 18, 2025</time> • 9 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Grip, size and feel the day your hands stop fighting the club
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Grip Size %26 Feel.mp3.json') ?>')
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
            
            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">The day your hands stop fighting the club .</h2>
            
            <p style="margin-bottom: 2rem;">
                She showed me her palms like a confession. Two faint ovals where the skin had hardened. A little rawness along the heel of the left hand. "I don't swing angry," June said, setting a seven iron on the bench. "But it feels like I'm hanging on." Her voice had the tired honesty of someone who's learned to live with a small problem because it kept arriving disguised as effort.
            </p>

            <p style="margin-bottom: 2rem;">
                If you spend enough evenings in a builder's shop, you start to recognize the sound of truth. It isn't the launch monitor or the ferule clink, it's the low relieved breath people take when a club finally feels like it belongs in their hands. That breath is why I reached for tape, not a new head.
            </p>

            <p style="margin-bottom: 2rem;">
                "Grip size first," I said, and she smiled like she'd been caught hoping for a simple answer.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's what the catalog pages never quite say out loud. The grip's the handshake between you and the club. If the handshake is wrong, the conversation never starts. Too small and your fingers wrap too far around. Pressure spikes. The face wants to close too fast, pulls and hooks creep in. Your forearms ache by the 12th. Too big and your fingers barely meet. Pressure gets weird in a different way. The face stalls a beat late. Little pushes linger on the right side of the range. Texture matters too. Slick in heat or rain invites strangling and strangling invites misses.
            </p>

            <p style="margin-bottom: 2rem;">
                We measured June's hand the old honest way. Crease of wrist to tip of middle finger. And her current standard grips turned out to be smaller than her hands had any right to negotiate with. Add in a thin wrap of tape that had flattened with time and she'd been swinging with a handshake better suited to a teenager. No wonder her hands kept arguing with the club.
            </p>

            <p style="margin-bottom: 2rem;">
                I built her two test handles. Same head, same shaft, same swing weight, only the handle changed. One was a true standard with fresh tape that actually measured standard again. The other was mid with a soft, slightly tacky texture. No aggressive cord, just enough bite to trust on a humid Pennsylvania afternoon.
            </p>

            <p style="margin-bottom: 2rem;">
                She set the mid in her hands and something in her shoulders let go. If you've ever watched a cellist relax into the right bow, you know the look. On the mat, the truth wasn't loud, it was consistent. With the small handle, her first two shots looked fine. The third tugged left and the fourth followed a yard farther. With the mid, the start lines calmed. Same swing, same tempo, less negotiation at the moment everything matters. She didn't swing harder. She didn't need to. The club finally spoke at the same volume as her hands.
            </p>

            <p style="margin-bottom: 2rem;">
                A few realities said simply, size is a fit, not a label. Undersized, standard, midsize, oversize are only neighborhoods. Your hand length, finger thickness, glove size, and how you set your fingers overlap, interlock, neutral. Decide where you live.
            </p>

            <p style="margin-bottom: 2rem;">
                Texture is medicine. Sweaty hands and firm cord can be a good marriage. Tender hands and arthritis often crave softer, higher tact polymers that grip you back so you can ease pressure. Rain golf needs a different skin than desert golf.
            </p>

            <p style="margin-bottom: 2rem;">
                Weight matters quietly. A heavier grip shifts balance toward your hands. A few grams can lower measured swing weight about a point, which can smooth a snappy transition. A very light grip does the opposite. We use that lever gently to help feel without surprising the head.
            </p>

            <p style="margin-bottom: 2rem;">
                Wraps are a scalpel. One, two, three extra wraps under the lower hand can calm overactive forearms without changing the upper hand as much. We can build a plus two wrap standard that behaves like a small mid or taper less so both hands feel equal.
            </p>

            <p style="margin-bottom: 2rem;">
                June asked the questions most golfers are too polite to ask. "Will midsize make me lose face control?" Not if your hands were overworking because the grip was too small. The right size lets you hold lightly and guide, not strangle and rescue. Imagine writing with a pencil the right thickness. Your lines get neater without pressing grooves into the page.
            </p>

            <p style="margin-bottom: 2rem;">
                "What about my wedges? I like to feel the head." Then we'll keep that promise. We can run a slightly lighter grip or a hair less buildup on the scoring clubs, so the head presence stays vivid and keep the calmer mid-feel in the long slash mid-irons where tempo wobbles. You don't need one answer for the whole bag. You need one answer per job.
            </p>

            <p style="margin-bottom: 2rem;">
                Do soft grips get slippery? Some do when they age. The good ones use compounds that stay tacky in heat and rinse clean in the sink. If you play in rain, a cord blend in the lead hand and softer trail hand zones is a beautiful compromise. We'll test what your skin likes.
            </p>

            <p style="margin-bottom: 2rem;">
                We tried a few more same mid and a firmer compound than a standard with plus three wraps under the right hand only.The firmer mid gave her gorgeous feedback when she caught one high on the face, talkative without being punishing. The plus-three underhand build felt good on chips, but made full swings a little wooden. Her body voted without raising its hand. The SofTac Mid was the one that let her breathe.
            </p>

            <p style="margin-bottom: 2rem;">
                And because I always say the quiet parts too, pressure is the real villain. The wrong size or texture creates it, but habit sustains it. If a fresh, right-sized grip lets you hold it 4 out of 10 instead of 7 out of 10, don't take the savings and spend it on speed. Spend it on timing. The face will thank you, and so will your forearms on 16.
            </p>

            <p style="margin-bottom: 2rem;">
                We finished with the unglamorous details that make clubs feel like instruments. Consistent thickness across the set so the handshake doesn't change mid-round. If you prefer a touch more under the trail hand, we repeat it everywhere. Aligned logos/lines for the way you set your hands. Some players draw comfort from a reminder stripe. Others want a clean canvas.
            </p>

            <p style="margin-bottom: 2rem;">
                Grip weight tracked so the swing weight window stays where you liked it during testing. No accidental headlight surprises when you re-grip the last five.
            </p>

            <p style="margin-bottom: 2rem;">
                Heat and rain plan, a glove that matches the texture, a towel you'll actually use, and a simple cleaning habit. Warm water, drop of dish soap, soft brush.
            </p>

            <p style="margin-bottom: 2rem;">
                When June came back after a week, she didn't show me new speed, she showed me old calm. Her notebook, the kind golfers keep when they're serious quietly, had a line I love. "Two shot holes felt like one shot holes again."
            </p>

            <p style="margin-bottom: 2rem;">
                That's what the right handshake buys you. Not miracles, not drama, just a round that reads like a sentence you'd actually write.
            </p>

            <p style="margin-bottom: 3rem;">
                If you've been living with blisters that shouldn't be there, with hooks that look like apologies, or pushes that arrive late, bring your hands and your swing as they are. We'll size and build a handle that belongs to you. Tape where you need it. Texture your skin trust. Weight that keeps the head speaking in a voice you can hear without shouting. Then we'll watch three balls fly the same way and know we're close.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Grip? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    We'll size and build a handle that belongs to you. Tape where you need it, texture your skin trusts.
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
                    Schedule your Grip Fitting Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    A round that reads like a sentence you'd actually write.
                </p>
            </div>
        </article>
    </div>
</section>
