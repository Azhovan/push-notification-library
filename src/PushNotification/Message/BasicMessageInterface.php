<?php

namespace PushNotification\Message;

interface BasicMessageInterface
{
    /**
     * create data block message
     * @return mixed
     */
    public function data();

    /**
     * create full message
     * @param string $provider decide to make message for which provider
     * @return mixed
     */
    public function make($provider = null);

    /**
     * get provider, this method identify to use socket(for apple ) OR http (for google)
     * @return mixed
     */
    public function getProvider();
}