<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class BindingPaymentResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @param \Omnipay\Converse\Message\BindingPaymentRequest $request
     * @param array                                           $data
     */
    public function __construct(BindingPaymentRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        if (isset($this->data['returnUrl']) && !empty($this->data['returnUrl'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isRedirect(): bool
    {
        return $this->isSuccessful();
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
        if (!$this->isSuccessful()) {
            return null;
        }

        return $this->data['returnUrl'];
    }
}
