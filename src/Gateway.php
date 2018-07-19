<?php
namespace Omnipay\IngWebPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\IngWebPay\Message\PurchaseRequest;
use Omnipay\IngWebPay\Message\PrePurchaseRequest;
use Omnipay\IngWebPay\Message\PurchaseStatusRequest;
use Omnipay\IngWebPay\Message\ReversePurchaseRequest;
use Omnipay\IngWebPay\Message\DepositPurchaseRequest;

/**
 * IngWebPay Gateway
 *
 */
class Gateway extends AbstractGateway
{

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'IngWebPay';
    }

    /**
     * Get the gateway parameters.
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'userName' => '',
            'password' => '',
        ];
    }

    /**
     *
     * @return string
     */
    public function getUserName(): string
    {
        return $this->getParameter('userName');
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setUserName(string $value)
    {
        return $this->setParameter('userName', $value);
    }

    /**
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getParameter('password');
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setPassword(string $value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     *
     * @param array $parameters
     * @return type
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return type
     */
    public function prePurchase(array $parameters = [])
    {
        return $this->createRequest(PrePurchaseRequest::class, $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return type
     */
    public function purchaseStatus(array $parameters = [])
    {
        return $this->createRequest(PurchaseStatusRequest::class, $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return type
     */
    public function reversePurchase(array $parameters = [])
    {
        return $this->createRequest(ReversePurchaseRequest::class, $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return type
     */
    public function depositPurchase(array $parameters = [])
    {
        return $this->createRequest(DepositPurchaseRequest::class, $parameters);
    }
}
