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
    public function setBindingId(string $value): BindingPaymentRequest
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
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'currency', 'returnUrl', 'bindingId', 'orderNumber');

        return [
            'card_binding' => $this->getCardBinding(),
            'amount'       => $this->getAmount(),
            'returnUrl'    => $this->getReturnUrl(),
            'currency'     => $this->getCurrency(),
            'orderNumber'  => $this->getOrderNumber(),
            'client_id'    => $this->getBindingId(),
            'description'  => $this->getDescription(),
            'save_card'    => true,
        ];
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
            $responseData = trim($response->getBody()->getContents(), '"');

            if (!empty($responseData)) {
                $data = json_decode($responseData, true);
            }
        }

        return new BindingPaymentResponse($this, $data);
    }
}
