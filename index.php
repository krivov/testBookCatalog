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
} elseif(isset($_GET['page'])) {

} else {

    //return all books
    $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit'])? (int)$_GET['limit'] : 10;

    $count = Source::getInstance()->getBookCount();
    $allBooks = Source::getInstance()->getAllBooks($page, $limit);

    require "view/index.php";
}