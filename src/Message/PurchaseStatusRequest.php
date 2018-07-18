<?php

namespace Omnipay\IngWebPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * IngWebPay Complete Purchase Request
 *
 * We use the same return URL & class to handle both PDT (Payment Data Transfer)
 * and ITN (Instant Transaction Notification).
 */
class PurchaseStatusRequest extends PurchaseRequest
{
    public function getData()
    {
        $this->validate('orderId');

        $data = array();

        $data['orderId'] = $this->getOrderId();        
        $data['userName'] = $this->getUserName();
        $data['password'] = $this->getPassword();
        $data['language'] = $this->getLanguage();
        $data['extended'] = $this->getExtended();

        return $data;
    }

    public function sendData($data)
    {
        $jsonHttpResponse = $this->sendTo($this->getEndpoint().(isset($data['extended']) && $data['extended'] ? 'getOrderStatusExtended.do' : 'getOrderStatus.do'), $data);


        return $this->response = new NoRedirectResponse($this, $data, $jsonHttpResponse);
        
    }

    public function getExtended()
    {
        return $this->getParameter('extended');
    } 

    public function setExtended($value)
    {
        return $this->setParameter('extended',$value);
    }
}
