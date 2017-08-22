<?php
namespace App\RequestCommandMapper;

use Agent42\Command\CommandInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Interface RequestCommandMapperInterface
 * @package App\RequestCommandMapper
 */
interface RequestCommandMapperInterface
{
    public function process(RequestInterface $request): CommandInterface;
}