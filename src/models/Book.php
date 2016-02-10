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
        $this->picture = isset($array['picture'])? $array['picture'] : NULL;
        $this->fillParams($array);
    }

    public function fillParams($array) {
        $this->name = isset($array['name'])? $array['name'] : '';
        $this->date = isset($array['date'])? $array['date'] : NULL;
    }

    public function uploadPicture() {

        if (isset($_FILES['book_picture']) && $_FILES['book_picture']['tmp_name']) {
            $file = $_FILES['book_picture'];
        } else {
            return false;
        }

        $size = getimagesize($file['tmp_name']);

        if ($size[0] > 200 && $size[1] > 200) {
            $this->_errors[] = 'Не верный размер загружаемого изображения. Размеры картинки должны быть ограничены 200x200px';
            return false;
        }

        $validTypes = array(
            "image/jpg" => 'jpg',
            "image/jpeg" => 'jpeg',
            "image/gif" => 'gif',
            "image/png" => 'png',
        );

        if (in_array($size['mime'], array_keys($validTypes))) {
            $extension = $validTypes[$size['mime']];
        } else {
            $this->_errors[] = 'Не верный формат загружаемого изображения. Разрешено загружать форматы jpg, jpeg, gif, png';
            return false;
        }

        $config = Configs::getBlock('upload');
        $uploadDir = $config->dir;

        $fileName = md5(time() . $file['name']) . "." . $extension;
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {

            if ($this->picture && file_exists($uploadDir . $this->picture)) {
                unlink($uploadDir . $this->picture);
            }

            $this->picture = $fileName;
            return true;
        } else {
            $this->picture = '';
            $this->_errors[] = 'Не удалось загрузить картинку.';
            return false;
        }
    }

    public function withAuthors()
    {
        if ($this->id) {
            $this->authors = Source::getInstance()->getAllAuthors($this->id);
        }

        return $this;
    }
}