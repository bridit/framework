<?php declare(strict_types=1);

namespace Bridit\Framework\Handlers\Console;

use Bridit\Framework\Console\Commands\ProjectPermissionsCommand;
use Bridit\Framework\Foundation\Application;
use Symfony\Component\Console\Application as ConsoleApplication;

class Handler extends Application
{

  protected array $commands = [
    ProjectPermissionsCommand::class,
  ];

  public function handle()
  {
    $console = new ConsoleApplication;

    $commands = array_merge($this->commands, require path('/routes/console.php'));

    foreach ($commands as $command)
    {
      $console->add(new $command);
    }

    $console->run();
  }

}
