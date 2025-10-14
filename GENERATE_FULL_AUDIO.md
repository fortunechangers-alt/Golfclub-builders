# Generate Full Audio for mens-vs-womens-clubs Blog

## 📝 Current Situation

**Problem:** The current "Maya and Dan.mp3" audio only covers the first 3 paragraphs (~72 seconds, ~150 words).

**Goal:** Generate audio for the ENTIRE blog post (1,302 words, ~9-10 minutes).

---

## 🎯 What You Need To Do

### Step 1: Use the Full Text File
✅ **I've created it for you:** `~/Desktop/golf_updates/full-mens-vs-womens-text.txt`

This file contains the COMPLETE blog post text (1,302 words).

### Step 2: Generate Audio at ElevenLabs

1. **Go to:** https://elevenlabs.io/text-to-speech
2. **Paste** the entire contents of `full-mens-vs-womens-text.txt`
3. **Choose voice:** (Use the same voice you used for Players Irons post for consistency)
   - Recommended: "Maya" or "Charlotte" or "Aria"
4. **Click Generate**
5. **Download the MP3** file
6. **Save it as:** `Maya and Dan FULL.mp3` (or rename to replace the current one)

### Step 3: Generate Alignment with ElevenLabs API

You need to use the ElevenLabs Forced Alignment API with the NEW full audio:

```bash
curl -X POST "https://api.elevenlabs.io/v1/audio-native/alignment" \
  -H "xi-api-key: YOUR_ELEVENLABS_API_KEY" \
  -F "audio=@YOUR_NEW_AUDIO_FILE.mp3" \
  -F "text=@full-mens-vs-womens-text.txt" \
  > maya-dan-aligned-FULL.json
```

**Replace:**
- `YOUR_ELEVENLABS_API_KEY` with your actual API key
- `YOUR_NEW_AUDIO_FILE.mp3` with the path to your downloaded audio

### Step 4: Replace the Files

Once you have the new files:

1. **Replace audio:** 
   - Old: `public/audio/Maya and Dan.mp3`
   - New: Your newly generated MP3

2. **Replace JSON:**
   - Old: `public/JSON/maya-dan-aligned.json`
   - New: Your newly generated alignment JSON

### Step 5: Test

1. Hard refresh the blog page
2. Play audio - should work for entire article
3. Highlighting should follow all the way through
4. Click any word anywhere - should seek to it

---

## 💡 Alternative: Use Your API Key Connection

You mentioned you have an API key connected to forced alignment. You can:

1. Upload the audio file you generate from Step 2
2. Upload the `full-mens-vs-womens-text.txt` file
3. Run forced alignment
4. Download the resulting JSON
5. Replace the files in public/audio and public/JSON

---

## ⚠️ Important Notes

- **File size:** Full audio will be ~10-15MB (vs current 11MB for partial)
- **Generation time:** May take 2-3 minutes at ElevenLabs
- **Cost:** Check your ElevenLabs credits
- **Quality:** The alignment should have loss < 0.1 for best results

---

## 📊 Expected Results

**Current (Partial Audio):**
- Duration: ~72 seconds  
- Words: ~150
- Coverage: First 3 paragraphs only

**After (Full Audio):**
- Duration: ~9-10 minutes
- Words: ~1,302
- Coverage: Entire blog post ✅

---

## 🎯 Quick Summary

1. ✅ Text file ready: `~/Desktop/golf_updates/full-mens-vs-womens-text.txt`
2. 🔲 Generate audio at ElevenLabs with this text
3. 🔲 Generate alignment JSON using ElevenLabs API
4. 🔲 Replace files in public/audio/ and public/JSON/
5. 🔲 Test - highlighting will work for entire article

---

**The blog code is already set up correctly - you just need the full audio + alignment files!**

