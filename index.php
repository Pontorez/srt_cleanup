#!/bin/env php
<?php
$startTime = microtime(true);

for ($i = 0; $i < 500; $i++) {
    test();
}
echo microtime(true) - $startTime . " seconds\n";

function test() {
    $data = file_get_contents('dnd.srt');
    $data = explode("\r\n\r\n", $data);
    $result = '';
    foreach ($data as $srtPart) {
        $srtPart = explode("\r\n", $srtPart);
        array_shift($srtPart);
        array_shift($srtPart);
        $result .= implode(' ', $srtPart) . "\n";
    }

    $result = str_replace(",\n", ", ", $result);
    $result = preg_replace("/\n([a-z])/u", " \\1", $result);
    file_put_contents('done.txt', $result);
}
