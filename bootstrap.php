<?php
<?php
/**
 * JoomlaCliTools
 *
 * @version    $Id$
 * @package    JoomlaCliTools
 * @copyright  Copyright 2021 Matias Aguirre. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 * @author     Matias Aguirre <maguirre@matware.com.ar>
 * @link       https://matware.com.ar
 */

// Look for the Joomla! root path.
$ROOT = dirname(dirname(dirname(dirname(__FILE__)))).'/mtwProjects/J/joomla39';

// Define the application home directory.
$JAPIHOME = getenv('JAPI_HOME') ? getenv('JAPI_HOME') : $ROOT;

// Look for the Joomla Platform.
$JPLATFORMHOME = getenv('JPLATFORM_HOME') ? getenv('JPLATFORM_HOME') : $ROOT . '/libraries';
define('JPATH_PLATFORM', $JPLATFORMHOME);
define('JPATH_LIBRARIES', $JPLATFORMHOME);

// Fire up the Platform importer.
if (file_exists( JPATH_LIBRARIES . '/import.php'))
{
	require JPATH_LIBRARIES . '/import.php';
}

// Import the Joomla! CMS
if (file_exists(JPATH_LIBRARIES.'/cms.php')) {
	require_once JPATH_LIBRARIES.'/cms.php';
}

// Ensure that required path constants are defined.
if (!defined('JPATH_ROOT'))
{
	define('JPATH_ROOT', realpath(dirname(__DIR__)));
}
if (!defined('JPATH_BASE'))
{
	define('JPATH_BASE', realpath(dirname(__DIR__)));
}
if (!defined('JPATH_SITE'))
{
	define('JPATH_SITE', $JAPIHOME);
}
if (!defined('JPATH_ADMINISTRATOR'))
{
	define('JPATH_ADMINISTRATOR', $JAPIHOME . '/administrator');
}
if (!defined('JPATH_COMPONENTS'))
{
	define('JPATH_COMPONENTS', $JAPIHOME . '/components');
}
if (!defined('JPATH_CACHE'))
{
	define('JPATH_CACHE', $JAPIHOME.'/cache');
}
if (!defined('JPATH_CONFIGURATION'))
{
	define('JPATH_CONFIGURATION', $JAPIHOME . '/etc');
}
if (!defined('JPATH_API'))
{
	define('JPATH_API', $JAPIHOME . '/api');
}
if (!defined('JPATH_PLUGINS'))
{
	define('JPATH_PLUGINS', $JAPIHOME . '/plugins');
}

// Import the database libraries
jimport('joomla.database.database');
// Import the file libraries
jimport('joomla.filesystem.file');
// Import the html libraries
jimport('cms.html.html');

// Load Matware libraries
$bootstrap = JPATH_LIBRARIES . '/matware/bootstrap.php';

if (file_exists($bootstrap))
{
	require_once $bootstrap;
}

// Setup the autoloader for the API classes.
JLoader::registerPrefix('Api', $JAPIHOME . '/api');
