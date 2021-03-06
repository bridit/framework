<?php

namespace Bridit\Framework\Foundation\Log;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class Logger
 * @package Bridit\Framework
 * @method static emergency($message, array $context = array())
 * @method static alert($message, array $context = array())
 * @method static critical($message, array $context = array())
 * @method static error($message, array $context = array())
 * @method static warning($message, array $context = array())
 * @method static notice($message, array $context = array())
 * @method static info($message, array $context = array())
 * @method static debug($message, array $context = array())
 */
class Logger extends AbstractLogger
{

  /**
   * @var LoggerInterface[]
   */
  protected array $loggers;

  public function __construct()
  {
    $this->bootLoggers();
  }

  protected function bootLoggers(): void
  {
    
    $logging = config('logging');
    $default = $logging['default'] ?? 'stack';

    $channels = 'stack' === $default
      ? $logging['channels']['stack']['channels']
      : [$default];

    foreach ($channels as $channel)
    {
      $this->loggers[] = $this->getLoggerInstance($channel, $logging['channels'][$channel] ?? []);
    }

  }

  /**
   * @param string $channel
   * @param array $config
   * @param string $notifyLevel
   * @return LoggerInterface
   * @todo Implement StderrLogger
   */
  protected function getLoggerInstance(string $channel, array $config = [], string $notifyLevel = LogLevel::WARNING): LoggerInterface
  {

//    if ($channel === 'stderr') {
//      return new StderrLogger($notifyLevel);
//    }
    
    if ($config['driver'] === 'bugsnag') {
      $bugsnagLoggerClassName = 'Bugsnag\\PsrLogger\\BugsnagLogger';
      $bugsnagClient = call_user_func_array(['Bugsnag\\Client', 'make'], [$config['key']]);
      $bugsnagLogger = new $bugsnagLoggerClassName($bugsnagClient);
      $bugsnagLogger->setNotifyLevel($notifyLevel);
      
      return $bugsnagLogger;
    }

    if ($config['driver'] === 'custom') {
      $logger = new $config['via'];
      return $logger(array_merge(['level' => LogLevel::WARNING], $config));
    }

  }

  public function log($level, $message, array $context = [])
  {
    
    foreach ($this->loggers as $logger)
    {
      $logger->{$level}($message, $context);
    }
    
  }

}
