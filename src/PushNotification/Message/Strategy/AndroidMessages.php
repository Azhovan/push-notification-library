<?php


namespace PushNotification\Message\Strategy;

use PushNotification\Message\AppleMessage;
use PushNotification\Message\BasicMessageInterface;
use PushNotification\Message\GoogleMessage;
use PushNotification\Message\Config\Provider;

/**
 * Class AndroidMessages
 * @package PushNotification\Message\Strategy
 */
class AndroidMessages implements BasicMessageInterface, GoogleMessage
{

    use Provider;

    /** @var  string */
    private $title;

    /** @var  string */
    private $body;

    /** @var */
    private $data;

    /** @var  string related action like : events, coins,... */
    private $action;

    /** @var  string */
    private $provider;

    /** @var  array of users which targeted */
    private $targets;

    public function __construct()
    {
        $this->setProvider(Provider::google());
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     * @return AndroidMessages
     */
    public function setProvider(string $provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @param mixed $targets
     * @return AndroidMessages
     */
    public function setTargets($targets)
    {
        $this->targets = $targets;
        return $this;
    }

    /**
     * @param string $action
     * @return AndroidMessages
     */
    public function setAction(string $action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param mixed $data
     * @return AndroidMessages
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $title
     * @return AndroidMessages
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $body
     * @return AndroidMessages
     */
    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * create full message
     * @param string $provider
     * @return mixed
     */
    public function make($provider = null)
    {
        $message = array(
            'registration_ids' => $this->targets(),
            'priority' => 'high',
            'notification' => $this->notification(),
            'data' => $this->data()
        );

        return $message;
    }

    /**
     * @return mixed
     */
    public function targets()
    {
        return $this->targets;
    }

    /**
     * generate message notification block for fcm
     * @return mixed
     */
    public function notification()
    {
        return array(
            'title' => $this->title,
            'body' => $this->body,
            "sound" => "default"
        );
    }

    /**
     * create message
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }

}