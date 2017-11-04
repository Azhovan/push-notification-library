<?php

namespace PushNotification;
use Dotenv\Dotenv;
use PushNotification\Exceptions\PushException;

class Settings
{
    /** @var Dotenv  */
    private $setting;

    /** @var  string path to .env file */
    private $path = __DIR__ . '/../../';

    public function __construct()
    {
        if(!file_exists($this->path) || empty($this->path)) {
            throw new PushException('.env path is not set correctly, file:' . $this->path);
        }
        $this->setting = new Dotenv($this->path);
        $this->setting->load();
    }

}
