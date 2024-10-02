<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class BindingPaymentRequest extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return self::API_URL.'/api/Payment/PayWithBinding';
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Converse\Message\BindingPaymentRequest
     */
    public function setCardBinding(string $value): BindingPaymentRequest
    {
        return $this->setParameter('cardBinding', $value);
    }

    /**
     * @return string
     */
    public function getCardBinding(): string
    {
        return $this->getParameter('cardBinding');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Converse\Message\BindingPaymentRequest
     */
    public function setOrderNumber(string $value): BindingPaymentRequest
    {
        return $this->setParameter('orderNumber', $value);
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->getParameter('orderNumber');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Converse\Message\BindingPaymentRequest
     */
    public function setLanguage($value): BindingPaymentRequest
    {
        return $this->setParameter('language', $value);
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->getParameter('language');
    }

    /**
     * @param bool $value
     *
     * @return \Omnipay\Converse\Message\BindingPaymentRequest
     */
    public function setSaveCard(bool $value): BindingPaymentRequest
    {
        return $this->setParameter('saveCard', $value);
    }

    /**
     * @return bool
     */
    public function getSaveCard(): bool
    {
        return (bool)$this->getParameter('saveCard');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Converse\Message\BindingPaymentRequest
     */
    public function setClientId(string $value): BindingPaymentRequest
    {
        return $this->setParameter('clientId', $value);
    }

    /**
     * @return string|null
     */
    public function getClientId(): ?string
    {
        return $this->getParameter('clientId');
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'language', 'currency', 'returnUrl', 'clientId', 'orderNumber');

        return array_filter([
            'card_binding' => $this->getCardBinding(),
            'amount'      => $this->getAmount(),
            'lang'        => $this->getLanguage(),
            'returnUrl'   => $this->getReturnUrl(),
            'currency'    => $this->getCurrency(),
            'orderNumber' => $this->getOrderNumber(),
            'client_id'   => $this->getClientId(),
            'description' => $this->getDescription(),
            'save_card'   => $this->getSaveCard(),
        ]);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Omnipay\Converse\Message\BindingPaymentResponse
     */
    protected function createResponse(ResponseInterface $response): BindingPaymentResponse
    {
        $data = [];

        if ($response->getStatusCode() === Response::HTTP_CREATED) {
            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            if (json_last_error() === JSON_ERROR_NONE && $responseData !== null) {
                $data = $responseData;
            }
        }

        return new BindingPaymentResponse($this, $data);
    }
}
