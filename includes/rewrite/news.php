<?php

/* -------------------------------------------------------+
  | PHP-Fusion Content Management System
  | Copyright (C) PHP-Fusion Inc
  | https://www.php-fusion.co.uk/
  +--------------------------------------------------------+
  | Filename: includes/rewrite/news.php
  | Author: Patrick Conrad (SuNflOw1991)
  | Modified: Philipp Horna (globefreak)
  +--------------------------------------------------------+
  | This program is released as free software under the
  | Affero GPL license. You can redistribute it and/or
  | modify it under the terms of this license which you
  | can read by viewing the included agpl.txt or online
  | at www.gnu.org/licenses/agpl.html. Removal of this
  | copyright header is strictly prohibited without
  | written permission from the original author(s).
  +-------------------------------------------------------- */
if (!defined("IN_FUSION")) {
    die("Access Denied");
}

$rules = array(
    'numbers' => '#^([0-9]+)$#'
);
//
// Rewrite rule for Link translation
//
if (isset($_GET['params'])) {
    $params = explode('/', $_GET['params']);
    // URL: BASDIR/news/1
    if (preg_match($rules['numbers'], $params[0], $matches)) {
        $query = "?readmore=" . $matches[0];
        $_GET['readmore'] = $matches[0];
        include_once BASEDIR."news.php";
    }
    // URL: BASDIR/news/row/1
    if (preg_match($rules['numbers'], $params[1], $matches) && $params[0] === 'row') {
        $query = "?rowstart=" . $matches[0];
        $_GET['rowstart'] = $matches[0];
        header("Location: " . $settings['siteurl'] . "news.php" . $query);
    }   
}
//
// Rewrite rules for Link creation
// 
// - array key name based on rewrite rule file name!!!
// - key for rule are the first GET parameter from url
// - value are the SEF/SEO url fragment 
//
if (array_key_exists("news", $rewriteRules) === FALSE) {
    $rewriteRules["news"] = array(
        "readmore" => "news/",
        "rowstart" => "news/row/"
    );
}
?>