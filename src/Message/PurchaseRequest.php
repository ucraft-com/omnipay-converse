<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return self::API_URL.'/HostX/Register';
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Converse\Message\PurchaseRequest
     */
    public function setOrderNumber(string $value): PurchaseRequest
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
     * @param string $value
     *
     * @return \Omnipay\Converse\Message\PurchaseRequest
     */
    public function setLanguage(string $value): PurchaseRequest
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
     * @return \Omnipay\Converse\Message\PurchaseRequest
     */
    public function setSaveCard(bool $value): PurchaseRequest
    {
        return $this->setParameter('saveCard', $value);
    }

    /**
     * @return bool|null
     */
    public function getSaveCard(): ?bool
    {
        return (bool)$this->getParameter('saveCard');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Converse\Message\PurchaseRequest
     */
    public function setClientId(string $value): PurchaseRequest
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
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'language', 'returnUrl', 'currency', 'orderNumber');

        return array_filter([
            'amount'      => $this->getAmount(),
            'lang'        => $this->getLanguage(),
            'returnUrl'   => $this->getReturnUrl(),
            'currency'    => $this->getCurrency(),
            'orderNumber' => $this->getOrderNumber(),
            'description' => $this->getDescription(),
            'client_id'   => $this->getClientId(),
            'save_card'   => $this->getSaveCard(),
        ]);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Omnipay\Converse\Message\PurchaseResponse
     */
    protected function createResponse(ResponseInterface $response): PurchaseResponse
    {
        $data = [];

        if ($response->getStatusCode() === Response::HTTP_OK) {
            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            if (json_last_error() === JSON_ERROR_NONE && $responseData !== null) {
                $data = $responseData;
            }
        }

        return new PurchaseResponse($this, $data);
    }
}
