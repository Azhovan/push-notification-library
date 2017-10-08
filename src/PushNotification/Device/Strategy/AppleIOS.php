<?php

namespace PushNotification\Device\Strategy;


use PushNotification\Device\DeviceInterface;
use PushNotification\Exceptions\InvalidArgumentException;
use PushNotification\Signature\AppleSignature;

class AppleIOS implements DeviceInterface
{
    /** @var  string device id */
    private $id;

    /** @var  string */
    private $token;

    /** @var AppleIOS */
    private $signature;

    /**
     * Android constructor.
     */
    public function __construct()
    {
        $this->signature = new AppleSignature;
    }

    /**
     * @return AppleIOS
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
     * @return void
     * @exception InvalidArgumentException
     */
    public function setId($id)
    {
        if (!is_scalar($id)) {
            throw new InvalidArgumentException('Identifier must be a scalar value');
        }
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
     * set token which is used for user
     * @param $token
     * @exception InvalidArgumentException
     * @return void
     */
    public function setToken($token)
    {
        if (!is_string($token)) {
            throw new InvalidArgumentException(sprintf(
                'Device token must be a string, "%s" given.',
                gettype($token)
            ));
        }

        if (preg_match('/[^0-9a-f]/', $token)) {
            throw new InvalidArgumentException(sprintf(
                'Device token must be mask "%s". Token given: "%s"',
                '/[^0-9a-f]/',
                $token
            ));
        }

        if (strlen($token) == 0) {
            throw new InvalidArgumentException(sprintf(
                'Device token can not be empty, Token length given: %d.',
                mb_strlen($token)
            ));
        }

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
