<?php
namespace Omnipay\IngWebPay\Message;

use Omnipay\IngWebPay\Message\CommonRequest;
use Omnipay\IngWebPay\Message\PurchaseResponse;

/**
 * IngWebPay Purchase Request
 */
class PurchaseRequest extends CommonRequest
{

    /**
     *
     * @return array
     */
    public function getData(): array
    {
        $this->validate('amount', 'orderNumber');

        $data = [];
        $data['userName'] = $this->getUserName();
        $data['password'] = $this->getPassword();
        $data['returnUrl'] = $this->getReturnUrl();
        $data['currency'] = $this->getCurrency();
        $data['orderNumber'] = $this->getOrderNumber();
        $data['description'] = $this->getDescription();
        $data['language'] = $this->getLanguage();
        $data['email'] = $this->getEmail();
        $data['amount'] = $this->getAmount();

        return $data;
    }

    /**
     *
     * @param array $data
     * @return type
     */
    public function sendData($data)
    {
        $jsonHttpResponse = $this->sendTo($this->getEndpoint() . 'register.do', $data);

        return $this->response = new PurchaseResponse($this, $data, $jsonHttpResponse);
    }
}
