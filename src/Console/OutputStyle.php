<?php

namespace Bridit\Framework\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class OutputStyle
 * @package Bridit\Framework\Console
 * @see https://github.com/illuminate/console
 */
class OutputStyle extends SymfonyStyle
{
  /**
   * The output instance.
   *
   * @var OutputInterface
   */
  private OutputInterface $output;

  /**
   * Create a new Console OutputStyle instance.
   *
   * @param InputInterface $input
   * @param OutputInterface $output
   * @return void
   */
  public function __construct(InputInterface $input, OutputInterface $output)
  {
    $this->output = $output;

    parent::__construct($input, $output);
  }

  /**
   * Returns whether verbosity is quiet (-q).
   *
   * @return bool
   */
  public function isQuiet(): bool
  {
    return $this->output->isQuiet();
  }

  /**
   * Returns whether verbosity is verbose (-v).
   *
   * @return bool
   */
  public function isVerbose(): bool
  {
    return $this->output->isVerbose();
  }

  /**
   * Returns whether verbosity is very verbose (-vv).
   *
   * @return bool
   */
  public function isVeryVerbose(): bool
  {
    return $this->output->isVeryVerbose();
  }

  /**
   * Returns whether verbosity is debug (-vvv).
   *
   * @return bool
   */
  public function isDebug(): bool
  {
    return $this->output->isDebug();
  }

}
