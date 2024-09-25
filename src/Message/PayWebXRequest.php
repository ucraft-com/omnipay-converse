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
    public function setBindingId(string $value): PayWebXRequest
    {
        return $this->setParameter('bindingId', $value);
    }

    /**
     * @return string
     */
    public function getBindingId(): string
    {
        return $this->getParameter('bindingId');
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
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionId', 'bindingId', 'cardId');

        return [
            'pxNumber'  => $this->getTransactionId(),
            'client_id' => $this->getBindingId(),
            'cardId'    => $this->getCardId(),
            'IsBind'    => true,
        ];
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
            $responseData = trim($response->getBody()->getContents(), '"');

            if (!empty($responseData)) {
                $data = json_decode($responseData, true);
            }
        }

        return new PayWebXResponse($this, $data);
    }
}
