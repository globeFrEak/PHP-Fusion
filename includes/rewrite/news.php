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

if (isset($_GET['params'])) {
    $params = explode('/', $_GET['params']);
    // URL: BASDIR/news/1
    if (preg_match($rules['numbers'], $params[0], $matches)) {
        $query = "?readmore=" . $matches[0];
    }
    // URL: BASDIR/news/row/1
    if (preg_match($rules['numbers'], $params[1], $matches) && $params[0] === 'row') {
        $query = "?rowstart=" . $matches[0];
    }
    // Load site with GET parameters
    header("Location: " . $settings['siteurl'] . "news.php" . $query);
} else {
    // $params is set by function paseLink on maincore.php
    // 
    // translate origin Link to SEF/SEO Link
    // (news.php?readmore=1 => news/1) 
    if (isset($params['readmore'])) {
        $query = "news/" . $params['readmore'];
    }
    // translate origin Link to SEF/SEO Link
    // (news.php?rowstart=1 => news/row/1) 
    if (isset($params['rowstart'])) {
        $query = "news/row/" . $params['rowstart'];
    }
    // $seoLink returns to function parseLink on maincore.php
    $seoLink = $settings['site_host'] . $settings['site_path'] . $query;
}
?>