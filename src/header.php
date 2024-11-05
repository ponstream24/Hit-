<?php

function html_header($title){

echo <<<HTML

<!DOCTYPE html>
<html class="theme-dark" lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title - Hit & Blow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

HTML;
}