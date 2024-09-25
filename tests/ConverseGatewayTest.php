<?php

declare(strict_types=1);

namespace Tests;

use Omnipay\Converse\ConverseGateway;
use Omnipay\Converse\Message\BindingPaymentResponse;
use Omnipay\Converse\Message\FetchTransactionResponse;
use Omnipay\Converse\Message\PayWebXResponse;
use Omnipay\Converse\Message\PurchaseResponse;
use Omnipay\Converse\Message\RefundResponse;
use Omnipay\Converse\Message\RegisterCardResponse;
use Omnipay\Converse\Message\ReverseResponse;
use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;

class ConverseGatewayTest extends GatewayTestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = Omnipay::create(ConverseGateway::class);

        $this->gateway->setMerchantId('some-merchant-id');
        $this->gateway->setMerchantToken('some-merchant-gu-id-token');
    }

    /**
     * @return void
     */
    public function testBindingPayment(): void
    {
        $response = $this->gateway->bindingPayment([
                'card_binding' => 'card_binding',
                'amount'       => '10',
                'returnUrl'    => 'http:\/\/cportal.im\/hy\/test?back=1&order_number=1',
                'language'     => 'en',
                'currency'     => 'EUR',
                'orderNumber'  => '000866',
                'bindingID'    => 'some-binding-id',
                'description'  => 'some-description',
        ])->send();

        $this->assertInstanceOf(BindingPaymentResponse::class, $response);
    }

    /**
     * @return void
     */
    public function testFetchTransaction(): void
    {
        $response = $this->gateway->fetchTransaction([
            'transactionId' => 'some-transaction-id',
        ])->send();

        $this->assertInstanceOf(FetchTransactionResponse::class, $response);
    }

    /**
     * @return void
     */
    public function payWebXTest(): void
    {
        $response = $this->gateway->payWebX([
                'transactionId' => 'some-transaction-id',
                "bindingId"     => 'some-binding-id',
                "cardId"        => 'some-card-id',
        ])->send();

        $this->assertInstanceOf(PayWebXResponse::class, $response);
    }

    /**
     * @return void
     */
    public function testPurchase(): void
    {
        $response = $this->gateway->purchase([
            'amount'        => '10',
            'returnUrl'    => 'http:\/\/cportal.im\/hy\/test?back=1&order_number=1',
            'language'     => 'en',
            'currency'     => 'EUR',
            'orderNumber'  => '000866',
        ])->send();

        $this->assertInstanceOf(PurchaseResponse::class, $response);
    }

    /**
     * @return void
     */
    public function testRefund(): void
    {
        $response = $this->gateway->refund([
                'transactionId' => 'some-transaction-id',
                'amount'        => '10',
        ])->send();

        $this->assertInstanceOf(RefundResponse::class, $response);
    }

    /**
     * @return void
     */
    public function testRegisterCard(): void
    {
        $response = $this->gateway->registerCard([
                'transactionId' => 'some-transaction-id',
                'amount'       => '10',
                'returnUrl'    => 'http:\/\/cportal.im\/hy\/test?back=1&order_number=1',
                'language'     => 'en',
                'currency'     => 'EUR',
                'orderNumber'  => '000866',
                'bindingID'    => 'some-binding-id',
                'description'  => 'some-description',
        ])->send();

        $this->assertInstanceOf(RegisterCardResponse::class, $response);
    }

    public function testReverse(): void
    {
        $response = $this->gateway->reverse([
                'transactionId' => 'some-transaction-id',
        ])->send();

        $this->assertInstanceOf(ReverseResponse::class, $response);
    }
}
