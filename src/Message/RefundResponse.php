<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

class RefundResponse extends AbstractResponse
{
    /**
     * @param \Omnipay\Converse\Message\RefundRequest $request
     * @param array                                   $data
     */
    public function __construct(RefundRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        if (isset($this->data['success']) && $this->data['success'] === 1) {
            return true;
        }

        return false;
    }
}
