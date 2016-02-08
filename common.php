<?php
/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 22:06
 */

include_once "common/Source.php";
include_once "models/Book.php";
include_once "models/Author.php";

$configs = include "config.php";

Source::setDefaultParams($configs['database']);