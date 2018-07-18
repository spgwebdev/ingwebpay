<?php

namespace Omnipay\IngWebPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * IngWebPay Complete Purchase Request
 *
 * We use the same return URL & class to handle both PDT (Payment Data Transfer)
 * and ITN (Instant Transaction Notification).
 */
class ReversePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        $this->validate('orderId');

        $data = array();

        $data['orderId'] = $this->getOrderId();        
        $data['userName'] = $this->getUserName();
        $data['password'] = $this->getPassword();
        $data['language'] = $this->getLanguage();

        return $data;
    }

    public function sendData($data)
    {

        $jsonHttpResponse = $this->sendTo($this->getEndpoint().'reverse.do', $data);

        return $this->response = new NoRedirectResponse($this, $data, $jsonHttpResponse);
        
    }
}
