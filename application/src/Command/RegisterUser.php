<?php
namespace OnCallManager\Command;

class RegisterUser implements CommandInterface
{
    private $emailAddress;

    private $password;

    /**
     * RegisterUser constructor.
     * @param $emailAddress
     * @param $password
     */
    public function __construct($emailAddress, $password)
    {
        $this->emailAddress = $emailAddress;
        $this->password     = $password;
    }

    public function email()
    {
        return $this->emailAddress;
    }

    public function password()
    {
        return $this->password;
    }

    public function name(): string
    {
        // TODO: Implement name() method.
    }
}