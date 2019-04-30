<?php
/**
* JoomlaCliTools
*
* @version $Id$
* @package JoomlaCliTools
* @subpackage MigrateCSV2MySQL
* @copyright Copyright 2004 - 2013 Matias Aguire. All rights reserved.
* @license GNU General Public License version 2 or later.
* @author Matias Aguirre <maguirre@matware.com.ar>
* @link http://www.matware.com.ar
*/

// Prevent direct access to this file outside of a calling application.
defined('_JEXEC') or die;

/**
* MigrateCSV2MySQL configuration class.
*
* @package JoomlaCliTools
* @since 1.0
*/
final class JConfig
{
	/**
	* The MySQL database configuration to save the tables
	*
	* @var string
	* @since 1.0
	*/
	public $dbtype = 'mysqli';
	public $host = 'localhost';
	public $user = '';
	public $password = '';
	public $db = '';
	public $dbprefix = 'jos_';
}
