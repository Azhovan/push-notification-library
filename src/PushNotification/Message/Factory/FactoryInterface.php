<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/11/17
 * Time: 12:20 PM
 */

namespace PushNotification\Message;


interface FactoryInterface
{

    /**handle
     * create the strategy
     * @return mixed
     */
    public function create();


    /**
     * validate the data
     * @return mixed
     */
    public function validate();

    /**
     * @param $param
     * @return mixed
     */
    public function setParam($param);

}