<?php

namespace Omnipay\IngWebPay\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * IngWebPay Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://securepay.ing.ro/mpi/rest/';
    protected $testEndpoint = 'https://securepay-uat.ing.ro/mpi_uat/rest/';

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }
    public function getUserName()
    {
        return $this->getParameter('userName');
    }

    public function setUserName($value)
    {
        return $this->setParameter('userName', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    } 

     public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function getOrderNumber()
    {
        return $this->getParameter('orderNumber');
    }

    public function setOrderNumber($value)
    {
        return $this->setParameter('orderNumber',$value);
    } 

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderId',$value);
    }

    public function getDescription()
    {
        return $this->getParameter('description');
    }

    public function getLanguage()
    {
        return $this->getParameter('language');
    } 

    public function getAmount()
    {
        return (string) round(ceil($this->getParameter('amount') * 100)); //in cents
    } 

    public function setAmount($value)
    {
        return $this->setParameter('amount',$value);
    }

    public function setLanguage($value)
    {
        return $this->setParameter('language',$value);
    }

     public function setEmail($value)
    {
        return $this->setParameter('email',$value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getData()
    {
        $this->validate('amount','orderNumber');

        $data = array();
        $data['userName'] = $this->getUserName();
        $data['password'] = $this->getPassword();
        $data['returnUrl'] = $this->getReturnUrl();
        $data['currency'] = $this->getCurrency() ?: 946;
        $data['orderNumber'] = $this->getOrderNumber();
        $data['description'] = $this->getDescription();
        $data['language'] = $this->getLanguage();
        $data['email'] = $this->getEmail();
        $data['amount'] = $this->getAmount();

        return $data;
    }

    public function sendData($data)
    {
        $jsonHttpResponse =  $this->sendTo($this->getEndpoint().'register.do',$data);

        return $this->response = new PurchaseResponse($this, $data, $jsonHttpResponse);
    }

    public function sendTo($url,$data)
    {
        $headers = array(
            'Content-Type' => 'text/json; charset=utf-8'
        );

        $httpResponse = $this->httpClient->post($url, $headers , $data)->send();
        $httpResponse = $httpResponse->getBody();

        return json_decode($httpResponse);
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
