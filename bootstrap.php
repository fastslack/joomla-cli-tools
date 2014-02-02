<?php
/**
* JoomlaCliTools
*
* @version $Id$
* @package MatWare
* @subpackage JoomlaCliTools
* @copyright Copyright 2004 - 2013 Matias Aguirre. All rights reserved.
* @license GNU General Public License version 2 or later.
* @author Matias Aguirre <maguirre@matware.com.ar>
* @link http://www.matware.com.ar
*/

// Look for the Joomla! root path.
$ROOT = dirname(dirname(dirname(__FILE__))).'/www/joomla-cms';

// Ensure that required path constants are defined.
if (!defined('JPATH_LIBRARIES'))
{
	define('JPATH_LIBRARIES', $ROOT.'/libraries');
}
// Fire up the Platform importer.
if (file_exists(JPATH_LIBRARIES . '/import.php'))
{
	require JPATH_LIBRARIES . '/import.php';
}
// Import the Joomla! CMS
if (file_exists(JPATH_LIBRARIES.'/cms.php')) {
	require_once JPATH_LIBRARIES.'/cms.php';
}
// Ensure that required path constants are defined.
if (!defined('JPATH_SITE'))
{
	define('JPATH_SITE', $ROOT);
}
// Define cache path
if (!defined('JPATH_CACHE'))
{
	define('JPATH_CACHE', $ROOT.'/cache');
}

// Import the database libraries
jimport('joomla.database.database');
// Import the file libraries
jimport('joomla.filesystem.file');
// Import the html libraries
jimport('cms.html.html');
