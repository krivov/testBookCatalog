<?php
/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 21:56
 */

return array(
    'database' => array(
        'host' => 'localhost',
        'database' => 'booktest',
        'user' => 'root',
        'password' => 'root',
    ),
    'upload' => array(
        'dir' => realpath(dirname(__FILE__)) . '/../public/upload/'
    ),
);