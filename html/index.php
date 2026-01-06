<?php

// basic setup
header("Vary: Accept-Encoding");
$slug = trim($_SERVER['REQUEST_URI'], '/');

// open the file
$file = fopen(__DIR__ . '/links.csv', 'r');
if ($file === false) {
    // problem opening file, fall out into 500
    header("Content-Type: text/plain; charset=utf-8");
    header("Cache-Control: public, max-age=300, s-maxage=300, stale-while-revalidate=86400, stale-if-error=604800");
    http_response_code(500);
    echo 'Internal server error';
    return;
}

// if slug is empty, show list of all links
if ($slug == '') {
    header("Content-Type: text/html; charset=utf-8");
    header("Cache-Control: public, max-age=300, s-maxage=300, stale-while-revalidate=86400, stale-if-error=604800");
    include 'home.inc';
    return;
}

// loop through file
while (($line = fgets($file)) !== false) {
    $line = explode(',', $line);
    $line = array_map(trim(...), $line);
    if ($slug == $line[0]) {
        // finish up and bounce if there's a hit
        header("Cache-Control: public, max-age=86400, s-maxage=86400, stale-while-revalidate=86400, stale-if-error=604800");
        header('Location: ' . $line[1], true, 301);
        return;
    }
}

// otherwise fall out into a 404
header("Content-Type: text/plain; charset=utf-8");
header("Cache-Control: public, max-age=300, s-maxage=300, stale-while-revalidate=86400, stale-if-error=604800");
http_response_code(404);
echo 'Link not found';
