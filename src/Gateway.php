<?php

namespace Omnipay\IngWebPay;

use Omnipay\Common\AbstractGateway;

/**
 * IngWebPay Gateway
 *
 * Quote: The IngWebPay engine is basically a "black box" which processes a purchaser's payment.
 *
 * @link https://www.IngWebPay.co.za/s/std/integration-guide
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'IngWebPay';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'userName' => '',
            'password' => '',
            'testMode' => false,
        );
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
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
        return $this->getParameter('return_url');
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IngWebPay\Message\PurchaseRequest', $parameters);
    }

    public function prePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IngWebPay\Message\PrePurchaseRequest', $parameters);
    }

    public function purchaseStatus(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IngWebPay\Message\PurchaseStatusRequest', $parameters);
    } 

    public function reversePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IngWebPay\Message\ReversePurchaseRequest', $parameters);
    }

    public function depositPurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IngWebPay\Message\DepositPurchaseRequest', $parameters);
    }
}
