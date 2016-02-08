<?php

/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 22:02
 */
class Author
{
    public $id;
    public $firstname;
    public $middlename;
    public $surname;

    function __construct($array = array())
    {
        $this->id = isset($array['id'])? $array['id'] : NULL;
        $this->firstname = isset($array['firstname'])? $array['firstname'] : NULL;
        $this->lastname = isset($array['lastname'])? $array['lastname'] : NULL;
        $this->middlename = isset($array['middlename'])? $array['middlename'] : NULL;
    }
}