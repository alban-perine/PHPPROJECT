<?php
namespace Model;

interface DeleteInterface
{

    /**
     * Remove an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function RemoveOneById($id);
}
