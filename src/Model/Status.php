<?php

namespace Model;

class Status
{
    private $id;
    private $message;
    private $username;
    private $date;

    public function __construct($id,$message, $username, $date)
    {
        $this->message      = $message;
        $this->id           = $id;
        $this->username     = $username;
        $this->date         = $date;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getDate()
    {
        return $this->date->format('Y-m-d H:i:s');;
    }

}