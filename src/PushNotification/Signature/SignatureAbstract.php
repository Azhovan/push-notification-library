<?php

namespace PushNotification\Signature;

abstract class SignatureAbstract
{

    /** @var  string the application Authorization key */
    protected $certification;

    /** @var  array */
    protected $header;

    /** @var  string */
    protected $endPoint;

    /** @var  string  */
    protected $contentType;

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return SignatureAbstract
     */
    abstract protected function setContentType();


    /**
     * return certification for specific service
     * @return mixed
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @return SignatureAbstract
     */
    abstract public function setCertification();


    /**
     * endpoint used for this reason
     * @return mixed
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * @return SignatureAbstract
     */
    abstract protected function setEndPoint();


    /**
     * @return array
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return SignatureAbstract
     */
    abstract protected function setHeader();


}