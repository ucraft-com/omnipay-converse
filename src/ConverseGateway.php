<?php

declare(strict_types=1);

namespace Omnipay\Converse;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Converse\Message\BindingPaymentRequest;
use Omnipay\Converse\Message\FetchTransactionRequest;
use Omnipay\Converse\Message\PayWebXRequest;
use Omnipay\Converse\Message\PurchaseRequest;
use Omnipay\Converse\Message\RefundRequest;
use Omnipay\Converse\Message\RegisterCardRequest;
use Omnipay\Converse\Message\ReverseRequest;

/**
 * Converse gateway.
 *
 * @package Omnipay\Converse
 */
class ConverseGateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Converse';
    }

    /**
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'merchantId'    => null,
            'merchantToken' => null,
            'testMode'      => false, // Converse does not yet support test mode.
        ];
    }

    /**
     * @return string|null
     */
    public function getMerchantId(): ?string
    {
        return $this->getParameter('merchantId');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Converse\ConverseGateway
     */
    public function setMerchantId(string $value): ConverseGateway
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * @return string|null
     */
    public function getMerchantToken(): ?string
    {
        return $this->getParameter('merchantToken');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Converse\ConverseGateway
     */
    public function setMerchantToken(string $value): ConverseGateway
    {
        return $this->setParameter('merchantToken', $value);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function bindingPayment(array $options = []): AbstractRequest
    {
        return $this->createRequest(BindingPaymentRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchTransaction(array $options = []): AbstractRequest
    {
        return $this->createRequest(FetchTransactionRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function payWebX(array $options = []): AbstractRequest
    {
        return $this->createRequest(PayWebXRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $options = []): AbstractRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function refund(array $options = []): AbstractRequest
    {
        return $this->createRequest(RefundRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function registerCard(array $options = []): AbstractRequest
    {
        return $this->createRequest(RegisterCardRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function reverse(array $options = []): AbstractRequest
    {
        return $this->createRequest(ReverseRequest::class, $options);
    }
}
