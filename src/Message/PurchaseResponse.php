<?php
namespace Omnipay\IngWebPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * IngWebPay Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     *
     * @var string
     */
    protected $redirectUrl;

    /**
     *
     * @var type
     */
    protected $dataResponse;

    /**
     *
     * @param RequestInterface $request
     * @param array $data
     * @param type $dataResponse
     */
    public function __construct(RequestInterface $request, array $data, $dataResponse)
    {
        parent::__construct($request, $data);
        $this->dataResponse = $dataResponse;
    }

    /**
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return !isset($this->dataResponse->errorCode) ?: $this->dataResponse->errorCode == 0 ;
    }

    /**
     *
     * @return bool
     */
    public function isRedirect(): bool
    {
        return true;
    }

    /**
     *
     * @return string
     */
    public function getRedirectUrl(): string
    {
        if (!isset($this->dataResponse->formUrl)) {
            throw new \Exception('No formUrl found, check request for errors ');
        }
        return $this->dataResponse->formUrl;
    }

    /**
     *
     * @return string
     */
    public function getRedirectMethod(): string
    {
        return 'GET';
    }

    /**
     *
     * @return array
     */
    public function getRedirectData(): array
    {
        return $this->getData();
    }

    /**
     *
     * @return array
     */
    public function response()
    {
        return $this->dataResponse;
    }

    /**
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->dataResponse->errorMessage;
    }
}
