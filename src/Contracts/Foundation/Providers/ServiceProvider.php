<?php

namespace Bridit\Framework\Contracts\Foundation\Bootstrappers;

use DI\Container;

interface ServiceProvider
{

  public static function load(Container $container);

}