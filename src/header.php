<?php

/**
 * html_header
 * header部分を出力
 * @param  mixed $title ページタイトル
 * @param  mixed $body_id <body id="">のid
 * @return void
 */
function html_header($title, $body_id = ""){

echo <<<HTML

<!DOCTYPE html>
<html class="theme-dark" lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title - Hit & Blow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bulma-toast@2.4.4/dist/bulma-toast.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="$body_id">
HTML;
}