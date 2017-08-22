<?php
namespace App\CommandBus;

interface CommandBusInterface
{
    public function handle(CommandInterface $command);
}
