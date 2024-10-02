<?php

declare(strict_types=1);

namespace Tests\Message;

use Omnipay\Converse\Message\BindingPaymentRequest;
use Omnipay\Tests\TestCase;

class BindingPaymentRequestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->request = new BindingPaymentRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'card_binding' => 'card_binding',
            'amount'       => '10',
            'language'     => 'en',
            'returnUrl'    => 'http:\/\/cportal.im\/hy\/test?back=1&order_number=1',
            'currency'     => 'EUR',
            'orderNumber'  => '000866',
            'clientId'     => 'some-client-id',
            'description'  => 'some-description',
        ]);
    }

    /**
     * @return void
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testGetData(): void
    {
        $data = $this->request->getData();

        $this->assertIsArray($data);
        $this->assertEquals('card_binding', $data['card_binding']);
        $this->assertEquals('10.00', $data['amount']);
        $this->assertEquals('en', $data['lang']);
        $this->assertEquals('http:\/\/cportal.im\/hy\/test?back=1&order_number=1', $data['returnUrl']);
        $this->assertEquals('EUR', $data['currency']);
        $this->assertEquals('000866', $data['orderNumber']);
        $this->assertEquals('some-client-id', $data['client_id']);
        $this->assertEquals('some-description', $data['description']);
    }
}
