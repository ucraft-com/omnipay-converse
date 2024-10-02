<?php

declare(strict_types=1);

namespace Tests\Message;

use Omnipay\Converse\Message\PayWebXRequest;
use Omnipay\Tests\TestCase;

class PayWebXRequestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->request = new PayWebXRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'transactionId' => 'some-transaction-id',
            "clientId"      => 'some-client-id',
            "cardId"        => 'some-card-id',
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
        $this->assertEquals('some-client-id', $data['client_id']);
        $this->assertEquals('some-card-id', $data['cardId']);
    }
}
