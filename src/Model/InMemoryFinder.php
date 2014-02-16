<?php

namespace Model;

use Exception\StatusIdException;

class InMemoryFinder implements FinderInterface,DeleteInterface
{

    private $app = array(
        '1' => 'first',
        '2' => 'second',
        '3' => 'third',
        '4' => 'four',
    );

    public function findAll(){
        return $this->app;
    }

    public function findOneById($id){
        if(empty($this->app[$id]))
            throw new StatusIdException(500, "L'id du statut n'existe pas.");
        return $this->app[$id];
    }

    public function RemoveOneById($id){
        return null;
    }

    /**
     * Returns elements using criteria.
     *
     * @return array
     */
    public function findCriteria($criteria)
    {
        // TODO: Implement findCriteria() method.
    }
}