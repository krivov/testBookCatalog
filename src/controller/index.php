<?php
/**
 * Created by PhpStorm.
 * User: Sergey Krivov (sergey@krivov.info)
 * Date: 09.02.2016
 * Time: 15:00
 */

$page = isset($_GET['p'])? (int)$_GET['p'] : 1;
$limit = isset($_GET['limit'])? (int)$_GET['limit'] : 3;
$order = (isset($_GET['order']) && $_GET['order'] === 'DESC')?
    $_GET['order'] : 'ASC';
$orderField = (isset($_GET['order_field']) && $_GET['order_field'] === 'date')?
    $_GET['order_field'] : 'name';


$count = Source::getInstance()->getBookCount();
$allBooks = Source::getInstance()->getAllBooks($page, $limit, $order, $orderField);

require "view/index.php";