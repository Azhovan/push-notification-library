<?php

namespace PushNotification\Message;


interface AppleMessage
{
    /**
     * generate aps message block for apns
     * @return mixed
     */
    public function aps();

    /**
     * set the unique id for message
     * @param $id
     * @return void
     */
    public function setId($id);

    /**
     * set the token for message
     * @param $token
     * @return void
     */
    public function setToken($token);

}