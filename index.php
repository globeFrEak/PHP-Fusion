<?php
/*-------------------------------------------------------+
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
+--------------------------------------------------------*/
require_once "maincore.php";

if(isset($_GET['key']) && $_GET['key'] != "" /*&& validateGETVal($_GET['key'])*/) {
    // create a list of files in /includes/rewrite
    $rewriteFolder = makefilelist(INCLUDES."rewrite", ".|..");

    // create a list of folders in /infusions
    $infusionsFolder = makefilelist(INFUSIONS, ".|..", true, "folders");

    $locations = array_merge($infusionsFolder, $rewriteFolder);

    // create an array of possible locations
    $possLocations = array(
        $_GET['key'].".php",    // /includes/rewrite/
        $_GET['key']            // /infusions/__NAME__/
    );

    // find first location match
    $finalLocation = "";
    foreach ($locations as $location) {
        if($location == $possLocations[1] && file_exists(INFUSIONS.$location."/rewrite.php")) {
            $finalLocation = INFUSIONS.$possLocations[1]."/rewrite.php";
            break;
        }

        if($location == $possLocations[0]) {
            $finalLocation = INCLUDES."rewrite/".$possLocations[0];
            break;
        }
    }

    if($finalLocation == "") {
        // no location found = 404
        header("HTTP/1.0 404 Not Found", "", "404");
        $db_connect = null;
        exit;
    }

    require_once $finalLocation;

    $db_connect = null;
    exit;
}

redirect($settings['opening_page']);

?>