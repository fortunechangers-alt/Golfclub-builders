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
                <source src="<?= base_url('serve-audio.php?file=Daniel\'s Search for the perfect middle path.mp3') ?>" type="audio/mpeg">
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
                <p style="margin: 0;">Published: <time>January 15, 2025</time> • 10 min read</p>
            </div>
            <h1 style="color: var(--deep-green); font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                Daniel's search for the perfect middle path
            </h1>
        </header>
        
        <!-- Article Content -->
        <article style="line-height: 1.8; color: #333;">
            
            <script>
            // Load word-level timestamps from JSON (ElevenLabs format)
            let allWords = [];
            let wordElements = [];
            
            fetch('<?= base_url('JSON/Daniel\'s Search for the perfect middle path.mp3.json') ?>')
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
            
            <p style="margin-bottom: 2rem;">
                He kept the old 7-iron in his trunk like a photograph. Thin top line, that soft secretive look only purists really notice. It had seen a thousand range mats and more than a few miracles. But lately the miracles were rationed. Daniel could flush one shot that looked like it had a spine of light inside it, then follow with a thin that fell out of the sky like it forgot how to be a golf ball. "I don't wanna give up the look," he said, laying the club on our bench. "I just want fewer apologies."
            </p>

            <p style="margin-bottom: 2rem;">
                We powered on the monitor. The room warmed to the small familiar chorus of a builder's shop, fans, soft clink of ferrules, the faint solvent scent that only club people find comforting. I set 3 7-irons on the mat, faces covered with impact tape. One was a classic player's head; compact, narrow sole, no tricks. One was unashamedly game improvement; wider sole, perimeter waiting, a built-en apology note. The third was the one I had in mind for Daniel, a player's distance head. It looked like courage at address and carried some quiet technology under the paint.
            </p>

            <p style="margin-bottom: 2rem;">
                Player's distance is the middle path that doesn't feel like compromise. Think sleek outline and restrained offset, what your eye wants, paired with a thin lively face and internal weighting that holds ball speed when you're not perfect. The face can be forged, the body hollow or multi-piece. Sometimes there's a polymer inside to calm sound and support the face. The point isn't the recipe. The point is the taste. Compact confidence with a cushion for the misses we actually hit.
            </p>

            <p style="margin-bottom: 2rem;">
                We started with the blade-leaning player's iron because romance has a right to speak first. Daniel's best swing was a sentence written in clean calligraphy, flat, piercing, pin-high. But when the strike drifted low on the face, as it does when we're human, the ball gave up too easily. He nodded. He knew that story by heart.
            </p>

            <p style="margin-bottom: 2rem;">
                Next, the game improvement head. The first thin-ish strike surprised him. It climbed, carried, landed softly enough. The club forgave loudly and generously, but Daniel flinched at address every time. He didn't like the shape, didn't like the wider sole sitting there like a promise he didn't want to need. Some golfers can ignore that. Some can't. He's the second kind. And if your eyes are arguing with your hands at address, your swing will never get a fair trial.
            </p>

            <p style="margin-bottom: 2rem;">
                Finally, the player's distance iron. Same shaft weight and length to keep the head as the storyteller. Same ball. Same human being. The first strike wasn't perfect, slightly thin, just like the blade's miss. But the ball didn't fall out of the sky. It held its flight as if supported by an invisible scaffolding, carried the front of the green, released a few steps, and stopped. He looked at the face tape, then back at me. "That one didn didn't deserve to be that good," he said, and smiled because that is the exact kind of mercy we hope for in golf and in life.
            </p>

            <p style="margin-bottom: 2rem;">
                Here's what player's distance gets right when it's fit properly. Looks that calm you at address. It's closer to a player's profile. Thinner top line, modest offset, shapes that say go ahead and make a golf swing. Calm golfers hit brave shots. Speed that doesn't feel like cheating, thin lively faces and smart weighting help carry the thin or toe side contact you're most likely to make on a Tuesday after work. Forgiveness without training wheels, it won't erase a chunk or a shank, nothing will. And it won't overcorrect like some GI heads can. It trims the tacks on ordinary mistakes.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">There are honest trade-offs.</h2>

            <p style="margin-bottom: 2rem;">
                Not the most forgiving. If your strike pattern is wild, a true GI iron will protect you more. Player's distance is a cushion, not a mattress. Lofts are often stronger. That's part of how distance stays up while the head stays compact. It's fine, just gap your wedges after the switch so your scoring clubs still speak in whole sentences. Spin windows matter. You want enough spin and descent angle to stop a mid-iron on a reasonable green. We check that with your ball, not a laboratory fantasy.
            </p>

            <p style="margin-bottom: 2rem;">
                Daniel asked the questions everyone asks when they realize the middle path might be theirs. "Will I lose workability?" Not really, if you define workability as the ball listens when I ask for a small draw or fade. You still need centered strikes for honest curve. No head can fake that. "Will it look big behind the ball?" Not this category, not the right model. "What about turf?" The soles in good PD heads glide rather than gouge. We still test on grass when we can because your delivery, how steep you are, where your low point lives, should choose the sole, not a photo.
            </p>

            <p style="margin-bottom: 2rem;">
                We kept the player's distance, 7-iron in his hands, and made the small boring decisions that turn okay into right, a shaft weight that matched his energy level, not just his speed. A flex that met his transition without picking a fight. A swing weight that let him sense the head without the head bossing him around. A lie angle that stopped the toe from writing its own plot twist. None of this felt dramatic. That's how I knew we were close. Drama is for the highlight reel. Golfers need repeatable.
            </p>

            <p style="margin-bottom: 2rem;">
                He hit five more. Then five more. The best ones looked all but identical to his best with the blade. The worst ones were 10 yards better than his worst with the blade. That is player's distance in one sentence. Same picture for your best, a smaller penalty for being human.
            </p>

            <p style="margin-bottom: 2rem;">
                If you're reading this and your heart lives with blades but your scorecard doesn't, consider this a permission slip. Forgiveness is not a surrender. It's a choice to spend your courage on the shot, not on the tool. And if you love the tools, that whisper of steel, that clean address, this category is an invitation to keep your romance and win back some peace.
            </p>

            <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">A few practical notes we send home with people like Daniel.</h2>

            <p style="margin-bottom: 2rem;">
                Blend if you want. Lots of golfers play long, mid irons in player's distance and short irons in players. You get help where you need it, precision where you crave it. Re-gap after the switch. Stronger lofts and livelier faces can stretch distances. Make sure your wedges tell a coherent story, and don't be afraid of four. Fit the shaft and swing-weight to you. The same head can feel like a different species with the wrong heft or flex. Your hands should feel the head in time, not too early, not too late. Judge patterns, not heroes. One rocket means little. 10 balls living in a tighter window is progress that lasts.
            </p>

            <p style="margin-bottom: 2rem;">
                We stood in the doorway as Daniel packed up. He put the old 7-iron back in the trunk. He couldn't quite let it go and carried the player's distance demo like a new chapter. That's the thing about the middle path. When it's right, it doesn't feel like picking second place. It feels like choosing the version of the game that lets you love it longer.
            </p>

            <p style="margin-bottom: 3rem;">
                If your clubs have been asking you to be perfect before they'll be kind, come see us. We'll put something behind the ball that looks like confidence and forgives like a good friend. Then we'll watch the same flight appear twice in a row and know we're on the right road.
            </p>

            <!-- CTA Section -->
            <div style="background: linear-gradient(135deg, var(--deep-green), #0a4d3a); color: white; padding: 3rem; border-radius: 12px; margin: 3rem 0; text-align: center;">
                <h2 style="color: white; margin-bottom: 1.5rem;">Ready to Find Your Perfect Iron Category? 🎯</h2>
                
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
                    Let us help you discover if Players-Distance irons are the right choice for your game and preferences.
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
                    Schedule your Iron Fitting Session<br>
                    In-home, appointment-only service
                </p>
                
                <p style="margin-top: 2rem; font-size: 1.1rem; color: var(--gold); font-style: italic;">
                    Choose the version of the game that lets you love it longer.
                </p>
            </div>
        </article>
    </div>
</section>
