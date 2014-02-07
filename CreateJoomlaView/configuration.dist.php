<?php
/**
* JoomlaCliTools
*
* @version $Id$
* @package JoomlaCliTools
* @subpackage CreateJoomlaView
* @copyright Copyright 2004 - 2014 Matias Aguirre. All rights reserved.
* @license GNU General Public License version 2 or later.
* @author Matias Aguirre <maguirre@matware.com.ar>
* @link http://www.matware.com.ar
*/

// Prevent direct access to this file outside of a calling application.
defined('_JEXEC') or die;

/**
* CreateJoomlaView configuration class.
*
* @package JoomlaCliTools
* @since 1.0
*/
final class JConfig
{
	/**
	* The database configuration and table name
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

	// The destination path (/var/www/joomla_root_dir)
	public $webpath = '/var/www/joomla_root_dir';
	// The name of the component
	public $option = 'componentname';
	// The name of the view (it needs to be in singular mode. Ex: item instead items)
	public $view = 'viewtocreate';
}
