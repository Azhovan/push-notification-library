<?php

namespace PushNotification\Device;

use PushNotification\Device\Config\DeviceConfig;
use PushNotification\Exceptions\DeviceException;

class DeviceFactory
{

    /** @var  DeviceFactory */
    private static $instance = null;

    /** @var  string current device */
    private $device;

    /** @var  string device id */
    private $deviceId;

    /** @var  string user token */
    private $token;

    /**
     * DeviceFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * singleton the creation
     * @return DeviceFactory
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DeviceFactory();
        }

        return self::$instance;
    }

    /**
     * set device
     * @param array $device like Android and AppleIOS
     * @return $this
     */
    public function setParam($device)
    {
        $this->device = $device['name'];
        $this->deviceId = $device['id'];
        $this->token = $device['token'];
        return $this;
    }

    /**
     * create an instance of the requested device
     * @return mixed
     */
    public function create()
    {
        if (!class_exists(DeviceConfig::DEVICE_NAMESPACE . $this->device)) {
            throw new DeviceException('device class does not exist');
        }

        $device = DeviceConfig::DEVICE_NAMESPACE . $this->device;
        $device = new $device();

        $device->setId($this->deviceId);
        $device->setToken($this->token);
        return $device;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode(array(
            'device_name' => $this->device,
            'device_id' => $this->deviceId,
            'user_token' => $this->token
        ));
    }


}