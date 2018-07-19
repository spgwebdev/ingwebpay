<?php

namespace Omnipay\IngWebPay;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(array(
            'amount' => '12.00',
            'orderNumber' => '0001'
        ));

        $this->assertInstanceOf('\Omnipay\IngWebPay\Message\PurchaseRequest', $request);
        $this->assertSame('1200', $request->getAmount());
        $this->assertSame('0001', $request->getOrderNumber());
    }

    public function testPrePurchase()
    {
        $request = $this->gateway->prePurchase(array(
            'amount' => '12.00',
            'orderNumber' => '0001'
        ));

        $this->assertInstanceOf('\Omnipay\IngWebPay\Message\PrePurchaseRequest', $request);
        $this->assertSame('1200', $request->getAmount());
        $this->assertSame('0001', $request->getOrderNumber());
    }

    public function testPurchaseStatus()
    {
        $request = $this->gateway->purchaseStatus(array(
            'orderId' => '0001'
        ));

        $this->assertInstanceOf('\Omnipay\IngWebPay\Message\PurchaseStatusRequest', $request);
        $this->assertSame('0001', $request->getOrderId());
    }

    public function testReversePurchase()
    {
        $request = $this->gateway->reversePurchase(array(
            'orderId' => '0001'
        ));

        $this->assertInstanceOf('\Omnipay\IngWebPay\Message\ReversePurchaseRequest', $request);
        $this->assertSame('0001', $request->getOrderId());
    }

    public function testDepositPurchase()
    {
        $request = $this->gateway->depositPurchase(array(
            'orderId' => '0001',
            'amount' => '50.111',
            'language' => 'ro',
        ));

        $this->assertInstanceOf('\Omnipay\IngWebPay\Message\DepositPurchaseRequest', $request);
        $this->assertSame('0001', $request->getOrderId());
        $this->assertSame('5012', $request->getAmount()); //50.12 must be
        $this->assertSame('ro', $request->getLanguage());
    }
}
