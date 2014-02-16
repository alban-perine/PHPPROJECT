<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/01/14
 * Time: 15:00
 */

namespace Model;

use Http\Request;

class JsonFinder implements FinderInterface, DeleteInterface {

    /**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll()
    {
        $json_chaine = array();
        $json_chaine= file_get_contents(__DIR__.'/../Data/statuses.json');

        return json_decode($json_chaine, true);
    }

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed $id
     * @return null|mixed
     */
    public function findOneById($id)
    {
        $json_chaine = array();
        $json_chaine= file_get_contents(__DIR__.'/../Data/statuses.json');
        $json_chaine = json_decode($json_chaine, true);
        $json_chaine = $json_chaine["statuses"];
        //$json_chaine = $json_chaine[$id];
        if(isset($json_chaine[$id])){
            $json_chaine = $json_chaine[$id];
        }else{
            $json_chaine = null;
        }

        return $json_chaine;

    }

    public function addStatus(Request $request){
        $json_chaine= file_get_contents(__DIR__.'/../Data/statuses.json');
        $chaine = json_decode($json_chaine, true);
        $array = $chaine["statuses"];

        $status = array();
        $status["id"] = end($array)["id"]+1;
        $status["username"] = $request->getParameter("username");
        $status["message"] = $request->getParameter("message");
        $status["date"] = date("Y-m-d g:i");

        array_push($array,$status);
        $chaine["statuses"] = $array;
        $json_chaine = json_encode($chaine,true);
        file_put_contents(__DIR__.'/../Data/statuses.json',$json_chaine);

    }

    public function removeOneById($id){
        $json_chaine= file_get_contents(__DIR__.'/../Data/statuses.json');
        $chaine = json_decode($json_chaine, true);
        $array = $chaine["statuses"];
        unset($array[$id]);
        $chaine["statuses"]= $array;
        $json_chaine = json_encode($chaine,true);
        file_put_contents(__DIR__.'/../Data/statuses.json',$json_chaine);
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