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

// Import the Joomla! CMS Libraries
//require_once dirname(dirname(__FILE__)).'/joomla-cms.rest/libraries/import.php';

// Look for the Joomla! root path.
$ROOT = dirname(dirname(__FILE__)).'/joomla-cms.rest';

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
// Ensure that required path constants are defined.
if (!defined('JPATH_SITE'))
{
	define('JPATH_SITE', $ROOT);
}

// Import the database libraries
jimport('joomla.database.database');
// Import the file libraries
jimport('joomla.filesystem.file');
// Import the html libraries
jimport('cms.html.html');
// Load redRAD if it exists
$redradLoader = JPATH_PLATFORM . '/redrad/bootstrap.php';

if (file_exists($redradLoader))
{
	require_once $redradLoader;

	JLoader::registerPrefix('J',  JPATH_LIBRARIES . '/redrad/joomla');
}
