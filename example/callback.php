<?php

$url = 'http://cmiphp.local';
$html = file_get_contents($url);
file_put_contents('test.html', $html);