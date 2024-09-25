<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RegisterCardRequest extends AbstractRequest
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
     * @return \Omnipay\Converse\Message\RegisterCardRequest
     */
    public function setBindingId(string $value): RegisterCardRequest
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
     * @param string $value
     *
     * @return \Omnipay\Converse\Message\RegisterCardRequest
     */
    public function setOrderNumber(string $value): RegisterCardRequest
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
        $this->validate('amount', 'returnUrl', 'currency', 'orderNumber', 'bindingId');

        return [
            'amount'      => $this->getAmount(),
            'returnUrl'   => $this->getReturnUrl(),
            'currency'    => $this->getCurrency(),
            'orderNumber' => $this->getOrderNumber(),
            'client_id'   => $this->getBindingId(),
            'description' => $this->getDescription(),
            'save_card'   => true,
        ];
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Omnipay\Converse\Message\RegisterCardResponse
     */
    protected function createResponse(ResponseInterface $response): RegisterCardResponse
    {
        $data = [];

        if ($response->getStatusCode() === Response::HTTP_OK) {
            $responseData = trim($response->getBody()->getContents(), '"');

            if (!empty($responseData)) {
                $data = json_decode($responseData, true);
            }
        }

        return new RegisterCardResponse($this, $data);
    }
}
