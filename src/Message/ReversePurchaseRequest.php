<?php
namespace Omnipay\IngWebPay\Message;

use Omnipay\IngWebPay\Message\CommonRequest;
use Omnipay\IngWebPay\Message\NoRedirectResponse;

/**
 * IngWebPay Complete Purchase Request
 *
 * We use the same return URL & class to handle both PDT (Payment Data Transfer)
 * and ITN (Instant Transaction Notification).
 */
class ReversePurchaseRequest extends CommonRequest
{

    /**
     *
     * @return array
     */
    public function getData(): array
    {
        $this->validate('orderId');

        $data = array();

        $data['orderID'] = $this->getOrderId();
        $data['userName'] = $this->getUserName();
        $data['password'] = $this->getPassword();

        return $data;
    }

    /**
     *
     * @param array $data
     * @return type
     */
    public function sendData($data)
    {

        $jsonHttpResponse = $this->sendTo($this->getEndpoint() . 'reverse.do', $data);

        return $this->response = new NoRedirectResponse($this, $data, $jsonHttpResponse);
    }
}
