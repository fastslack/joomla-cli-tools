<?php
/**
* JoomlaCliTools
*
* @version $Id$
* @package JoomlaCliTools
* @subpackage CompareValues
* @copyright Copyright 2004 - 2013 Matias Aguire. All rights reserved.
* @license GNU General Public License version 2 or later.
* @author Matias Aguirre <maguirre@matware.com.ar>
* @link http://www.matware.com.ar
*/

// Prevent direct access to this file outside of a calling application.
defined('_JEXEC') or die;

/**
* CompareValues configuration class.
*
* @package JoomlaCliTools
* @since 1.0
*/
final class JConfig
{
	/**
	* The first database configuration and table name
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
	// (string) Pattern matching using SQL simple regular expression comparison.
	public $pattern = '%';

	/**
	* The second database configuration and table name
	*
	* @var string
	* @since 1.0
	*/
	public $new_dbtype = 'mysqli';
	public $new_hostname = 'localhost';
	public $new_username = '';
	public $new_password = '';
	public $new_db = '';
	public $new_dbprefix = 'jos_';
	// (string) Pattern matching using SQL simple regular expression comparison.
	public $new_pattern = '%';
}
