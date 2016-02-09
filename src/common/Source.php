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

        mysqli_set_charset($connection, "utf8");

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
    public function getAllBooks($page = 1, $limit = 10, $order = 'ASC', $field = 'name') {

        $limitFrom = ($page-1)*$limit;

        $query = "SELECT book.* FROM `book` ORDER BY $field $order LIMIT $limitFrom, $limit";
        $res = mysqli_query(Source::$_connection, $query);

        $resultArray = array();

        while($row = mysqli_fetch_array($res))
        {
            $resultArray[] = new Book($row);
        }

        return $resultArray;
    }

    /**
     * get book by ID
     */
    public function getBook($id) {

        $query = "SELECT book.* FROM `book` WHERE book.id = " . (int)$id;
        $res = mysqli_query(Source::$_connection, $query);

        if ($res->num_rows) {
            $resultArray = mysqli_fetch_array($res);
            return new Book($resultArray);
        } else {
            return NULL;
        }
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

    /**
     * get all authors
     */
    public function getAllAuthors($idBook = NULL) {
        $query = "SELECT a.* FROM author AS a";

        if ($idBook) {
            $query .= " LEFT JOIN book_author AS ba ON ba.id_author = a.id WHERE ba.id_book = " . (int)$idBook;
        }

        $res = mysqli_query(Source::$_connection, $query);

        $resultArray = array();

        while($row = mysqli_fetch_array($res))
        {
            $resultArray[] = new Author($row);
        }

        return $resultArray;
    }
}