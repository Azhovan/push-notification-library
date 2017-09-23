<?php

namespace  PushNotification\Device;

interface DeviceInterface
{
    /**
     * return device id
     * @return mixed
     */
    public function getId();

    /**
     * set the device id
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * set token which is useed for user
     * @param $token
     * @return mixed
     */
    public function setToken($token);


    /**
     * get the unique user token
     * @return mixed
     */
    public function getToken();

}