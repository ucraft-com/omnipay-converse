<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * @param \Omnipay\Converse\Message\AbstractRequest $request
     * @param array                                     $data
     */
    public function __construct(AbstractRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return string|null
     */
    public function getPxNumber(): ?string
    {
        if (isset($this->data['content']['pxNumber'])) {
            return $this->data['content']['pxNumber'];
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference(): ?string
    {
        return $this->getPxNumber();
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }

        if (isset($this->data['respmess'])) {
            return $this->data['respmess'];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
