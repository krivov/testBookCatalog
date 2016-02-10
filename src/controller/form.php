<?php
/**
 * Created by PhpStorm.
 * User: Sergey Krivov (sergey@krivov.info)
 * Date: 09.02.2016
 * Time: 15:03
 */

$book = new Book();
$authors = Source::getInstance()->getAllAuthors();

if (isset($_GET['id'])) {
    $book = Source::getInstance()->getBook($_GET['id']);
    if (!$book) {
        header("Location: /");
    }
    $book->withAuthors();
}

if (isset($_POST['book'])) {
    if (isset($_GET['id'])) {
        Source::getInstance()->editBook($book, $_POST['book']);
    } else {
        $book = new Book($_POST['book']);
        Source::getInstance()->addBook($book, $_POST['book']['authors']);
    }

    if (count($book->_errors) == 0) {
        header("Location: /?page=book&id=" . $book->id);
    }
}

require "view/form.php";