<?php

namespace Omnipay\IngWebPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * IngWebPay Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectUrl;
    protected $dataResponse;

    public function __construct(RequestInterface $request, $data, $dataResponse)
    {
        parent::__construct($request, $data);
        $this->dataResponse = $dataResponse;
    }

    public function isSuccessful()
    {
        return $this->dataResponse->errorCode == 0;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->dataResponse->formUrl;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }

    public function response()
    {
        return $this->dataResponse;
    }

    public function getMessage()
    {
        return $this->dataResponse->errorMessage;
    }
}
