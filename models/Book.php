<?php

/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 22:01
 */
class Book
{
    public $id = NULL;
    public $name = '';
    public $date = NULL;
    public $picture = NULL;

    function __construct($array = array())
    {
        $this->id = !isset($array['id'])? : $array['id'];
        $this->name = !isset($array['name'])? : $array['name'];
        $this->date = !isset($array['date'])? : $array['date'];
        $this->picture = !isset($array['picture'])? : $array['picture'];
    }
}