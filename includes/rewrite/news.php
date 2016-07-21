<?php
if (!defined("IN_FUSION"))
    die("Access Denied");

if (!isset($settings))
    $settings['newsperpage'] = 10;

$rules = array(
    'readmore'      => '#^([0-9]+)$#',
    'page'          => '#^page-([0-9]+)$#',
    'readmore_page' => '#^([0-9]+)/page-([0-9]+)$#'
);

if (isset($_GET['params'])) {
    if (preg_match($rules['readmore'], $_GET['params'], $matches)) {
        $_GET['readmore'] = $matches[0];
    } elseif (preg_match($rules['page'], $_GET['params'], $matches)) {
        $rowstart = 0;
        if ($matches[1] - 1 >= 0)
            $rowstart = ($matches[1] - 1) * $settings['newsperpage'];

        $_GET['rowstart'] = $rowstart;
    } elseif (preg_match($rules['readmore_page'], $_GET['params'], $matches)) {
        $_GET['readmore'] = $matches[1];
        $rowstart         = 0;
        if ($matches[2] - 1 >= 0)
            $rowstart = ($matches[2] - 1);

        $_GET['rowstart'] = $rowstart;
    }
}

include_once BASEDIR.'news.php';

