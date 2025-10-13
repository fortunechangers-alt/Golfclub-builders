<?php
/**
 * Audio File Server with Byte-Range Support
 * This enables seeking in HTML5 audio players
 */

// Get the requested file from query parameter
$file = $_GET['file'] ?? '';

// Security: only allow files from audio directory
$audioDir = __DIR__ . '/audio/';
$filePath = $audioDir . basename($file);

// Check if file exists
if (empty($file) || !file_exists($filePath)) {
    header("HTTP/1.1 404 Not Found");
    exit("Audio file not found");
}

// Get file info
$fileSize = filesize($filePath);
$fileName = basename($filePath);

// Set headers
header("Content-Type: audio/mpeg");
header("Accept-Ranges: bytes");
header("Cache-Control: public, max-age=604800");

// Check if client sent a Range request
$range = $_SERVER['HTTP_RANGE'] ?? '';

if (!empty($range)) {
    // Parse the range header (e.g., "bytes=1024-2047")
    if (preg_match('/bytes=(\d+)-(\d*)/', $range, $matches)) {
        $start = intval($matches[1]);
        $end = !empty($matches[2]) ? intval($matches[2]) : $fileSize - 1;
        
        // Validate range
        if ($start > $fileSize - 1 || $end > $fileSize - 1) {
            header("HTTP/1.1 416 Requested Range Not Satisfiable");
            header("Content-Range: bytes */$fileSize");
            exit();
        }
        
        $length = $end - $start + 1;
        
        // Send partial content response
        header("HTTP/1.1 206 Partial Content");
        header("Content-Range: bytes $start-$end/$fileSize");
        header("Content-Length: $length");
        
        // Open file and seek to start position
        $fp = fopen($filePath, 'rb');
        fseek($fp, $start);
        
        // Read and output the requested range
        $buffer = 8192;
        $bytesRemaining = $length;
        
        while ($bytesRemaining > 0 && !feof($fp)) {
            $chunkSize = min($buffer, $bytesRemaining);
            echo fread($fp, $chunkSize);
            $bytesRemaining -= $chunkSize;
            flush();
        }
        
        fclose($fp);
        exit();
    }
}

// No range request - send entire file
header("HTTP/1.1 200 OK");
header("Content-Length: $fileSize");

readfile($filePath);
exit();

