<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

class ReverseResponse extends AbstractResponse
{
    /**
     * @param \Omnipay\Converse\Message\ReverseRequest $request
     * @param array                                    $data
     */
    public function __construct(ReverseRequest $request, array $data)
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
