<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @param \Omnipay\Converse\Message\PurchaseRequest $request
     * @param array                                     $data
     */
    public function __construct(PurchaseRequest $request, array $data)
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
    public function isRedirect(): bool
    {
        return isset($this->data['content']['formUrl']);
    }

    /**
     * @return string
     */
    public function getRedirectMethod(): string
    {
        return 'GET';
    }

    /**
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        if (isset($this->data['content']['formUrl'])) {
            return $this->data['content']['formUrl'];
        }

        return null;
    }
}
