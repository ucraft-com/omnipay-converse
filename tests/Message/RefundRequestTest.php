<?php

declare(strict_types=1);

namespace Tests\Message;

use Omnipay\Converse\Message\RefundRequest;
use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'transactionId' => 'some-transaction-id',
            'amount'        => '10',
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
        $this->assertEquals('some-transaction-id', $data['pxNumber']);
        $this->assertEquals('10.00', $data['amount']);
    }
}
