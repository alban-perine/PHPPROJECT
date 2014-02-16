<?php

namespace Model;

use Http\Request;

class StatusQuery implements FinderInterface,DeleteInterface
{
    private $databaseConnection;

    public function __construct($databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }
    /**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll()
    {
        $preparedQuery = $this->databaseConnection->prepare("SELECT * FROM statuses");
        $preparedQuery->execute();

        $arrayStatuses = array();
        foreach ($preparedQuery->fetchALL(\PDO::FETCH_ASSOC) as $result) {
            array_push($arrayStatuses, new Status($result['id'], $result['message'], $result['username'], new \DateTime($result['date'])));
        }

        return $arrayStatuses;
    }

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id)
    {
        $preparedQuery = $this->databaseConnection->prepare("SELECT * FROM statuses WHERE id = :id");
        $values = [':id' => $id];

        $preparedQuery->execute($values);
        $result = $preparedQuery->fetch(\PDO::FETCH_ASSOC);

        return ($result !== false) ? new Status($result['id'],$result['message'],  $result['username'], new \DateTime($result['date'])) : null;
    }

    /**
     * Add a status into the database.
     *
     * @param  Status        $status
     * @throws HttpException
     */
    public function addStatus(Request $request,$user)
    {
        $preparedQuery = $this->databaseConnection->prepare("INSERT INTO statuses (username, message, date) VALUES (:username, :message, :date)");
        $values = [':username' => $user,
            ':message' => $request->getParameter("message"),
            ':date' => date("Y-m-d H:i:s")];

        $preparedQuery->execute($values);
    }

    /**
     * Delete a status.
     *
     * @param Status $status The status to delete
     */
    public function removeOneById($id)
    {
        $preparedQuery = $this->databaseConnection->prepare("DELETE FROM statuses WHERE id = :id");
        $values = [':id' => $id];

        $preparedQuery->execute($values);
    }

    /**
     * Returns elements using criteria.
     *
     * @return array
     */
    public function findCriteria($criteria)
    {
        $sql = 'SELECT * FROM statuses';

        if(!empty($criteria['orderBy'])){
            $sql .= " ORDER BY " . $criteria['orderBy'];
            if(!empty($criteria['sort'])){
                $sql .= " " . $criteria['sort'];
            }
        }

        if(!empty($criteria['limit'])){
            $sql .= " LIMIT 0, " . $criteria['limit'];
        }



        $preparedQuery = $this->databaseConnection->prepare($sql);
        $preparedQuery->execute();

        $arrayStatuses = array();
        foreach ($preparedQuery->fetchALL(\PDO::FETCH_ASSOC) as $result) {
            array_push($arrayStatuses, new Status($result['id'], $result['message'], $result['username'], new \DateTime($result['date'])));
        }

        return $arrayStatuses;
    }
}