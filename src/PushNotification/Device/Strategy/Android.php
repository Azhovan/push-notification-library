<?php

namespace PushNotification\Device\Strategy;

use PushNotification\Device\DeviceInterface;
use PushNotification\Signature\GoogleSignature;

/**
 * Class Android
 * @package PushNotification\Device\Strategy
 * @see IB-2023
 */
class Android implements DeviceInterface
{

    /** @var  string device id  */
    private $id;

    /** @var  string  */
    private $token;

    /** @var GoogleSignature  */
    private $signature;

    /**
     * Android constructor.
     * @param GoogleSignature $signature
     */
    public function __construct()
    {
        $this->signature = new GoogleSignature;
    }

    /**
     * @return GoogleSignature
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * return device id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set the device id
     * @param $id
     * @return mixed
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * get the unique user token
     * @return mixed
     */
    public function getToken()
    {
       return $this->token;
    }

    /**
     * set token which is useed for user
     * @param $token
     * @return mixed
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode(array(
            'device_id' => $this->id,
            'user_token' => $this->token
        ));
    }
}