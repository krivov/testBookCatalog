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
        self::$_dbParams = Configs::getBlock('database');

        if (!self::$_dbParams) {
            throw new Exception('Error: Empty database connection params.');
        }

        $dbParams = self::$_dbParams;

        $connection = mysqli_connect($dbParams->host, $dbParams->user, $dbParams->password);

        if (!$connection) {
            throw new Exception('Error: Unable to connect to MySQL.');
        }

        $db = mysqli_select_db($connection, $dbParams->database);

        if (!$db) {
            throw new Exception('Error: Unable to connect to MySQL.');
        }

        mysqli_set_charset($connection, "utf8");

        self::$_connection = $connection;
        self::$_db = $db;
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
        $query = "SELECT COUNT(book.id) FROM `book`";
        $res = mysqli_query(Source::$_connection, $query);

        if ($res) {
            $result = mysqli_fetch_row($res);
            return $result[0];
        } else {
            return 0;
        }
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
    public function getBook($id)
    {

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
     *
     * @param Book $book
     * @param      $array
     *
     * @return Book
     */
    public function editBook(Book $book, $array) {

        $book->fillParams($array);

        $date = $this->getDateForRequest($book->date);

        $query = "UPDATE book SET name = '" . mysqli_real_escape_string(Source::$_connection, $book->name)."', date = $date, picture = '$book->picture' WHERE id = " . $book->id;
        $res = mysqli_query(Source::$_connection, $query);

        if ($res) {
            if (isset($array['authors'])) {
                Source::getInstance()->addAuthorsToBook($array['authors'], $book);
            }

            if ($book->uploadPicture()) {
                $this->updateBookPicture($book);
            }

            return $book;
        } else {
            $book->_errors[] = "Ошибка при редактировании книги";
            return $book;
        }
    }

    /**
     * add book
     *
     * @param Book  $book
     * @param array $authors
     *
     * @return Book
     */
    public function addBook(Book $book, $authors = array()) {

        $date = $this->getDateForRequest($book->date);

        $query = "INSERT INTO book (name, date, picture) VALUES ('" . mysqli_real_escape_string(Source::$_connection, $book->name)."', $date, '$book->picture')";
        $res = mysqli_query(Source::$_connection, $query);

        if ($res) {
            $book->id = mysqli_insert_id(Source::$_connection);

            if ($authors) {
                Source::getInstance()->addAuthorsToBook($authors, $book);
            }

            if ($book->uploadPicture()) {
                $this->updateBookPicture($book);
            }

            return $book;
        } else {
            $book->_errors[] = "Ошибка при добавлении книги";
            return $book;
        }
    }

    public function updateBookPicture($book) {
        $query = "UPDATE book SET picture = '$book->picture' WHERE id = " . $book->id;
        $res = mysqli_query(Source::$_connection, $query);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * delete book
     *
     * @param Book $book
     */
    public function deleteBook(Book $book)
    {
        $queryDelete = "DELETE FROM book WHERE id = " . $book->id;
        $res = mysqli_query(Source::$_connection, $queryDelete);
    }

    /**
     * get all authors
     *
     * @param null  $idBook
     * @param array $authorsArray
     *
     * @return Author[]
     */
    public function getAllAuthors($idBook = NULL, $authorsArray = array())
    {
        $query = "SELECT a.* FROM author AS a";

        if ($idBook) {
            $query .= " LEFT JOIN book_author AS ba ON ba.id_author = a.id WHERE ba.id_book = " . (int)$idBook;
        } elseif(count($authorsArray) > 0) {
            $query .= " WHERE a.id IN (".implode(',', $authorsArray).")";
        }

        $res = mysqli_query(Source::$_connection, $query);

        $resultArray = array();

        while($row = mysqli_fetch_array($res))
        {
            $resultArray[] = new Author($row);
        }

        return $resultArray;
    }

    /**
     * @param      $authorsArray
     * @param Book $book
     */
    public function addAuthorsToBook($authorsArray, Book $book) {
        $authors = Source::getInstance()->getAllAuthors(NULL, $authorsArray);

        if ($authors) {

            $queryDelete = "DELETE FROM book_author WHERE id_book = " . $book->id;
            $res = mysqli_query(Source::$_connection, $queryDelete);

            $values = array();

            foreach ($authors as $author) {
                $values[] = "(" . $book->id . ", " . $author->id . ")";
            }

            $queryAdd = "INSERT INTO book_author (id_book, id_author) VALUES " . implode(",", $values);
            $res = mysqli_query(Source::$_connection, $queryAdd);

            if ($res) {
                $book->authors = $authors;
            }
        }
    }

    protected function getDateForRequest($dateString) {
        if ($dateString && preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}$/",$dateString)) {
            return "'".date("Y-m-d", strtotime($dateString))."'";
        } else {
            return "NULL";
        }
    }
}