<?php
namespace Omnipay\IngWebPay\Message;

use Omnipay\IngWebPay\Message\PurchaseRequest;

/**
 * IngWebPay Pre Purchase Request
 */
class PrePurchaseRequest extends PurchaseRequest
{

    /**
     *
     * @param array $data
     * @return type
     */
    public function sendData($data)
    {
        $jsonHttpResponse = $this->sendTo($this->getEndpoint() . 'registerPreAuth.do', $data);

        return $this->response = new PurchaseResponse($this, $data, $jsonHttpResponse);
    }
}
