<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class PayWebXRequest extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return self::API_URL.'/api/Payment/PayWebX';
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Converse\Message\PayWebXRequest
     */
    public function setClientId(string $value): PayWebXRequest
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
     *
     * @param string $value
     *
     * @return $this
     */
    public function setCardId(string $value): PayWebXRequest
    {
        return $this->setParameter('cardId', $value);
    }

    /**
     * @return string
     */
    public function getCardId(): string
    {
        return $this->getParameter('cardId');
    }

    /**
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setIsBind(bool $value): PayWebXRequest
    {
        return $this->setParameter('IsBind', $value);
    }

    /**
     * @return bool|null
     */
    public function getIsBind(): ?bool
    {
        return $this->getParameter('IsBind');
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionId', 'clientId', 'cardId');

        return array_filter([
            'pxNumber'  => $this->getTransactionId(),
            'client_id' => $this->getClientId(),
            'cardId'    => $this->getCardId(),
            'IsBind'    => $this->getIsBind(),
        ]);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Omnipay\Converse\Message\PayWebXResponse
     */
    protected function createResponse(ResponseInterface $response): PayWebXResponse
    {
        $data = [];

        if ($response->getStatusCode() === Response::HTTP_OK) {
            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            if (json_last_error() === JSON_ERROR_NONE && $responseData !== null) {
                $data = $responseData;
            }
        }

        return new PayWebXResponse($this, $data);
    }
}
