<?php
namespace Omnipay\IngWebPay\Message;

use Omnipay\IngWebPay\Message\PurchaseResponse;

/**
 * IngWebPay Complete Purchase PDT Response
 */
class NoRedirectResponse extends PurchaseResponse
{

    /**
     *
     * @return bool
     */
    public function isRedirect(): bool
    {
        return false;
    }
}
