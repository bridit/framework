<?php

if (! function_exists('path')) {
  /**
   * Get the path to the base of the install.
   *
   * @param  string  $path
   * @return string
   */
  function path(string $path = ''): string
  {
    return __BASE_PATH__ . \Illuminate\Support\Str::start($path, '/');
  }
}

if (! function_exists('storage_path')) {
  /**
   * Get the path to the storage of the install.
   *
   * @param  string  $path
   * @return string
   */
  function storage_path(string $path = ''): string
  {
    $storagePath = \Illuminate\Support\Str::finish(env('APP_STORAGE') ?? path(), 'storage');

    return $storagePath . \Illuminate\Support\Str::start($path, '/');
  }
}

if (! function_exists('app')) {
  /**
   * Get the available application instance.
   *
   * @param  string|null  $abstract
   * @param  array  $parameters
   * @return mixed|\Bridit\Framework\Foundation\Application
   */
  function app($abstract = null, array $parameters = [])
  {
    if (is_null($abstract)) {
      return \Bridit\Framework\Foundation\Application::getInstance();
    }

    return \Bridit\Framework\Foundation\Application::getInstance()->make($abstract, $parameters);
  }
}

if (! function_exists('config')) {
  /**
   * @param string $key
   * @param mixed|null $default
   * @return mixed
   */
  function config(string $key, mixed $default = null): mixed
  {
    $parts = explode('.', $key);

    $first = array_shift($parts);

    $config = app()->get($first) ?? [];

    return !blank($parts)
      ? \Illuminate\Support\Arr::get($config, implode('.', $parts), $default)
      : $config;
  }
}

if (! function_exists('request')) {
  /**
   * @param string|array|null $key
   * @param mixed|null $default
   * @return mixed
   */
  function request(string|array $key = null, mixed $default = null): mixed
  {
    $request = app()->get('request');

    if (is_null($key)) {
      return $request;
    }

    if (is_array($key)) {
      return $request->only($key);
    }

    return $request->get($key, $default);
  }
}

if (! function_exists('response')) {
  /**
   * @param string $content
   * @param int $status
   * @param array $headers
   * @return \Bridit\Framework\Http\Response
   */
  function response(string $content = '', int $status = 200, array $headers = []): \Bridit\Framework\Http\Response
  {
    return new \Bridit\Framework\Http\Response($status, $headers, $content);
  }
}

if (!function_exists('unaccent')) {

  function unaccent(string $value): string
  {
    return strtr($value, ['Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
      'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
      'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
      'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
      'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y']);
  }

}
