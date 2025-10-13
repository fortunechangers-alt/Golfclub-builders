<div class="blog-post">
    <div class="blog-header">
        <h1><?= $post['title'] ?></h1>
        <div class="blog-meta">
            <span class="date"><?= date('F j, Y', strtotime($post['date'])) ?></span>
            <span class="read-time"><?= $post['read_time'] ?></span>
        </div>
    </div>
    
    <div class="blog-content">
        <!-- Audio Player -->
        <div style="background: linear-gradient(135deg, var(--deep-green), #0a5a42); padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <span style="font-size: 2rem;">🎧</span>
                <h3 style="color: white; margin: 0;">Listen to This Article</h3>
            </div>
            <audio id="blogAudio" controls style="width: 100%; margin-bottom: 1rem;">
                <source src="<?= base_url('audio/Maya and Dan.mp3') ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <button onclick="setPlaybackSpeed(1)" style="background: white; color: var(--deep-green); border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; font-weight: 600;">1x</button>
                <button onclick="setPlaybackSpeed(1.5)" style="background: white; color: var(--deep-green); border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; font-weight: 600;">1.5x</button>
                <button onclick="setPlaybackSpeed(2)" style="background: white; color: var(--deep-green); border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; font-weight: 600;">2x</button>
            </div>
        </div>
        
        <script>
        // Load and parse VTT file for synchronized highlighting
        let vttCues = [];
        
        fetch('<?= base_url('Subtitle/Maya and Dan Subs.vtt') ?>')
            .then(response => response.text())
            .then(vttText => {
                vttCues = parseVTT(vttText);
                console.log('Loaded', vttCues.length, 'subtitle cues');
            });
        
        function parseVTT(vttText) {
            const cues = [];
            const lines = vttText.split('\n');
            let i = 0;
            
            while (i < lines.length) {
                // Skip until we find a timestamp line
                if (lines[i].includes('-->')) {
                    const times = lines[i].split('-->');
                    const start = parseTime(times[0].trim());
                    const end = parseTime(times[1].trim());
                    i++;
                    
                    // Get the text (might be on multiple lines)
                    let text = '';
                    while (i < lines.length && lines[i].trim() !== '') {
                        text += lines[i].replace(/<\/?b>/g, '').trim() + ' ';
                        i++;
                    }
                    
                    if (text.trim()) {
                        cues.push({ start, end, text: text.trim() });
                    }
                }
                i++;
            }
            return cues;
        }
        
        function parseTime(timeStr) {
            const parts = timeStr.split(':');
            const seconds = parseFloat(parts[parts.length - 1]);
            const minutes = parseInt(parts[parts.length - 2] || 0);
            const hours = parseInt(parts[parts.length - 3] || 0);
            return hours * 3600 + minutes * 60 + seconds;
        }
        
        // Highlight text as audio plays - FRAME-ACCURATE (like ElevenLabs)
        const audio = document.getElementById('blogAudio');
        const blogContent = document.querySelector('.blog-content');
        let lastCueIndex = -1;
        let isPlaying = false;
        
        // Use requestAnimationFrame for smooth 60fps updates (not timeupdate)
        function tick() {
            if (!isPlaying) return;
            
            const currentTime = audio.currentTime;
            
            // Binary search for current cue (faster than findIndex)
            let cueIndex = -1;
            for (let i = 0; i < vttCues.length; i++) {
                if (currentTime >= vttCues[i].start && currentTime < vttCues[i].end) {
                    cueIndex = i;
                    break;
                }
            }
            
            // Only update if cue changed (reduces DOM manipulation)
            if (cueIndex !== lastCueIndex) {
                if (cueIndex !== -1) {
                    highlightText(vttCues[cueIndex].text);
                }
                lastCueIndex = cueIndex;
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
            // Remove all highlights when done
            if (paragraphCache) {
                paragraphCache.forEach(item => {
                    item.element.innerHTML = item.originalHTML;
                });
            }
        });
        
        // Cache for paragraph content
        let paragraphCache = null;
        
        function highlightText(text) {
            // Build cache once
            if (!paragraphCache) {
                paragraphCache = Array.from(blogContent.querySelectorAll('p, h2, li')).map(p => ({
                    element: p,
                    originalHTML: p.innerHTML
                }));
            }
            
            // Remove all previous highlights first
            paragraphCache.forEach(item => {
                item.element.innerHTML = item.originalHTML;
            });
            
            // Normalize text for better matching (remove punctuation)
            const normalizedSearch = text.toLowerCase()
                .replace(/[.,;:!?"']/g, '')
                .replace(/\s+/g, ' ')
                .trim();
            
            // Split into words for flexible matching
            const searchWords = normalizedSearch.split(' ');
            
            for (let item of paragraphCache) {
                const normalizedContent = item.element.textContent.toLowerCase()
                    .replace(/[.,;:!?"'—]/g, '')
                    .replace(/\s+/g, ' ');
                
                // Check if most words from the cue are in this paragraph
                const matchCount = searchWords.filter(word => 
                    normalizedContent.includes(word)
                ).length;
                
                if (matchCount >= searchWords.length * 0.7) { // 70% match threshold
                    // Highlight each word individually
                    searchWords.forEach(word => {
                        if (word.length > 2) { // Skip very short words
                            const regex = new RegExp(`\\b${word}\\b`, 'gi');
                            item.element.innerHTML = item.element.innerHTML.replace(regex, match => 
                                `<mark class="audio-highlight">${match}</mark>`
                            );
                        }
                    });
                    
                    // Scroll to highlighted text
                    item.element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    break; // Only highlight first matching paragraph
                }
            }
        }
        
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
        .audio-highlight {
            background: linear-gradient(135deg, rgba(255, 255, 0, 0.4), rgba(255, 200, 0, 0.4));
            padding: 2px 0;
            border-radius: 3px;
            transition: background 0.3s ease;
        }
        </style>
        
        <h2 style="color: var(--deep-green); font-size: 2rem; margin: 3rem 0 1.5rem 0; border-bottom: 2px solid var(--light); padding-bottom: 0.5rem;">Maya and Dan: When Labels Meet Reality</h2>
        
        <p>They arrived together on a windy Thursday—Maya with a canvas tote full of range tokens, Dan with the kind of grin that says, "I'm here for her, but I'm definitely going to swing something." He carried a men's Stiff driver he'd trusted since college; she held a boxed women's set her sister had sworn by. They wanted me to confirm what the labels already seemed to promise.</p>

        <p>I didn't. I asked them to hit balls.</p>

        <p>Our shop is quiet on purpose. You can hear the launch monitor wake up, the small fan over the mat, the way a centered strike makes a soft, round note that feels like truth in your hands. Maya went first. Her tempo was smooth, unhurried, the kind of rhythm you see in someone who can walk a hill without changing breath. Her speed was real—faster than she believed—and the ball rose with a bright, confident window when she caught the middle. Dan stepped up next and swung the way men are taught to swing: harder when unsure, firmer when the ball doesn't listen. His best was a postcard. His average lived a little right and a little low; by the end of ten balls, his shoulders had crept into his ears.</p>

        <p>"Tell us about men's versus women's clubs," he said, which is how this conversation always begins. So I told them the simple, accurate version.</p>

        <h2>What the labels usually mean</h2>
        <p>Clubs sold as "women's" are typically shorter, lighter overall, and use softer flexes than their men's counterparts; grips are usually smaller in diameter; lofts may be slightly higher to help launch. Women's drivers, for instance, are often about an inch shorter than standard men's models, and the irons scale down similarly. That's a decent starting point for many smaller or smoother‑tempo golfers—of any gender—because shorter and lighter can make timing easier and launch more honest.</p>

        <h2>What the labels do not mean</h2>
        <p>They do not mean men must always play men's clubs or that women must always play women's. They don't mean every woman needs an "L" (Ladies) flex or that every man belongs in "S" (Stiff). They don't know your height, your wrist‑to‑floor, your hand size, your swing speed, your tempo, your strength, your injury history, or your confidence. Labels are scaffolding; fit is a house.</p>

        <p>We put Maya's boxed set aside for a moment and built a test club in a Regular flex with a mid‑weight shaft—firmer than the "L" in the box—and a standard‑diameter grip instead of the undersize. She took one breath and sent a drive with a calm draw that looked like the line you'd sketch if you could draw a perfect shot. She laughed, surprised and a little proud—because the ball does not care what it says on the shrink wrap.</p>

        <p>Dan's turn. He lived on a knife edge with the Stiff: best swings, pure‑enough bullets; ordinary swings, low‑right compromises. So we tested a slightly lighter shaft with a Regular flex in his driver and trimmed length down half an inch so his timing didn't have to sprint to keep up. The change wasn't dramatic. It was better. The low‑rights became mid‑window pushes that curved back. He could make the same move and expect the same answer two shots in a row. That's not a miracle; that's fit.</p>

        <h2>We talked through the levers we can pull, the honest ones:</h2>
        <ul>
            <li><strong>Length:</strong> Shorter isn't "less." It's leverage you can time. Most misses live at the ends—too long pulls the club off‑plane and delays the face; too short can make you hunch and lose speed. We fit length to height, posture, delivery, and where you actually strike the face, not to a label.</li>
            <li><strong>Total weight vs swing weight:</strong> Total weight is what you carry for 18 holes; swing weight is how heavy the club feels in motion. A "women's" club cut down from a men's shaft without adding head weight often goes too light in swing weight—the head disappears, timing evaporates. If we shorten, we adjust the balance so the club still talks to your hands.</li>
            <li><strong>Flex & profile:</strong> Flex letters (L/A/M/R/S/X/TX) are rough ladders. Tempo matters as much as speed. Smooth transitions can live in softer options with great results; punchy transitions often need firmer tips or more mass so the face shows up on time.</li>
            <li><strong>Grip size:</strong> Hands decide. Too small and you squeeze; too big and you lose face awareness. We measure hand size and test; a lot of women land in standard or mid depending on feel and build—not a preset "ladies" size. Plenty of men with smaller hands play undersize.</li>
            <li><strong>Loft gapping:</strong> If a women's model has a touch more loft and lighter shafts, carries will change. We gap from the top of the bag to the wedges so there are no missing sentences in your distances.</li>
        </ul>

        <p>Back on the mat, Maya tried a Stiff in a lighter weight just to see it. The ball still flew, but the feel got uptight; the club didn't load as willingly and her draw began to hang on the right side of the range. She shook her head, honest with herself. "That Regular felt like it wanted to help." Dan, meanwhile, tried to prove the Stiff was still his. He found two perfect ones, then chased them, then lost them. He put the Regular back down like someone choosing a boot that fits instead of one that flatters at the store mirror.</p>

        <h2>Here are the truths I send home with couples:</h2>
        <ul>
            <li><strong>There's no such thing as "men's distance" or "women's forgiveness."</strong> There's only the club that fits the way you swing.</li>
            <li><strong>Cut‑downs aren't free.</strong> If you shorten a club and don't rebalance it, the swing weight craters and the head vanishes. We add the right grams back where they belong.</li>
            <li><strong>TX is not a trophy.</strong> It's for tour‑level speed with an aggressive transition. Most golfers—men and women—play better golf in R or S when the weight and tip profile match their move.</li>
            <li><strong>Comfort is performance.</strong> If your elbow sings by the twelfth hole, a mid‑weight graphite iron shaft isn't "giving in"—it's choosing golf you can finish.</li>
            <li><strong>Your eye matters.</strong> At address, choose the look that calms you—sleek players, players‑distance, or game‑improvement. Calm golfers make brave swings.</li>
        </ul>

        <p>We built them "unlabeled" clubs that belonged to their swings: Maya in a Regular driver with a mid‑weight shaft and a grip that filled her hands without asking for tension; a players‑distance 7‑iron that turned her thin miss into a carry that held. Dan in a Regular driver trimmed to his timing; a slightly heavier iron shaft so his transition didn't rush; lie and swing‑weight tuned so the toe didn't write its own plot twist. If you lined the builds up, you wouldn't see gender. You'd see fit.</p>

        <p>They came back a week later with golf on their faces. Maya had carried a par‑5 layup she used to fear. Dan had hit two tee balls he didn't have to apologize for. They didn't swap identities; they found equipment that stopped arguing with who they already were.</p>

        <p>So if the labels have been telling you a story that doesn't feel like yours, bring the swing you own. We'll measure height and wrist‑to‑floor, note your speed and tempo, size your grips, and then build in grams, inches, and feel instead of in gender. The right clubs don't care what shelf they came from. They care that your hands stop bracing, your breath slows at address, and the ball starts flying like the picture you kept in your mind.</p>

        <p>When you're ready, call <strong>(717) 387‑1643</strong> and ask for a Size, Flex & Grip session—in‑home, appointment‑only. We'll keep the parts that feel like you, and change the ones that keep you from loving the game as much on 18 as you did on 1.</p>
    </div>
    
    <div class="blog-cta">
        <h3>Ready to Find Your Perfect Fit?</h3>
        <p>Let our professional fitting help you choose clubs based on your swing, not your gender. We'll build the perfect set for your game.</p>
        <div class="cta-buttons">
            <a href="<?= base_url('/ai-fitting') ?>" class="btn btn-primary">Book Custom Fitting</a>
            <a href="tel:7173871643" class="btn btn-outline">Call (717) 387-1643</a>
        </div>
    </div>
</div>

<style>
.blog-post {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    line-height: 1.7;
}

.blog-header {
    margin-bottom: 3rem;
    text-align: center;
    border-bottom: 2px solid var(--gold);
    padding-bottom: 2rem;
}

.blog-header h1 {
    color: var(--deep-green);
    font-size: 2.5rem;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.blog-meta {
    display: flex;
    justify-content: center;
    gap: 2rem;
    color: #666;
    font-size: 0.9rem;
}

.blog-content {
    font-size: 1.1rem;
    color: #333;
}

.blog-content h2 {
    color: var(--deep-green);
    margin: 3rem 0 1.5rem 0;
    font-size: 1.8rem;
}

.blog-content p {
    margin-bottom: 1.5rem;
}

.blog-content ul {
    margin: 2rem 0;
    padding-left: 2rem;
}

.blog-content li {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.blog-content strong {
    color: var(--deep-green);
}

.blog-cta {
    background: linear-gradient(135deg, var(--navy-blue), #0d2a5c);
    color: white;
    padding: 3rem 2rem;
    border-radius: 12px;
    text-align: center;
    margin-top: 4rem;
}

.blog-cta h3 {
    color: white;
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

.blog-cta p {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    color: rgba(255,255,255,0.9);
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .blog-post {
        padding: 1rem;
    }
    
    .blog-header h1 {
        font-size: 2rem;
    }
    
    .blog-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
}
</style>
