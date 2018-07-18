<?php

namespace Omnipay\IngWebPay\Message;

/**
 * IngWebPay Pre Purchase Request
 */
class PrePurchaseRequest extends PurchaseRequest
{

    public function sendData($data)
    {
        $jsonHttpResponse =  $this->sendTo($this->getEndpoint().'registerPreAuth.do',$data);

        return $this->response = new PurchaseResponse($this, $data, $jsonHttpResponse);
    }
}
