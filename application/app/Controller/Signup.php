<?php
namespace App\Controller;

use App\CommandBus\CommandBusException;
use App\CommandBus\CommandBusInterface;
use App\RequestCommandMapper\RequestCommandMapperInterface;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Signup
{
    private $requestCommandMapper;

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    public function __construct(
        RequestCommandMapperInterface $requestCommandMapper,
        CommandBusInterface $commandBus
    ) {
        $this->requestCommandMapper = $requestCommandMapper;
        $this->commandBus           = $commandBus;
    }

    public function create(RequestInterface $request)
    {
        $command = $this->requestCommandMapper($request);
        $this->commandBus->handle($command);
    }
}