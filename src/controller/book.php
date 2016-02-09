<?php
/**
 * Created by PhpStorm.
 * User: Sergey Krivov (sergey@krivov.info)
 * Date: 09.02.2016
 * Time: 14:59
 */

$book = NULL;
if (isset($_GET['id'])) {
    $book = Source::getInstance()->getBook($_GET['id']);
}

if ($book) {
    $book->withAuthors();
    require "view/book.php";
} else {
    header("Location: /");
}