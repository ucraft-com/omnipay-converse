<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Omnipay\Converse\Enums\TransactionStatus;

class FetchTransactionResponse extends AbstractResponse
{
    /**
     * @param \Omnipay\Converse\Message\FetchTransactionRequest $request
     * @param array                                             $data
     */
    public function __construct(FetchTransactionRequest $request, array $data)
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

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->getStatus() === TransactionStatus::PAID;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->getStatus() === TransactionStatus::FAILED;
    }

    /**
     * @return bool
     */
    public function isCanceled(): bool
    {
        return $this->getStatus() === TransactionStatus::CANCELED;
    }

    /**
     * @return bool
     */
    public function isRefund(): bool
    {
        return $this->getStatus() === TransactionStatus::REFUND;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        if (isset($this->data['content']['status'])) {
            return $this->data['content']['status'];
        }

        return null;
    }
}
