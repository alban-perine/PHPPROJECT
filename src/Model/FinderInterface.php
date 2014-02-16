<?php

namespace Model;

interface FinderInterface
{
    /**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll();
    /**
     * Returns elements using criteria.
     *
     * @return array
     */
    public function findCriteria($criteria);
    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id);
}
