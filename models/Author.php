<?php

/**
 * Created by PhpStorm.
 * User: krivov
 * Date: 08.02.16
 * Time: 22:02
 */
class Author
{
    public $id = NULL;
    public $firstname = '';
    public $middlename = '';
    public $surname = '';

    function __construct($array = array())
    {
        $this->id = !isset($array['id'])? : $array['id'];
        $this->firstname = !isset($array['firstname'])? : $array['firstname'];
        $this->lastname = !isset($array['lastname'])? : $array['lastname'];
        $this->middlename = !isset($array['middlename'])? : $array['middlename'];
    }
}