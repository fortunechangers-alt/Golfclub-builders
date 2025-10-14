<?php
// Test if headers are being sent correctly for audio files

$audioFile = __DIR__ . '/audio/Maya and Dan.mp3';

if (!file_exists($audioFile)) {
    die("Audio file not found: $audioFile");
}

$fileSize = filesize($audioFile);

echo "File: $audioFile\n";
echo "Size: " . number_format($fileSize) . " bytes\n\n";

// Simulate what should happen with range requests
echo "Testing HTTP Range Request Support:\n";
echo "─────────────────────────────────────\n\n";

// Check if mod_headers is loaded
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    echo "mod_headers loaded: " . (in_array('mod_headers', $modules) ? "YES ✅" : "NO ❌") . "\n";
    echo "mod_rewrite loaded: " . (in_array('mod_rewrite', $modules) ? "YES ✅" : "NO ❌") . "\n\n";
} else {
    echo "Cannot check Apache modules (not available)\n\n";
}

// Check what headers would be sent
echo "Headers that SHOULD be sent:\n";
echo "  Accept-Ranges: bytes\n";
echo "  Content-Type: audio/mpeg\n";
echo "  Content-Length: $fileSize\n\n";

echo "To verify, open this URL in your browser:\n";
echo "  " . "http://localhost/Projects/golf_builders_2/public/audio/Maya%20and%20Dan.mp3" . "\n\n";

echo "Then open DevTools → Network tab → Click on the MP3 request → Check Response Headers\n";
echo "You MUST see: Accept-Ranges: bytes\n\n";

echo "If you don't see it, the .htaccess is not working.\n";

