<?php

class MockConnection extends \Model\Connection
{
    private $query;
    public function __construct()
    {
        $this->query = '';
    }

    public function execute($preparedQuery){
        $this->query =
        $preparedQuery->execute();
    }
}