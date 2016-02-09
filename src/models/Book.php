<?php

/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 22:01
 */
class Book
{
    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $date;

    /** @var string */
    public $picture;

    /** @var Author[] */
    public $authors = array();

    /** @var array */
    public $_errors = array();

    /**
     * Book constructor.
     *
     * @param array $array
     */
    function __construct($array = array())
    {
        $this->id = isset($array['id'])? $array['id'] : NULL;
        $this->name = isset($array['name'])? $array['name'] : '';
        $this->date = isset($array['date'])? $array['date'] : NULL;
        $this->picture = isset($array['picture'])? $array['picture'] : NULL;
    }

    public function withAuthors()
    {
        if ($this->id) {
            $this->authors = Source::getInstance()->getAllAuthors($this->id);
        }

        return $this;
    }

    public function isValid() {
        return true;
    }
}