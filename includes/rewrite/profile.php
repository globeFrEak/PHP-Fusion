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
    'numbers' => '#^([0-9]+)$#'
);
//
// Rewrite rule for Link translation
//
if (isset($_GET['params']) && $_GET['key'] == "profile") {    
    $params = explode('/', $_GET['params']);
    unset($_GET);
    // URL: BASDIR/profile/1
    if (preg_match($rules['numbers'], $params[0], $matches)) {
        //$query = "?lookup=" . $matches[0];
        $_GET['lookup'] = $matches[0];       
    }
    // URL: BASDIR/profile/group/1
    if (preg_match($rules['numbers'], $params[1], $matches) && $params[0] === 'group') {
        //$query = "?groupid=" . $matches[1];
        $_GET['groupid'] = $matches[0];        
    }  
    var_dump($_GET);
    echo dirname(__DIR__);
    require_once dirname(__DIR__)."/../profile.php"; 
}
//
// Rewrite rules for Link creation
// 
// - array key name based on rewrite rule file name!!!
// - key for rule are the first GET parameter from url
// - value are the SEF/SEO url fragment 
//
if (!array_key_exists("profile", $rewriteRules)) {
    $rewriteRules["profile"] = array(
        "lookup" => "profile/",
        "groupid" => "profile/group/"
    );
}
?>