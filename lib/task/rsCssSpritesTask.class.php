<?php
/**
 * a simple task to generate css sprites for you
 *
 * @package     rsCssSpritesPlugin
 * @subpackage  lib/task
 * @author      Robert Schönthal caziel[at]gmx[dot]net
 *
 * call it with "symfony generate:sprites"
 * first it should do nothing.
 * see "http://csssprites.org/#usage" how to prepare your stylesheets
 */
class spritesTask extends sfBaseTask
{
  protected function configure()
  {

    $this->namespace        = 'generate';
    $this->name             = 'sprites';
    $this->briefDescription = 'generate css sprites';
    $this->aliases          = array("generate-sprites");
    $this->detailedDescription = <<<EOF
The [sprites|INFO] task generates css sprites for you.
Call it with:

  [php symfony sprites|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $params[] = "--root-dir-path ".sfConfig::get("sf_web_dir")."/css";
    $params[] = "--sprite-png-ie6";
    $params[] = "--document-root-dir-path ".sfConfig::get("sf_web_dir");

    $script = "cd ".dirname(__FILE__)."/../vendor/smartsprites/ && ./smartsprites.sh";

    $command = $script." ".join(" ", $params);

    $this->log($this->getFilesystem()->execute($command));
  }
}
