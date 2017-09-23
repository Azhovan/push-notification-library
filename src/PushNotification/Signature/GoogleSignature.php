<?php

namespace PushNotification\Signature;

class GoogleSignature extends SignatureAbstract
{

    public function __construct()
    {
        $this->setCertification()
            ->setEndPoint()
            ->setHeader()
            ->setContentType();
    }

    /**
     * @return SignatureAbstract
     */
    public function setCertification()
    {
        $this->certification = 'key='.config('pushNotification.API_ACCESS_KEY');
        return $this;
    }

    /**
     * @return SignatureAbstract
     */
    public function setEndPoint()
    {
        $this->endPoint = config('pushNotification.PushUrl');
        return $this;
    }

    /**
     * @return SignatureAbstract
     */
    public function setHeader()
    {
        $this->header = array(
            'Authorization' => 'key=' . $this->getCertification(),
            'Content-Type' => 'application/json'
        );
        return $this;
    }

    /**
     * @param string $contentType
     * @return $this
     */
    public function setContentType()
    {
        $this->contentType = config('pushNotification.googleContentType');
        return $this;
    }
}