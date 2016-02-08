<?php
/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 21:55
 */

include "common.php";

if(isset($_POST['action'])) {
    //@todo doing some action
} else {
    require "view/index.php";
}