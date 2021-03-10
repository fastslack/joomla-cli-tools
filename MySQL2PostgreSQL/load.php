#!/usr/bin/php
<?php
/**
 * Joomla CLI Tools
 *
 * @version $Id:
 * @package joomla-cli-tools
 * @copyright Copyright (C) 2004 - 2017 Matware. All rights reserved.
 * @author Matias Aguirre
 * @email maguirre@matware.com.ar
 * @link http://www.matware.com.ar/
 * @license GNU General Public License version 2 or later; see LICENSE
 */

// We are a valid Joomla entry point.
define('_JEXEC', 1);

// Max out error reporting for testing. Remove in production.
error_reporting(-1);
ini_set('display_errors', 1);

// Bootstrap the Joomla Framework.
require realpath('/home/fastslack/www/joomla4/libraries/vendor/autoload.php');

try
{
	define('APPLICATION_CONFIG', realpath(__DIR__ . '/../etc/config.json'));
	$app = new jUpgradeNext\CliApplication;
	$app->execute();
}
catch (Exception $e)
{
	// An exception has been caught, just echo the message.
	fwrite(STDOUT, "Exception:\n " . $e->getMessage() . "\nTrace:\n");
	foreach ($e->getTrace() as $i => $trace)
	{
		fwrite(STDOUT, sprintf(
			"%2d. %s %s:%d\n",
			$i + 1,
			$trace['function'],
			str_ireplace(array(dirname(__DIR__)), '', $trace['file']),
			$trace['line']
		));
	}
	exit($e->getCode());
}
