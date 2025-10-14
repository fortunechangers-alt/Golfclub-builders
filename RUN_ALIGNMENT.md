# Generate Word-Level Alignment for Maya and Dan

## Step 1: Make sure blog-text.txt has the complete blog text

The file `blog-text.txt` needs to have the EXACT text from the blog post (all paragraphs, headings, lists).

## Step 2: Run the alignment script

```bash
cd /Users/willisfamily/Movies/CacheClip/audio/Applications/XAMPP/xamppfiles/htdocs/Projects/golf_builders_2
chmod +x generate-alignment.sh
./generate-alignment.sh
```

## Step 3: Check the result

This will create: `public/JSON/maya-dan-aligned.json`

This file will have word-by-word timestamps perfectly aligned to your blog text!

## Step 4: Update the code

Once you have the aligned JSON, I'll update the blog post to use it.

---

**IMPORTANT:** Don't commit the generate-alignment.sh file with your API key! Keep it local only.

