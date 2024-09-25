<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RefundRequest extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return self::API_URL.'/pos_api/refund';
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionId', 'amount');

        return [
            'pxNumber' => $this->getTransactionId(),
            'amount'   => $this->getAmount(),
        ];
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Omnipay\Converse\Message\RefundResponse
     */
    protected function createResponse(ResponseInterface $response): RefundResponse
    {
        $data = [];

        if ($response->getStatusCode() === Response::HTTP_OK) {
            $responseData = trim($response->getBody()->getContents(), '"');

            if (!empty($responseData)) {
                $data = json_decode($responseData, true);
            }
        }

        return new RefundResponse($this, $data);
    }
}
