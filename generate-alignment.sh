#!/bin/bash

# Generate word-level alignment for Maya and Dan blog post
# You need an ElevenLabs API key

# Set your API key here
API_KEY="sk_44a98cfce1c47fce95c2e692d84066a79beeccc6209b9a81"

# Get the exact blog text (you'll need to paste your blog text here)
TEXT_FILE="blog-text.txt"

# Read the text content
TEXT_CONTENT=$(cat "$TEXT_FILE")

# Run forced alignment (text as string, not file)
curl -X POST https://api.elevenlabs.io/v1/forced-alignment \
  -H "xi-api-key: $API_KEY" \
  -H "Content-Type: multipart/form-data" \
  -F file=@"public/audio/Maya and Dan.mp3" \
  -F text="$TEXT_CONTENT" \
  -o "public/JSON/maya-dan-aligned.json"

echo "✅ Alignment complete! Check public/JSON/maya-dan-aligned.json"

