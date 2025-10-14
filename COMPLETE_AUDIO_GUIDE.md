# Complete Audio Word-Highlighting Implementation Guide

## PROVEN WORKING EXAMPLE

**File:** `app/Views/blog/players-vs-game-improvement-irons.php`

**Status:** All features working perfectly
- Word highlighting follows audio perfectly
- Click any word to seek to that position
- Manual scrubber seeking works
- Fixed player stays at top (below header with gap)
- Beautiful rounded corners with 🎧 headphone icon
- "Back to Blog" link integrated into player
- No spaces highlighted
- No bold text
- Full article coverage
- Desktop: Centered, matches article width
- Mobile: Full-width, adapts perfectly

---

## MOST COMMON MISTAKES (Learn from Real Examples)

These are ACTUAL issues found in blog posts that caused highlighting to drift:

### Hyphen Assumptions ❌
- **Wrong:** Assumed "game-improvement" was hyphenated → **Right:** Audio said "game improvement" (2 words)
- **Wrong:** Wrote "swing-weight" → **Right:** Audio said "swing weight" (2 words)
- **Wrong:** Wrote "mid profile" → **Right:** Audio said "mid-profile" (1 word)

**Lesson:** NEVER assume! Extract transcript and check EVERY compound word.

### Missing Commas ❌
- **Wrong:** "steps and stopped" → **Right:** "steps, and stopped"
- **Wrong:** "hands and made" → **Right:** "hands, and made"
- **Wrong:** "face tape then" → **Right:** "face tape, then"

**Lesson:** Commas affect word boundaries. Listen carefully or extract transcript!

### Bullet Lists ❌
- **Wrong:** Kept `<ul><li>` bullet points → **Right:** Converted to continuous paragraphs
- Audio doesn't say "bullet one, bullet two" - it speaks continuously

### AI Voice Quirks ❌
- **Wrong:** Corrected "didn didn't" to "didn't" → **Right:** Kept "didn didn't" (stuttered in audio)
- **Wrong:** Removed ellipsis from title → **Right:** Script filters it automatically

### Numbers ❌
- **Wrong:** "ninety seven" → **Right:** "97" (audio said the number)
- **Wrong:** "ten" → **Right:** "10" (audio said the number)

### Special Characters in Filenames ❌
- **Wrong:** `file=Loft & Lie.mp3` → **Right:** `file=Loft %26 Lie.mp3` (URL-encode ampersand)
- **Wrong:** `file=Players‑Distance.mp3` → **Right:** `file=Players%E2%80%91Distance.mp3` (URL-encode unicode dash)
- Ampersands (&) must be encoded as `%26` in URLs
- Unicode non-breaking hyphens (‑) must be encoded as `%E2%80%91` in URLs
- Regular hyphens (-) don't need encoding

**GOLDEN RULE:** Extract the transcript FIRST. Copy it word-for-word. Don't fix "errors" - match exactly!

---

## THE 6 CRITICAL SUCCESS FACTORS

### 1. Blog Text MUST Match Audio Transcript EXACTLY

This is the #1 cause of failures. Every word, punctuation, and character must match.

**What BREAKS alignment:**
- Em-dashes (—) in blog but periods/commas in audio
- "muscle-back" in blog but "muscle back" in audio  
- **"mid profile" (two words) in blog but "mid-profile" (hyphenated, ONE word) in audio**
- **"game-improvement" (hyphenated) in blog but "game improvement" (two words) in audio**
- "vs." in blog but "versus" in audio
- "(L/A/M/R/S/X/TX)" as block but spoken as "L, A, M, R, S, X, TX"
- "I'm" in blog but "I am" in audio
- Special Unicode dashes (‑) instead of regular
- "ten" in blog but "10" in audio
- **"ninety seven" in blog but "97" (number) in audio**
- **Ellipsis (...) at start of audio** - Automatically filtered out by script
- **"thinish" in blog but "thin-ish" (hyphenated) in audio**
- **Missing commas:** "steps and stopped" in blog but "steps, and stopped" in audio
- **Doubled words in audio:** Sometimes AI voice stutters (e.g., "didn didn't") - keep it to match!

**CRITICAL:** 
- Hyphenated words in audio count as ONE word. Check EVERY compound word!
  - Audio "mid-profile" → Blog "mid-profile" ✅
  - Audio "game improvement" → Blog "game improvement" ✅ (NO hyphen!)
  - Audio "thin-ish" → Blog "thin-ish" ✅
  - You MUST check the JSON - don't assume hyphens!
- Lists in audio are usually spoken as continuous sentences, NOT bullet points. Convert to paragraphs.
- Ellipsis (...) is automatically filtered out - don't worry about it in titles.
- **Listen for ALL commas** - "steps and stopped" vs "steps, and stopped" makes a difference!
- **AI voice may stutter/repeat words** - If audio says "didn didn't", keep both words in blog!

**Solution:** Extract transcript from JSON, rewrite blog to match exactly.

### 2. JSON Must Be "Segments" Format

**Required format:**
```json
{
  "segments": [
    {
      "text": "First sentence of segment",
      "words": [
        {"text": "First", "start_time": 0.5, "end_time": 0.8},
        {"text": " ", "start_time": 0.8, "end_time": 0.9},
        {"text": "sentence", "start_time": 0.9, "end_time": 1.2}
      ]
    }
  ]
}
```

**NOT this format:**
```json
{
  "words": [
    {"text": "word", "start": 0.5, "end": 0.8}
  ]
}
```

### 3. Server MUST Support HTTP Byte-Range Requests

**File:** `public/serve-audio.php`

This PHP script:
- Handles HTTP Range headers
- Returns HTTP 206 Partial Content
- Sends Accept-Ranges: bytes header
- Enables seeking anywhere instantly

**Without this:** Seeking will NOT work (always resets to beginning)

### 4. Audio Player Positioning & Styling

**CRITICAL SETTINGS:**
- `position: fixed` - Stays visible when scrolling
- `top: 152px` - Below header with perfect gap (desktop)
- `top: 100px` - Mobile positioning (tighter for screen space)
- `z-index: 999` - BELOW header (header is 1000)
- `left: 50%; transform: translateX(-50%)` - Centered on desktop
- `max-width: 900px` - Matches article width
- `border-radius: 12px` - Rounded corners (desktop only)
- **"Back to Blog" link INSIDE player** - Scrolls with player, never hidden

**Example:**
```html
<div id="audioPlayerSticky" style="position: fixed; top: 152px; left: 50%; transform: translateX(-50%); z-index: 999; ...">
    <div>
        <a href="...">← Back to Blog</a>
    </div>
    <div>🎧 Listen to Article</div>
    <audio>...</audio>
</div>
```

**Spacer Required:** Add `<div style="height: 180px;"></div>` below player to prevent content overlap

### 5. Script Placement is CRITICAL

**MUST be:**
- INLINE in the blog content area
- NO DOMContentLoaded wrapper
- Runs immediately before content renders

**Example from working post:**
```html
<article>
    <script>
    // Code runs immediately inline
    let allWords = [];
    fetch('...')...
    </script>
    
    <p>Content here...</p>
</article>
```

**NOT this:**
```html
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Too late, content already rendered
});
</script>
```

### 6. Article Structure Rules

**CRITICAL:** Date/metadata MUST be ABOVE the title, not below!

```html
<!-- CORRECT -->
<header>
    <div>Published: January 15, 2025 • 8 min read</div>
    <h1>Your Title Here</h1>
</header>

<!-- WRONG - Will break highlighting -->
<header>
    <h1>Your Title Here</h1>
    <div>Published: January 15, 2025 • 8 min read</div>
</header>
```

**Other Rules:**
- Title should appear ONCE (in h1)
- Headings appear ONCE in order spoken
- No duplicate titles in h2
- Content follows exact spoken order
- Date/metadata goes above title to match audio order

---

## COMPLETE STEP-BY-STEP CHECKLIST

### PHASE 1: Analyze Audio

1. Listen to full audio file
2. Note exact order words are spoken
3. Check if title is spoken (how: colon? comma? period? ellipsis?)
4. Note words spoken differently than written
5. **Listen for stutters/doubled words** - AI voice may repeat words
6. **Note ALL comma placements** - they matter for word alignment

### PHASE 2: Extract JSON Transcript

1. Open `public/JSON/YOUR_FILE.mp3.json`
2. Verify has "segments" array
3. Extract full transcript:
   ```bash
   python3 << 'EOF'
   import json
   with open('public/JSON/YOUR_FILE.mp3.json') as f:
       data = json.load(f)
       transcript = ' '.join([seg['text'] for seg in data['segments']])
       print(transcript)
   EOF
   ```
4. Count total words (filter spaces)
5. Verify covers entire article
6. Confirm uses start_time/end_time fields

### PHASE 3: Rewrite Blog Text

**THE GOLDEN RULE: Extract the EXACT transcript from JSON first, then copy it word-for-word.**

**Use this Python script to extract the transcript:**
```python
import json
with open('public/JSON/YOUR_FILE.mp3.json') as f:
    data = json.load(f)
    transcript = ' '.join([seg['text'] for seg in data['segments']])
    print(transcript)
```

**Then match EXACTLY:**

1. Update h1 title (exact punctuation/caps from audio)
2. Remove ALL em-dashes (—) → use periods/commas
3. Remove special Unicode dashes (‑) → use regular hyphens only
4. **Match hyphenation EXACTLY** - ALWAYS check JSON first, never assume:
   - ✅ "mid-profile" (hyphenated)
   - ✅ "game improvement" (NOT hyphenated!)
   - ✅ "swing weight" (NOT hyphenated!)
   - ✅ "thin-ish" (hyphenated)
   - Each audio file is different - CHECK THE TRANSCRIPT!
5. **Numbers vs words** - Match exactly: "97" or "ninety seven"
6. **Match ALL comma placements:**
   - "steps and stopped" vs "steps, and stopped"
   - "hands and made" vs "hands, and made"
   - Commas affect word boundaries - critical for alignment!
7. **Keep stuttered/doubled words** - If audio says "didn didn't", keep both!
8. Replace abbreviations as spoken:
   - "Dr." → "Doctor"
   - "vs." → "versus"
9. Handle contractions to match audio ("want" vs "wanna", "I'm" vs "I am")
10. **Convert ALL bullet lists to continuous paragraphs** - Audio speaks them as sentences
11. Convert headings to paragraphs if they're spoken inline (not as separate headings)
12. Special formatting:
   - "(L/A/M/R/S/X/TX)" → "L-A-M-R, S-X-T-X" (as spoken)
   - Remove unspoken parentheses
13. NO duplicate titles/headings
14. Compare word count with JSON (should be within 10 words)

### PHASE 4: Add Audio Player & Script

**Copy EXACT structure from `players-vs-game-improvement-irons.php` lines 10-53**

1. **Audio Player (lines 10-29):**
   ```html
   <div id="audioPlayerSticky" style="position: fixed; top: 152px; left: 50%; transform: translateX(-50%); z-index: 999; background: linear-gradient(135deg, var(--deep-green), #0a5a42); padding: 1rem 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.3); max-width: 900px; width: calc(100% - 2rem); border-radius: 12px;">
       <!-- Back to Blog - Part of Player -->
       <div style="margin-bottom: 0.75rem;">
           <a href="<?= base_url('/blog') ?>" style="color: white; text-decoration: none; font-weight: 600; font-size: 0.9rem;">← Back to Blog</a>
       </div>
       
       <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
           <span style="font-size: 1.5rem;">🎧</span>
           <h3 style="color: white; margin: 0; font-size: 1.1rem;">Listen to Article</h3>
       </div>
       
       <audio id="blogAudio" controls preload="auto">
           <source src="<?= base_url('serve-audio.php?file=YOUR_FILE.mp3') ?>">
       </audio>
       
       <!-- Speed buttons -->
   </div>
   
   <style>
   @media (max-width: 768px) {
       #audioPlayerSticky {
           top: 100px !important;
           left: 0 !important;
           right: 0 !important;
           transform: none !important;
           width: 100% !important;
           border-radius: 0 !important;
       }
   }
   </style>
   
   <!-- Spacer -->
   <div style="height: 180px;"></div>
   ```

2. **Script tag INLINE (lines 43-216):**
   - NO DOMContentLoaded
   - Fetch JSON with segments parsing
   - Filter spaces: `.filter(w => w.text.trim().length > 0 && w.text !== ' ')`
   - Convert: `start: w.start_time || w.start`
   - GLOBAL word counter across ALL elements
   - Split: `text.split(/\s+/)` (no regex groups)
   - Wrap words with `data-word-index`
   - Add space as `createTextNode(' ')`

3. **Click-to-seek:**
   ```javascript
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
   ```

4. **Highlighting tick (60fps):**
   ```javascript
   function tick() {
       const currentTime = audio.currentTime;
       // Find word at currentTime
       // Add 'active-word' class
       // Smart scroll if not visible
       requestAnimationFrame(tick);
   }
   ```

5. **CSS (lines 280-297):**
   ```css
   .word-highlight {
       display: inline;
       cursor: pointer;
   }
   .word-highlight:hover {
       background: rgba(200, 200, 200, 0.3);
   }
   .word-highlight.active-word {
       background: linear-gradient(135deg, rgba(255, 255, 0, 0.6), rgba(255, 200, 0, 0.6));
       color: #000;
       padding: 2px 0;  /* NO 4px horizontal padding */
       /* NO font-weight */
   }
   ```

### PHASE 5: Verify Server

1. Check `public/serve-audio.php` exists
2. Test: `http://localhost/serve-audio.php?file=YOUR_FILE.mp3`
3. Browser DevTools → Network → Check response headers
4. Must see: `Accept-Ranges: bytes`
5. When seeking, must see: HTTP 206 responses

### PHASE 6: Testing Checklist

1. Hard refresh (Cmd+Shift+R)
2. Open console (F12)
3. Console must show:
   - "Loaded XXXX aligned words"
   - "Wrapped XXXX word elements"
   - Numbers should match (±10 words ok)
4. Play audio:
   - h1 title highlights FIRST
   - Follows audio perfectly
   - No drift
5. Test scrubber:
   - Click at 2:00
   - Plays from 2:00 (not 0:00)
6. Test click-to-seek:
   - Click word in middle
   - Jumps and plays
7. Test mobile
8. Verify player sticks to top

---

## EXACT CODE DIFFERENCES: Working vs Broken

### Working (Players Irons)

**Script location:** Line 43, INSIDE `<article>` tag
```php
<article>
    <script>
    let allWords = [];
    fetch('...')
```

**Container selector:** `.container`
```javascript
const container = document.querySelector('.container');
```

**JSON parsing:** Segments format
```javascript
data.segments.forEach(segment => {
    allWordsFromSegments = allWordsFromSegments.concat(segment.words);
});
```

**Time mapping:** start_time/end_time
```javascript
start: w.start_time || w.start,
end: w.end_time || w.end
```

**No DOMContentLoaded:** Script runs inline immediately

### Broken (Old Maya and Dan)

**Script location:** After `</div>` closes
```php
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
```

**Container selector:** Wrong or missing

**JSON parsing:** Wrong format expected

**Time mapping:** Direct start/end only

**DOMContentLoaded:** Delays execution, content already rendered

---

## TEMPLATE FOR ANY AGENT

### Step 1: Copy Working File
```bash
cp players-vs-game-improvement-irons.php NEW_BLOG.php
```

### Step 2: Change These 4 Things ONLY

1. **Line 20:** Audio filename
   ```php
   <source src="<?= base_url('serve-audio.php?file=NEW_AUDIO.mp3') ?>">
   ```

2. **Line 48:** JSON filename
   ```javascript
   fetch('<?= base_url('JSON/NEW_AUDIO.mp3.json') ?>')
   ```

3. **Line 83:** Selector (if different page structure)
   ```javascript
   const container = document.querySelector('.container'); // or '.blog-post'
   ```

4. **Lines 300+:** Blog text content
   - Extract transcript from JSON
   - Rewrite to match EXACTLY
   - Keep same structure

### Step 3: DO NOT CHANGE

- Script structure
- Event listeners
- CSS
- Variable names
- Logic flow
- Timing code
- Filter logic

---

## QUICK REFERENCE

### Extract Transcript from JSON
```python
import json
with open('public/JSON/YOUR_FILE.mp3.json') as f:
    data = json.load(f)
    transcript = ' '.join([seg['text'] for seg in data['segments']])
    print(transcript)
```

### Test If Seeking Works
```
DevTools → Network → Click MP3 request → Response Headers
Must see: Accept-Ranges: bytes
When seeking: HTTP 206 Partial Content
```

### Debug Console Messages
```
✅ Good:
"Loaded 1291 aligned words (filtered out spaces)"
"Wrapped 1280 word elements"

❌ Bad:
"Loaded 0 aligned words"
"Wrapped 0 word elements"
"Error loading timestamps"
```

---

## FILES CREATED

**Essential:**
- `public/serve-audio.php` - Handles byte-range requests (enables seeking)

**Working Examples:**
- `app/Views/blog/players-vs-game-improvement-irons.php` - Perfect implementation
- `app/Views/blog/mens-vs-womens-clubs.php` - Now rewritten to match transcript

**Audio Files:**
- `public/audio/Maya and Dan.mp3`
- `public/audio/Players Irons vs Game Improvement Irons.mp3`

**JSON Files:**
- `public/JSON/Maya and Dan.mp3.json` (1,291 words, segments format)
- `public/JSON/Players Irons vs Game Improvement Irons.mp3.json` (1,137 words, segments format)

---

## WHAT I FIXED IN MAYA AND DAN POST

1. Rewrote ENTIRE blog text to match JSON transcript exactly
2. Title: "Maya and Dan, when labels meet reality" (comma, lowercase)
3. Removed ALL em-dashes
4. Removed special Unicode dashes  
5. Fixed "Flex letters" - removed parentheses, used actual spoken format
6. Changed "Stiff" to "stiff", "Regular" to "regular" where spoken
7. "10 balls" not "ten balls"
8. "wrist to floor" not "wrist-to-floor"
9. Used EXACT working script from Players Irons
10. Removed all duplicate content

---

## FOR ANY FUTURE AGENT

**Use this file as the COMPLETE reference:** `players-vs-game-improvement-irons.php`

**MANDATORY PROCESS - Follow EXACTLY:**

1. **FIRST: Extract transcript from JSON**
   ```python
   import json
   data = json.load(open('public/JSON/YOUR_FILE.mp3.json'))
   transcript = ' '.join([seg['text'] for seg in data['segments']])
   print(transcript)
   ```

2. **Copy working file as template**
3. **Change ONLY these things:**
   - Audio filename
   - JSON filename
   - Blog text (rewrite to match transcript EXACTLY)
   
4. **Blog text rewrite checklist:**
   - ✅ Copy transcript word-for-word
   - ✅ Check EVERY hyphen (mid-profile vs game improvement vs swing weight)
   - ✅ Match ALL commas exactly
   - ✅ Keep stuttered words (didn didn't)
   - ✅ Convert bullet lists to paragraphs
   - ✅ Use numbers or words exactly as spoken
   - ✅ Match contractions (wanna vs want to)
   
5. **Test with checklist**

**DO NOT:**
- ❌ Guess at hyphens or assume standard grammar
- ❌ Skip extracting the full transcript
- ❌ Keep bullet lists if audio speaks continuously
- ❌ Remove "errors" like doubled words - they're in the audio!
- ❌ Use DOMContentLoaded
- ❌ Change working script logic
- ❌ Assume commas - check every single one

**REALITY CHECK:** Every audio file is unique. "swing-weight" is hyphenated in one blog, "swing weight" is two words in another. ALWAYS check the JSON transcript first!

**The system is proven and works. Follow it exactly.**

---

Last Updated: October 14, 2025

**Five blog posts now have perfectly aligned audio players:**
1. ✅ Players Irons vs Game Improvement Irons
2. ✅ Men's vs Women's Clubs (Maya and Dan)
3. ✅ When the Club Found Its Weight
4. ✅ The Golfer Who Found Trust in His Shaft (version 2)
5. ✅ Eli's Journey: When Numbers Meet Feel
6. ✅ Daniel's Search for the Perfect Middle Path

**All use identical working code with text matched perfectly to transcripts.**

