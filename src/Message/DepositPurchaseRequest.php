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
class DepositPurchaseRequest extends CommonRequest
{

    /**
     *
     * @return array
     */
    public function getData(): array
    {
        $this->validate('orderId');

        $data = [];

        $data['orderID'] = $this->getOrderId();
        $data['userName'] = $this->getUserName();
        $data['password'] = $this->getPassword();
        $data['amount'] = $this->getAmount();
        $data['language'] = $this->getLanguage();

        return $data;
    }

    /**
     *
     * @param array $data
     * @return type
     */
    public function sendData($data)
    {

        $jsonHttpResponse = $this->sendTo($this->getEndpoint() . 'deposit.do', $data);

        return $this->response = new NoRedirectResponse($this, $data, $jsonHttpResponse);
    }
}
