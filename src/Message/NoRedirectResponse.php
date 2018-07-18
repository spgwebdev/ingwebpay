<?php

namespace Omnipay\IngWebPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * IngWebPay Complete Purchase PDT Response
 */
class NoRedirectResponse extends PurchaseResponse
{

    public function isRedirect()
    {
        return false;
    }
}
