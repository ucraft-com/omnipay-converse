<?php

declare(strict_types=1);

namespace Tests\Message;

use Omnipay\Converse\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'amount'        => '10',
            'returnUrl'    => 'http:\/\/cportal.im\/hy\/test?back=1&order_number=1',
            'currency'     => 'EUR',
            'orderNumber'  => '000866',
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
        $this->assertEquals('10.00', $data['amount']);
        $this->assertEquals('http:\/\/cportal.im\/hy\/test?back=1&order_number=1', $data['returnUrl']);
        $this->assertEquals('EUR', $data['currency']);
        $this->assertEquals('000866', $data['orderNumber']);
    }
}
