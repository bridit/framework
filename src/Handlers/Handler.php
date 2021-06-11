<?php declare(strict_types=1);

namespace Bridit\Framework\Handlers;

use Bridit\Framework\Foundation\Application;

class Handler extends Application
{

  protected $context;
  
  public function handle($event = null, $context = null)
  {
    $this->context = $context;

    $this->start();
  }

}
