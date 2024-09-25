<?php

declare(strict_types=1);

namespace Omnipay\Converse\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class PayWebXResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @param \Omnipay\Converse\Message\PayWebXRequest $request
     * @param array                                    $data
     */
    public function __construct(PayWebXRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        if (!empty($this->data['formUrl'])) {
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

        return $this->data['formUrl'];
    }
}
