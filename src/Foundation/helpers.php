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
    return strtr($value, ['??'=>'S', '??'=>'s', '??'=>'Z', '??'=>'z', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'C', '??'=>'E', '??'=>'E',
      '??'=>'E', '??'=>'E', '??'=>'I', '??'=>'I', '??'=>'I', '??'=>'I', '??'=>'N', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'U',
      '??'=>'U', '??'=>'U', '??'=>'U', '??'=>'Y', '??'=>'B', '??'=>'Ss', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'c',
      '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'o', '??'=>'n', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o',
      '??'=>'o', '??'=>'o', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'y', '??'=>'b', '??'=>'y']);
  }

}
