<?php

/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 22:01
 */
class Book
{
    public $id;
    public $name;
    public $date;
    public $picture;

    function __construct($array = array())
    {
        $this->id = isset($array['id'])? $array['id'] : NULL;
        $this->name = isset($array['name'])? $array['name'] : '';
        $this->date = isset($array['date'])? $array['date'] : NULL;
        $this->picture = isset($array['picture'])? $array['picture'] : NULL;
    }
}