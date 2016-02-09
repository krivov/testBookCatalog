<?php
/**
 * Created by PhpStorm.
 * User: Sergey Krivov (sergey@krivov.info)
 * Date: 10.02.2016
 * Time: 01:43
 */

if (isset($_GET['id'])) {
    $book = Source::getInstance()->getBook($_GET['id']);
    if ($book) {
        Source::getInstance()->deleteBook($book);
    }
}

header("Location: /");