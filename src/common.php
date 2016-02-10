<?php
/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 22:06
 */

// Ensure src/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(dirname(__FILE__)),
    '.',
)));

include_once "common/Source.php";
include_once "common/Configs.php";
include_once "models/Book.php";
include_once "models/Author.php";

Configs::setConfigs(include "config.php");