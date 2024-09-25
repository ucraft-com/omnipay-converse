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
        return self::API_URL.'/ecommerce.php?c=register';
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
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'returnUrl', 'currency', 'orderNumber');

        return [
            'amount'      => $this->getAmount(),
            'returnUrl'   => $this->getReturnUrl(),
            'currency'    => $this->getCurrency(),
            'orderNumber' => $this->getOrderNumber(),
        ];
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
            $responseData = trim($response->getBody()->getContents(), '"');

            if (!empty($responseData)) {
                $data = json_decode($responseData, true);
            }
        }

        return new PurchaseResponse($this, $data);
    }
}
