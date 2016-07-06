<?php

/* -------------------------------------------------------+
  | PHP-Fusion Content Management System
  | Copyright (C) PHP-Fusion Inc
  | https://www.php-fusion.co.uk/
  +--------------------------------------------------------+
  | Filename: includes/rewrite/profile.php
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
    'lookup' => '#^([0-9]+)$#',
    'groupid' => '#^([0-9]+)$#'
);

if (isset($_GET['params'])) {
    $params = explode('/', $_GET['params']);
    // URL: BASDIR/profile/1
    if (preg_match($rules['lookup'], $params[0], $matches)) {
        $query = "?lookup=" . $matches[0];
    }
    // URL: BASDIR/profile/group/1
    if (preg_match($rules['groupid'], $params[1], $matches) && $params[0] === 'group') {
        $query = "?groupid=" . $matches[1];
    }
    // Load site with GET parameters
    header("Location: " . $settings['siteurl'] . "profile.php" . $query);
}
/* else {   
  // $params is set by function parseLink on maincore.php
  //
  // translate origin Link to SEF/SEO Link
  // (profile.php?lookup=1 => profile/1)
  if (isset($paramsSeo['lookup'])) {
  $querySeo = "profile/" . $paramsSeo['lookup'];
  }
  // translate origin Link to SEF/SEO Link
  // (profile.php?groupid=1 => profile/group/1)
  if (isset($paramsSeo['groupid'])) {
  $querySeo = "profile/group/" . $paramsSeo['groupid'];
  }
  }
 * 
 */
if (array_key_exists("profile", $rewriteRules) === FALSE) {
    $rewriteRules["profile"] = array(
        "lookup" => "profile/",
        "groupid" => "profile/group/"
    );
}
?>