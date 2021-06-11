<?php

declare(strict_types=1);

namespace Bridit\Framework\Foundation\Log\Eloquent\Loggers;

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Bridit\Framework\Foundation\Log\Eloquent\Handler\EloquentHandler;
use Bridit\Framework\Foundation\Log\Eloquent\Processor\ContextProcessor;
use Bridit\Framework\Foundation\Log\Eloquent\Processor\RequestProcessor;

class EloquentLogger
{

  public function __invoke(array $config): LoggerInterface
  {

    $logger = new Logger('eloquent');
    $logger->pushHandler(new EloquentHandler());
    $logger->pushProcessor(new ContextProcessor());
    $logger->pushProcessor(new RequestProcessor());

    return $logger;

  }

}
