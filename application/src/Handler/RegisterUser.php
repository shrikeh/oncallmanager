<?php

use RegisterUser as RegisterUserCommand;

/**
 * Class RegisterUserHandler
 */
class RegisterUserHandler
{
    private $userService;

    /**
     * RegisterUser constructor.
     * @param $userService
     */
    public function __construct($userService)
    {
        $this->userService = $userService;
    }


    public function handle(RegisterUserCommand $command)
    {
        $this->userService->register(
            $command->email(),
            $command->password()
        );
    }
}