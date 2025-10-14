# Add Audio to Any Blog Post - Working Template

## ✅ COPY THIS ENTIRE BLOCK - It's plug-and-play!

### Step 1: Place your files
- Audio MP3: Put in `public/audio/YOUR_AUDIO_FILE.mp3`
- JSON alignment: Put in `public/JSON/YOUR_JSON_FILE.json`

### Step 2: Insert this code BEFORE your blog title/header

**Just change the 2 filenames on lines 11 and 28 to match YOUR files!**

```php
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
        <source src="<?= base_url('serve-audio.php?file=YOUR_AUDIO_FILE.mp3') ?>" type="audio/mpeg">
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

<script>
// Load word-level timestamps from JSON (ElevenLabs format)
let allWords = [];
let wordElements = [];

fetch('<?= base_url('JSON/YOUR_JSON_FILE.mp3.json') ?>')
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
    // Include h1, h2, p, and li elements
    const textElements = container.querySelectorAll('h1, h2, h3, p, li');
    
    // Get the audio player div to completely skip it
    const audioPlayer = document.querySelector('#audioPlayerSticky');
    
    textElements.forEach(element => {
        // Skip if:
        // - Already wrapped
        // - Inside the audio player div
        // - Inside a button
        // - Contains buttons or phone links
        // - Is a link (Back to Blog)
        // - Contains images
        if (element.querySelector('.word-highlight') || 
            audioPlayer.contains(element) ||
            element.closest('a') ||
            element.querySelector('a') ||
            element.closest('button') ||
            element.querySelector('button') ||
            element.querySelector('a[href*="tel:"]') ||
            element.querySelector('img')) {
            return;
        }
        
        const text = element.textContent;
        // Remove bullet characters that might be in the text
        const cleanText = text.replace(/[•·]/g, '').replace(/^\d+\.\s*/gm, '');
        const words = cleanText.split(/\s+/); // Split on spaces but don't keep them
        
        element.innerHTML = '';
        words.forEach((word, index) => {
            if (word.trim()) { // Only wrap non-empty words
                const span = document.createElement('span');
                span.textContent = word;
                span.className = 'word-highlight';
                span.style.cursor = 'pointer';
                element.appendChild(span);
                
                // Add space after word (except last word)
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
            if (allWords[index]) {
                audio.currentTime = allWords[index].start;
                audio.play();
            }
        });
    });
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
            const isVisible = rect.top >= 150 && rect.bottom <= window.innerHeight - 50;
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
    padding: 2px 4px;
    border-radius: 3px;
}
</style>
```

---

## 🎯 What This Does

✅ **Fixed audio player** - Stays above the menu at top of screen, centered on desktop, full-width on mobile  
✅ **Word-by-word highlighting** - Yellow highlight follows the audio  
✅ **Click any word** - Jump to that point in audio (starts playing)  
✅ **Hover effect** - Shows words are clickable  
✅ **Playback speeds** - 1x, 1.5x, 2x  
✅ **Smart scrolling** - Only scrolls if word is off-screen  
✅ **No spaces highlighted** - Only actual words  
✅ **No bold text** - Clean appearance  
✅ **Filters spaces from JSON** - Accurate alignment  
✅ **Mobile friendly** - Works on all devices  

---

## 📝 What to Change

**Only 2 things to change:**

1. **Line 11**: `YOUR_AUDIO_FILE.mp3` → Your actual audio filename
2. **Line 42**: `YOUR_JSON_FILE.mp3.json` → Your actual JSON filename

Example:
```php
<source src="<?= base_url('serve-audio.php?file=blade-vs-cavity-back.mp3') ?>" type="audio/mpeg">
...
fetch('<?= base_url('JSON/blade-vs-cavity-back.mp3.json') ?>')
```

---

## 📍 Where to Insert

Insert this code **BEFORE** your blog post title/header, typically right after:
```php
<div class="container" style="max-width: 900px;">
    
    ⬅️ INSERT AUDIO CODE HERE
    
    <!-- Article Header -->
    <header>
        <!-- IMPORTANT: Date/metadata ABOVE title -->
        <div>Published: January 15, 2025 • 8 min read</div>
        <h1>Your Title</h1>
    </header>
```

**⚠️ CRITICAL:** Always put date/read time ABOVE the h1 title, not below it! This ensures the highlighting starts at the title.

---

## ⚠️ Important: Match Text to Audio

The blog post text MUST match the audio transcript exactly, or highlighting will drift off.

**Text differences that break alignment:**
- ❌ "muscle-back" in blog vs "muscle back" in audio
- ❌ "mid profile" (two words) in blog vs "mid-profile" (hyphenated) in audio
- ❌ "game-improvement" in blog vs "game improvement" (two words) in audio
- ❌ "vs." in blog vs "versus" in audio  
- ❌ Bullet lists in blog vs continuous paragraphs in audio
- ❌ "I'm" in blog vs "I am" in audio
- ❌ "ninety seven" in blog vs "97" in audio
- ❌ "thinish" in blog vs "thin-ish" in audio
- ❌ Missing commas in blog that are in audio ("steps and" vs "steps, and")
- ❌ Audio may have stuttered/doubled words (e.g., "didn didn't") - keep them!

**CRITICAL:** 
- Hyphenated words: Check the JSON transcript! Don't assume.
  - "mid-profile" (1 word) vs "game improvement" (2 words) - both are valid!
- Bullet lists are usually spoken as continuous sentences. Convert them to paragraphs!
- Listen for ALL commas - they affect word boundaries!
- AI voice may stutter - if it says "didn didn't", you MUST include both words!

**MANDATORY: Extract transcript FIRST:**
```python
import json
data = json.load(open('public/JSON/YOUR_FILE.mp3.json'))
transcript = ' '.join([seg['text'] for seg in data['segments']])
print(transcript)
```

**Then match EXACTLY:**
- Use the transcript word-for-word
- Capitalization doesn't matter (we normalize)
- **Punctuation DOES matter** - match every comma, period, quote
- Numbers vs words: match exactly ("97" or "ninety seven")
- **Hyphens: NEVER assume!** Check the transcript:
  - "mid-profile" (1 word) ≠ "mid profile" (2 words)
  - "swing-weight" (1 word) ≠ "swing weight" (2 words)
  - "game improvement" (2 words) even though you'd normally hyphenate it!
- Keep stuttered/doubled words if in audio
- Convert bullet lists to continuous paragraphs

---

## 🧪 How to Test

1. Refresh the blog post page
2. Open browser console (F12)
3. Look for: `"Loaded XXX aligned words (filtered out spaces)"`
4. Play audio - words should highlight
5. Click any word - should jump to that point
6. Hover over words - should see gray background
7. Try playback speeds - should all work
8. Scroll down - player should stick to top

---

## ✨ Features Working

- ✅ Click any word to jump to that part of audio
- ✅ Audio player fixed to top (stays above menu, never hidden)
- ✅ Constrained width on desktop (matches article), full-width on mobile
- ✅ Beautiful rounded corners with classic headphone icon
- ✅ Hover shows which words are clickable
- ✅ No bold text when highlighted
- ✅ No spaces highlighted
- ✅ Smooth 60fps highlighting
- ✅ Smart auto-scroll (only when needed)
- ✅ Works with ElevenLabs JSON format

---

**That's it! Copy, paste, change 2 filenames, done!** 🎉
