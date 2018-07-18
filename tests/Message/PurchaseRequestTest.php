<?php

namespace Omnipay\IngWebPay\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $this->request->setAmount('12.00')->setDescription('Test Product');

        $response = $this->request->send();

        $this->assertInstanceOf('Omnipay\IngWebPay\Message\PurchaseResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
    }
}
