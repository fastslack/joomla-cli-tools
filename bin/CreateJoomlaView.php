#!/usr/bin/php
<?php
/**
 * JoomlaCliTools
 *
 * @version    $Id$
 * @package    JoomlaCliTools
 * @subpackage CreateJoomlaView
 * @copyright  Copyright 2004 - 2019 Matias Aguirre. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 * @author     Matias Aguirre <maguirre@matware.com.ar>
 * @link       http://www.matware.com.ar
 */

// We are a valid Joomla entry point.
define('_JEXEC', 1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

define('JPATH_ROOT', dirname(__DIR__));

use JoomlaCliTools\CreateJoomlaView;

class CreateJoomlaViewCli extends CreateJoomlaView
{
	/**
	 * Help
	 *
	 * @return    void
	 * @since    1.0.0
	 */
	public function help()
	{
		// Print help
		$this->out(' Usage: CreateJoomlaView --config configuration.php --form example_form.xml');
		$this->out();
		$this->out(' Author: Matias Aguirre (maguirre@matware.com.ar)');
		$this->out(' License: GNU/GPL http://www.gnu.org/licenses/gpl-2.0-standalone.html');
		$this->out();
	}

	/**
	 * Execute
	 *
	 * @since    1.0.0
	 */
	public function execute()
	{
		parent::doExecute();
	}
}

$cli = new CreateJoomlaViewCli();
$cli->execute();
