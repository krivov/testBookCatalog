<?php
/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 21:55
 */

include "../src/common.php";

if(isset($_GET['page'])) {
    switch($_GET['page']) {
        case 'book':
            include "controller/book.php";
            break;
        case 'addedit':
            include "controller/form.php";
            break;
        case 'delete':
            include "controller/delete.php";
            break;
    }
} else {

    //return all books
    include "controller/index.php";
}