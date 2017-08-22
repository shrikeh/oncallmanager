<?php
namespace App\Controller;

use App\CommandBus\CommandBusException;
use App\CommandBus\CommandBusInterface;
use App\RequestCommandMapper\RequestCommandMapperInterface;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Main
 * @package App\Controller
 */
class Main
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

    public function register(RequestInterface $request)
    {
        try {
            $this->commandBus->handle(new \RegisterUser(
                $request->email,
                $request->password
            ));
        } catch (CommandBusException $e) {
            throw new HttpException($e->getMessage(), 500);
        }

    }
}
