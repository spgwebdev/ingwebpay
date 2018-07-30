<?php
namespace Omnipay\IngWebPay\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 *
 */
abstract class CommonRequest extends AbstractRequest
{

    /**
     * @array
     */
    const CURRENCY_CODES = [
        self::CURRENCY_RON, //RON
        self::CURRENCY_EURO //EUR
    ];

    /**
     * @int
     */
    const CURRENCY_RON = 946;

    /**
     * @int
     */
    const CURRENCY_EURO = 978;

    /**
     * @array
     */
    const LANG = [
        'ro',
        'en'
    ];

    /**
     *
     * @var string
     */
    protected $liveEndpoint = 'https://securepay.ing.ro/mpi/rest/';

    /**
     *
     * @var string
     */
    protected $testEndpoint = 'https://securepay-uat.ing.ro/mpi_uat/rest/';

    /**
     *
     * @param string $url
     * @param array $data
     * @return type
     */
    public function sendTo(string $url, array $data)
    {
        $headers = array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        );
        $body = $data ? http_build_query($data, '', '&') : null;
        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $url, $headers, $body);
        return json_decode($httpResponse->getBody()->getContents());
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     *
     * @return string
     */
    public function getUserName(): string
    {
        return $this->getParameter('userName');
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setUserName(string $value)
    {
        return $this->setParameter('userName', $value);
    }

    /**
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getParameter('password');
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setPassword(string $value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     *
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->getParameter('orderNumber');
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setOrderNumber(string $value)
    {
        return $this->setParameter('orderNumber', $value);
    }

    /**
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->getParameter('orderId');
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setOrderId(string $value)
    {
        return $this->setParameter('orderId', $value);
    }

    /**
     *
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->getParameter('return_url');
    }

    /**
     *
     * @return string
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('return_url', $value);
    }

    /**
     *
     * @return string
     */
    public function getCurrency(): int
    {
        $value = $this->getParameter('currency');
        if (!in_array($value, self::CURRENCY_CODES)) {
            $value = self::CURRENCY_RON;
        }
        return $value;
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    /**
     *
     * @return string
     */
    public function getLanguage(): string
    {
        $value = $this->getParameter('language');
        if (!in_array($value, self::LANG)) {
            $value = 'ro';
        }
        return $value;
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setLanguage(string $value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     *
     * @return int
     */
    public function getAmount(): int
    {
        return (int) round(ceil($this->getParameter('amount') * 100)); //in cents
    }

    /**
     *
     * @param float $value
     * @return type
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    /**
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getParameter('email') ?: '';
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setEmail(string $value)
    {
        return $this->setParameter('email', $value);
    }

    public function getDescription(): string
    {
        return $this->getParameter('description') ?: '';
    }

    /**
     *
     * @param string $value
     * @return type
     */
    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    /**
     *
     * @return type
     */
    public function getExtended()
    {
        return $this->getParameter('extended');
    }

    /**
     *
     * @param type $value
     * @return type
     */
    public function setExtended($value)
    {
        return $this->setParameter('extended', $value);
    }
}
