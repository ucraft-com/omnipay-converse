<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class FetchTransactionRequest extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return self::API_URL.'/HostX/CheckStatus';
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionId');

        return [
            'pxNumber' => $this->getTransactionId(),
        ];
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Omnipay\Converse\Message\FetchTransactionResponse
     */
    protected function createResponse(ResponseInterface $response): FetchTransactionResponse
    {
        $data = [];

        if ($response->getStatusCode() === Response::HTTP_OK) {
            $responseData = trim($response->getBody()->getContents(), '"');

            if (!empty($responseData)) {
                $data = json_decode($responseData, true);
            }
        }

        return new FetchTransactionResponse($this, $data);
    }
}
