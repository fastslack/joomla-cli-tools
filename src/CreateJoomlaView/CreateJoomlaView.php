<?php
/**
 * JoomlaCliTools
 *
 * @version    $Id$
 * @package    JoomlaCliTools
 * @subpackage CreateJoomlaView
 * @copyright  Copyright 2004 - 2021 Matias Aguirre. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 * @author     Matias Aguirre <maguirre@matware.com.ar>
 * @link       https://www.matware.com.ar
 */

namespace JoomlaCliTools\CreateJoomlaView;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Joomla\Application\AbstractCliApplication;
use Joomla\Registry\Registry;
use Joomla\Database;
use Joomla\Filesystem\File;
use Joomla\String\Inflector;


class CreateJoomlaView extends AbstractCliApplication
{
	/**
	 * Database driver.
	 *
	 * @var    Database\DatabaseDriver
	 * @since  1.0
	 */
	protected $db;

	/**
	 * XML file
	 *
	 * @var    Database\DatabaseDriver
	 * @since  1.0
	 */
	protected $xml;

	/**
	 * View name.
	 *
	 * @var    Database\DatabaseDriver
	 * @since  1.0
	 */
	protected $viewname;

	/**
	 * Layer.
	 *
	 * @var    Database\DatabaseDriver
	 * @since  1.0
	 */
	protected $layer;

	/**
	 * Joomla path
	 *
	 * @var    Database\DatabaseDriver
	 * @since  1.0
	 */
	protected $joomlapath;

	protected function initialise()
	{
		$this->xml      = $this->input->get('xml', null, 'none');
		$this->viewname = basename($this->xml, '.xml');

		$flag             = false;
		$this->layer      = "admin";
		$this->joomlapath = "";

		// Reverse array
		$explode = explode("/", $this->xml);
		$explode = array_reverse($explode);

		foreach ($explode as $key => $item)
		{
			if (substr($item, 0, 4) === 'com_')
			{
				$this->component = $item;
			}

			if (isset($explode[$key - 1]) && $explode[$key - 1] == 'administrator' && $explode[$key - 2] == 'components')
			{
				$flag             = true;
				$this->joomlapath = $item . "/" . $this->joomlapath;
			}
			else if (isset($explode[$key - 1]) && $explode[$key - 1] == 'components' && $item != 'administrator')
			{
				$flag             = true;
				$this->layer      = 'site';
				$this->joomlapath = $item . "/" . $this->joomlapath;
			}
			else if ($flag === true)
			{
				$this->joomlapath = $item . "/" . $this->joomlapath;
			}
		}

		// Define JPATH_BASE
		define('JPATH_BASE', $this->joomlapath);

		if (!defined('JPATH_ROOT')) {
			define('JPATH_ROOT', $this->joomlapath);
		}

		if (($this->layer != 'admin' && $this->layer != 'site') || empty($this->xml) || empty($this->component))
		{
			$this->help();
			$this->close();
		}

		// Get the component option
		$this->option = substr($this->component, 4, strlen($this->component));

		// Check if configuration.php exists
		$config = $this->joomlapath . 'configuration.php';

		if (!file_exists($config))
		{
			$this->out('ERROR: Joomla! configuration file not found');
			$this->out('  Path: ' . $config);
			$this->close();
		}

		if (!empty($config))
		{
			require_once $config;

			$this->params = new Registry(new \JConfig);
		}

		if (!empty($this->params))
		{
			// Make the database driver.
			$dbFactory = new Database\DatabaseFactory;

			$this->db = $dbFactory->getDriver(
				$this->params->get('dbtype'),
				array(
					'host'     => $this->params->get('host'),
					'user'     => $this->params->get('user'),
					'password' => $this->params->get('password'),
					'port'     => $this->params->get('port'),
					'socket'   => !empty($this->params->get('socket')) ? $this->params->get('socket') : '',
					'database' => $this->params->get('db'),
					'prefix'   => $this->params->get('dbprefix'),
				)
			);
		}
	}

	/**
	 * Print help
	 *
	 * @return   void
	 * @since    1.0.0
	 */
	public function help()
	{
		// Print help
		$this->out(' Usage: CreateJoomlaView --xml example_form.xml');
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
	public function doExecute()
	{
		// Read the xml form
		$this->xml = simplexml_load_file($this->xml);

		// Get the replace fields
		$this->getReplaceList();

		// Get the files
		$files = $this->getFiles();

		// Replace the strings
		foreach ($files as $file)
		{
			$this->replaceFile($file, $this->replace);
		}

		// Set the languages strings
		$this->replaceLanguage();
	}

	/**
	 * getReplaceList
	 *
	 * @since    1.0.0
	 */
	public function getReplaceList()
	{
		$inflector = Inflector::getInstance();

		// Get the fields
		$this->fields = $this->table = array();

		foreach ($this->xml->fieldset->field as $field)
		{
			$primary = (string) $field->attributes()->primary;
			$name    = (string) $field->attributes()->name;
			$type    = (string) $field->attributes()->type;

			if ($primary == true)
			{
				$this->primary = $name;
			}

			$this->fields[] = $name;
			$this->table[]  = array('name' => $name, 'type' => $type);

			unset($primary);
		}

		// Declare the replace array
		$this->replace = array();

		$this->replace['VIEWNAME']            = $this->viewname;
		$this->replace['VIEWNAMEPLURAL']      = $inflector->toPlural($this->viewname);
		$this->replace['VIEWNAMEUPPER']       = strtoupper($this->viewname);
		$this->replace['VIEWNAMEUPPERPLURAL'] = strtoupper($inflector->toPlural($this->viewname));
		$this->replace['VIEWNAMEUCFIRST']     = ucfirst($this->viewname);

		$this->replace['PRIMARYNAME'] = isset($this->primary) ? $this->primary : 'id';

		$this->replace['OPTIONNAME']        = $this->option;
		$this->replace['OPTIONNAMEUPPER']   = strtoupper($this->option);
		$this->replace['OPTIONNAMEUCFIRST'] = ucfirst($this->option);

		$this->replace['COM_EXAMPLE_TAB_TITLE'] = ucfirst($this->replace['VIEWNAMEPLURAL']);

		$this->replace['CONTROLLERLISTNAME'] = ucfirst($this->option) . "Controller" . ucfirst($this->replace['VIEWNAMEPLURAL']);
		$this->replace['CONTROLLERFORMNAME'] = ucfirst($this->option) . "Controller" . ucfirst($this->viewname);
		$this->replace['MODELLISTNAME']      = ucfirst($this->option) . "Model" . ucfirst($this->replace['VIEWNAMEPLURAL']);
		$this->replace['MODELFORMNAME']      = ucfirst($this->option) . "Model" . ucfirst($this->viewname);
		$this->replace['VIEWLISTNAME']       = ucfirst($this->option) . "View" . ucfirst($this->replace['VIEWNAMEPLURAL']);
		$this->replace['VIEWFORMNAME']       = ucfirst($this->option) . "View" . ucfirst($this->viewname);

		$this->replace['TABLENAME'] = ucfirst($this->option) . "Table" . ucfirst($this->viewname);

		$this->replace['HEADERCOMMENT'] = file_get_contents(__DIR__ . "/stub/header.txt");

		// Create the modal filter
		$this->createModalFilter();

		// Create the view filter
		$this->createViewFilter();

		// Create the view list
		$this->createViewList();

		// Create the sql table
		$this->createSQLTable();

		return true;
	}

	/**
	 * Replace language
	 *
	 * @since    1.0.0
	 */
	public function replaceLanguage()
	{
		// Get the content of the file
		if (file_exists($this->joomlapath . "/administrator/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini"))
		{
			$buffer = file_get_contents($this->joomlapath . "/administrator/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini");
		}
		else if (file_exists($this->joomlapath . "/administrator/components/com_{$this->replace['OPTIONNAME']}/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini"))
		{
			$buffer = file_get_contents($this->joomlapath . "/administrator/components/com_{$this->replace['OPTIONNAME']}/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini");
		}

		if (empty($buffer))
		{
			return false;
		}

		// Replace the language fields
		foreach ($this->xml->fieldset->field as $field)
		{
			$primary = (string) $field->attributes()->primary;
			$name    = (string) $field->attributes()->name;
			$name_up = strtoupper($name);

			if ($name != 'id' && $name != 'published')
			{
				$buffer .= "\nCOM_{$this->replace['OPTIONNAMEUPPER']}_{$this->replace['VIEWNAMEUPPERPLURAL']}_{$name_up}=\"\"";
			}
		}

		// Add the language title
		$buffer .= "\nCOM_{$this->replace['OPTIONNAMEUPPER']}_{$this->replace['VIEWNAMEUPPERPLURAL']}_TITLE=\"\"";

		// Write to file
		return File::write($this->joomlapath . "/administrator/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini", $buffer);
	}

	/**
	 * Replace files
	 *
	 * @since    1.0.0
	 */
	public function replaceFile($file)
	{
		// Get the content of the file
		$buffer = file_get_contents(__DIR__ . "/stub/{$this->layer}/{$file}");

		// Replace the defined content
		foreach ($this->replace as $key => $value)
		{
			$buffer = str_replace("{{$key}}", $value, $buffer);
		}

		// Replace the name of the views
		$file = str_replace("examples", "{$this->replace['VIEWNAMEPLURAL']}", $file);
		$file = str_replace("example", "{$this->viewname}", $file);

		// Set the correct destination pathfile
		$destfile = $this->joomlapath . '/administrator/components/' . $this->component . $file;

		return File::write($destfile, $buffer);
	}

	/**
	 * createViewFilter
	 *
	 * @since    1.0.0
	 */
	public function createViewList()
	{
		// Create the body list view
		$this->replace['VIEWLISTBODY'] = "";
		$this->replace['VIEWLISTHEAD'] = "";

		foreach ($this->xml->fieldset->field as $field)
		{
			$primary = (string) $field->attributes()->primary;
			$name    = (string) $field->attributes()->name;
			$name_up = strtoupper($name);

			if ($name != 'id' && $name != 'published')
			{
				if ($primary == true)
				{
					$this->replace['VIEWLISTBODY'] .= "\t\t<td>\n\t\t\t<a href=\"index.php?option=com_{$this->replace['OPTIONNAME']}&view={$this->replace['VIEWNAME']}&layout=edit&id=<?php echo \$item->id; ?>\"><?php echo \$item->{$name}; ?></a>\n\t\t</td>\n";

				}
				else
				{
					$this->replace['VIEWLISTBODY'] .= "\t\t<td>\n\t\t\t<?php echo \$item->{$name}; ?>\n\t\t</td>\n";
				}

				$this->replace['VIEWLISTHEAD'] .= "\t<th>\n\t\t<?php echo Text::_('COM_{$this->replace['OPTIONNAMEUPPER']}_{$this->replace['VIEWNAMEUPPERPLURAL']}_{$name_up}'); ?>\n\t</th>\n";

			}
		}
	}

	/**
	 * createViewFilter
	 *
	 * @since    1.0.0
	 */
	public function createViewFilter()
	{
		// Create the view filter
		$this->replace['VIEWFILTERLIST'] = "";

		foreach ($this->fields as $field)
		{
			$name    = $field;
			$name_up = strtoupper($name);

			if ($name != 'id')
			{
				$this->replace['VIEWFILTERLIST'] .= "\t\t\t\t't.{$name}' =>  Text::_('COM_{$this->replace['OPTIONNAMEUPPER']}_{$this->replace['VIEWNAMEUPPERPLURAL']}_{$name_up}'),\n";
			}
		}

		$this->replace['VIEWFILTERLIST'] .= "\t\t\t\t't.id' => Text::_('JGRID_HEADING_ID')";
	}

	/**
	 * createModalFilter
	 *
	 * @since    1.0.0
	 */
	public function createModalFilter()
	{
		// Create the modal filter
		$buffer = "";

		foreach ($this->fields as $field)
		{
			$name = $field;
			$tabs = ($name !== 'id') ? "\t\t\t\t" : "";

			$buffer .= "{$tabs}'{$name}', 't.{$name}',\n";
		}

		$this->replace['MODALFILTERLIST'] = <<<EOD
			\$config['filter_fields'] = array(
				{$buffer}
			);
EOD;
	}

	/**
	 * getFiles to replace
	 *
	 * @since    1.0.0
	 */
	public function getFiles()
	{
		// Set the files
		$files   = array();
		$files[] = '/sql/install/example.sql';
		$files[] = '/tables/example.php';
		$files[] = '/controllers/example.php';
		$files[] = '/controllers/examples.php';
		$files[] = '/models/example.php';
		$files[] = '/models/examples.php';
		$files[] = '/models/forms/filter_examples.xml';
		$files[] = '/views/example/view.html.php';
		$files[] = '/views/example/tmpl/edit.php';
		$files[] = '/views/examples/view.html.php';
		$files[] = '/views/examples/tmpl/default.php';
		$files[] = '/views/examples/tmpl/default_body.php';
		$files[] = '/views/examples/tmpl/default_foot.php';
		$files[] = '/views/examples/tmpl/default_head.php';

		return $files;
	}

	/**
	 * Method to create the sql file with CREATE TABLE statement
	 *
	 * @return   void
	 *
	 * @since    1.0.0
	 */
	public function createSQLTable()
	{
		// Create the modal filter
		$buffer = "";
		$table  = "#__{$this->option}_{$this->replace['VIEWNAMEPLURAL']}";

		foreach ($this->table as $t)
		{
			$type   = $this->getMySqlType($t['type']);
			$buffer .= "\t`{$t['name']}` {$type},\n";
		}

		$buffer .= "\tPRIMARY KEY (`{$this->table[0]['name']}`)\n";

		$table = "#__{$this->option}_{$this->replace['VIEWNAMEPLURAL']}";

		$this->replace['SQLTABLE'] = <<<EOD
CREATE TABLE {$table} (
	{$buffer}
);
EOD;
	}

	/**
	 * Method to get the correct mysql type
	 *
	 * @param    string  The Joomla! xml field type
	 *
	 * @return   string  The MySQL type
	 *
	 * @since    1.0.0
	 */
	public function getMySqlType($xmltype)
	{
		$return = '';

		switch ($xmltype)
		{
			case 'text':
				$return = 'VARCHAR(100)';
				break;
			case 'textarea':
				$return = 'TEXT';
				break;
			case 'calendar':
				$return = 'DATETIME';
				break;
			case 'int':
			case 'hidden':
			case 'sql':
            case 'createdby':
				$return = 'INT(11)';
				break;
		}

		return $return;
	}

}

// Wrap the execution in a try statement to catch any exceptions thrown anywhere in the script.
try
{
	$app = new CreateJoomlaView;
	$app->execute();
}
catch (Exception $e)
{
	// An exception has been caught, just echo the message.
	fwrite(STDOUT, $e->getMessage() . "\n");
	exit($e->getCode());
}
