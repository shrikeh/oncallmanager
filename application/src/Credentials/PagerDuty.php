<?php
namespace OnCallManager\Credentials;

/**
 * Class PagerDuty
 * @package OnCallManager\Credentials
 */
final class PagerDuty
{
    /**
     * @var string
     */
    private $token;

    /**
     * PagerDuty constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->token();
    }

    /**
     * @return string
     */
    public function token()
    {
        return $this->token;
    }
}