<?php

/* -------------------------------------------------------+
  | PHP-Fusion Content Management System
  | Copyright (C) PHP-Fusion Inc
  | https://www.php-fusion.co.uk/
  +--------------------------------------------------------+
  | Filename: index.php
  | Author: Nick Jones (Digitanium)
  +--------------------------------------------------------+
  | This program is released as free software under the
  | Affero GPL license. You can redistribute it and/or
  | modify it under the terms of this license which you
  | can read by viewing the included agpl.txt or online
  | at www.gnu.org/licenses/agpl.html. Removal of this
  | copyright header is strictly prohibited without
  | written permission from the original author(s).
  +-------------------------------------------------------- */
require_once "maincore.php";

//SEF LINKS start
// GET parameter from .htaccess file
if (isset($_GET['key']) && $_GET['key'] != "" /* && validateGETVal($_GET['key']) */) {


    $finalLocation = findRewriteLocation($_GET['key']);

    if (!$finalLocation) {
        // no location found = 404
        header("HTTP/1.0 404 Not Found", "", "404");
        echo "OOOPS - Site not found! (Error 404)</br>";
        $db_connect = null;
        exit;
    }

    require_once $finalLocation;   
    $db_connect = null;
    exit;
}
// SEF LINKS end

redirect($settings['opening_page']);

$db_connect = null;
?>