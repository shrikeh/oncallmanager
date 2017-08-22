<?php

use Symfony\Component\EventDispatcher\EventDispatcher;
use UpdateUser as UpdateUserCommand;

class RegisterUserHandler
{
    private $dispatcher;

    /**
     * RegisterUser constructor.
     * @param $userService
     */
    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }


    public function handle(UpdateUserCommand $command)
    {
        $event = new UpdateUserRequested($command);

        $this->dispatcher->dispatch($event);
    }
}