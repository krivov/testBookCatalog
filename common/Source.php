<?php

/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 22:34
 */
class Source
{
    protected static $_instance;
    protected static $_dbParams = NULL;

    protected static $_connection;
    protected static $_db;

    private function __construct()
    {
        if (!self::$_dbParams) {
            throw new Exception('Error: Empty database connection params.');
        }

        $dbParams = self::$_dbParams;

        $connection = mysqli_connect($dbParams['host'], $dbParams['user'], $dbParams['password']);

        if (!$connection) {
            throw new Exception('Error: Unable to connect to MySQL.');
        }

        $db = mysqli_select_db($connection, $dbParams['database']);

        if (!$db) {
            throw new Exception('Error: Unable to connect to MySQL.');
        }

        self::$_connection = $connection;
        self::$_db = $db;
    }

    /**
     * Set default params to connect to database
     *
     *
     * @param $dbParams
     * array(
     *     'host' => 'localhost',
     *     'database' => 'name',
     *     'user' => 'user',
     *     'password' => '',
     * )
     */
    public static function setDefaultParams($dbParams)
    {
        self::$_dbParams = $dbParams;
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    /**
     * get count of all books
     */
    public function getBookCount() {

    }

    /**
     * get all books with page and limit
     */
    public function getAllBooks($page, $limit) {

    }

    /**
     * edit book
     */
    public function editBook() {

    }

    /**
     * add book
     */
    public function addBook() {

    }

    /**
     * delete book
     */
    public function deleteBook() {

    }
}