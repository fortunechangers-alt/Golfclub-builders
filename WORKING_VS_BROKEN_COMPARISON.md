# Audio Highlighting - Working vs Broken Comparison

## ✅ WORKING: players-vs-game-improvement-irons.php

### Key Characteristics:

1. **Script Location**: INSIDE `<article>` tag (line 43)
   - Runs immediately after audio player
   - Before content is rendered

2. **Container Selector**: Uses `.container`
   ```javascript
   const container = document.querySelector('.container');
   ```

3. **No DOMContentLoaded wrapper**: Script runs inline

4. **JSON Structure**: Uses segments
   ```javascript
   if (data.segments && data.segments.length > 0) {
       data.segments.forEach(segment => {
           allWordsFromSegments = allWordsFromSegments.concat(segment.words);
       });
   }
   ```

5. **Timestamp mapping**: Converts start_time/end_time
   ```javascript
   start: w.start_time || w.start,
   end: w.end_time || w.end
   ```

---

## ❌ BROKEN: mens-vs-womens-clubs.php

### Key Problems:

1. **Script Location**: AFTER `</div>` closes (line 88)
   - Outside the blog-content div
   - After content already rendered
   - Wrapped in DOMContentLoaded

2. **Container Selector**: Uses `.blog-post`
   ```javascript
   const blogPost = document.querySelector('.blog-post');
   ```

3. **DOMContentLoaded wrapper**: Delays execution

4. **JSON Structure**: Uses direct words array
   ```javascript
   if (data.words && data.words.length > 0) {
       allWords = data.words.filter(...)
   }
   ```

5. **Timestamp mapping**: Uses direct start/end
   ```javascript
   start: w.start,
   end: w.end
   ```

---

## 🎯 CRITICAL DIFFERENCES

| Feature | Working | Broken |
|---------|---------|--------|
| Script placement | Inside `<article>` tag | After `</div>` closes |
| Runs when | Immediately inline | DOMContentLoaded event |
| Container | `.container` | `.blog-post` |
| JSON parsing | Segments → words | Direct words |
| Time fields | start_time/end_time | start/end |

---

## ✅ FIX CHECKLIST

To make mens-vs-womens-clubs work like players-irons:

- [ ] 1. Move script INSIDE blog-content div (before closing tag)
- [ ] 2. Remove DOMContentLoaded wrapper
- [ ] 3. Keep `.blog-post` selector (it's correct for this page)
- [ ] 4. Keep direct words parsing (JSON format is different)
- [ ] 5. Keep start/end fields (JSON format is different)
- [ ] 6. Verify audio player has id="audioPlayerSticky"
- [ ] 7. Verify serve-audio.php is used
- [ ] 8. Text matches JSON transcript exactly

---

## 📝 THE ACTUAL FIX NEEDED

Move the `<script>` tag from line 88 (after </div>) to INSIDE the blog-content div, right after the audio player, like the working version has it.

**From:**
```php
</div>  <!-- Closing blog-content -->

<script>
// Script here
</script>
```

**To:**
```php
<div class="blog-content">
    <!-- Content here -->
    
    <script>
    // Script here (INSIDE the div)
    </script>
</div>
```

This is THE critical fix!

