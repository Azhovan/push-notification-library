<?php

namespace PushNotification\Message;

use PushNotification\Message\Config\Provider;

abstract class BasicMessageAbstract
{
    use Provider;

    /** @var  string */
    protected $provider;

    /** @var  array of users which targeted */
    protected $targets;

    /** @var  string */
    protected $title;

    /** @var  string */
    protected $body;

    /** @var */
    protected $data;

    /** @var  string related action like : events, coins,... */
    private $action;

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     * @return BasicMessageAbstract
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @param mixed $targets
     * @return BasicMessageAbstract
     */
    public function setTargets($targets)
    {
        $this->targets = $targets;
        return $this;
    }

    /**
     * @param string $action
     * @return BasicMessageAbstract
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param mixed $data
     * @return BasicMessageAbstract
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $title
     * @return BasicMessageAbstract
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $body
     * @return BasicMessageAbstract
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * create data block message
     * @return mixed
     */
    abstract protected function data();

    /**
     * create full message
     * @param string $provider decide to make message for which provider
     * @return mixed
     */
    abstract protected function make($provider = null);



}