<?php
/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 21:55
 */

include "../src/common.php";

if(isset($_POST['action'])) {
    //@todo doing some action
} elseif(isset($_GET['page'])) {
    switch($_GET['page']) {
        case 'book':
            $book = NULL;
            if (isset($_GET['id'])) {
                $book = Source::getInstance()->getBook($_GET['id']);
                $authors = Source::getInstance()->getAllAuthors($book->id);
            }

            if ($book) {
                require "view/book.php";
            } else {
                header("Location: /");
            }
            break;
        case 'addedit':
            require "view/form.php";
            break;
    }
} else {

    //return all books
    $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit'])? (int)$_GET['limit'] : 10;
    $order = (isset($_GET['order']) && $_GET['order'] === 'DESC')?
        $_GET['order'] : 'ASC';
    $orderField = (isset($_GET['order_field']) && $_GET['order_field'] === 'date')?
        $_GET['order_field'] : 'name';


    $count = Source::getInstance()->getBookCount();
    $allBooks = Source::getInstance()->getAllBooks($page, $limit, $order, $orderField);

    require "view/index.php";
}