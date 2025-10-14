# Test Audio Highlighting - Debugging Guide

## 🧪 How to Test mens-vs-womens-clubs

### Step 1: Hard Refresh
- Press **Cmd+Shift+R** (Mac) or **Ctrl+Shift+F5** (Windows)
- This clears cached JavaScript

### Step 2: Open Browser Console
- Press **F12** or **Right-click → Inspect → Console**
- Keep console open while testing

### Step 3: Check Console Messages
You should see these messages appear:

```
✅ Loaded XXX aligned words (filtered out spaces)
✅ Wrapped XXX word elements
Setting up click listeners for XXX words
```

**If you DON'T see these messages:**
- There's a JavaScript error (check console for red errors)
- The fetch failed (JSON file not loading)
- The script isn't running

### Step 4: Test Highlighting
- Click **Play** on audio player
- Words should highlight in yellow as audio plays
- If highlighting works ✅
- If no highlighting ❌ check console for errors

### Step 5: Test Click-to-Seek
- Click on any word in the article
- Console should show: "Seeking to: X.XX seconds"
- Audio should jump to that word
- If works ✅
- If doesn't work ❌ tell me what console shows

---

## 🐛 Common Issues

### Issue: No console messages at all
**Cause:** JavaScript not loading
**Fix:** Check if script tags are closed properly

### Issue: "Loaded 0 aligned words"
**Cause:** JSON file not found or wrong format
**Fix:** Verify `public/JSON/maya-dan-aligned.json` exists

### Issue: "Wrapped 0 word elements"  
**Cause:** Selectors not finding elements
**Fix:** Audio player might have wrong ID

### Issue: Highlighting works but click doesn't
**Cause:** Click listeners not attached or wrong index
**Fix:** Check console when clicking - should show "Seeking to: X"

---

## 📊 Expected Console Output

When page loads:
```
✅ Loaded 150 aligned words (filtered out spaces)
✅ Wrapped 1000 word elements
Setting up click listeners for 1000 words
```

When you click a word:
```
Seeking to: 45.5
```

When audio plays:
- Words highlight in yellow
- No console errors

---

## ✅ What to Tell Me

If highlighting doesn't work, tell me:
1. What messages appear in console when page loads?
2. Are there any RED errors in console?
3. When you click a word, what does console show?
4. Does the players-vs-game-improvement-irons post work?

This will help me fix it quickly!

