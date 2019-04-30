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

namespace JoomlaCliTools;

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

	protected function initialise()
	{
		$config        = $this->input->get('config', null, 'none');
		$this->xmlfile = $this->input->get('xml', null, 'none');

		if (empty($this->xmlfile) || empty($config))
		{
			$this->help();

			$this->close();
		}

		if (!empty($config))
		{
			require_once $config;

			$this->params = new Registry(new \JConfig);
		}

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

	/**
	 * Execute
	 *
	 * @since    1.0.0
	 */
	public function doExecute()
	{
		// Read the xml form
		$this->xml = simplexml_load_file($this->xmlfile);

		// Get the replace fields
		$this->getReplaceList();

		// Get the files
		$files = $this->getFiles();

		// Replace the strings
		foreach ($files as $file)
		{
			$this->replaceFile($file, $this->replace);
		}

		// Copy xml form to destination
		$this->destpath = $this->params->get('webpath') . '/administrator/components/com_' . $this->params->get('option');

		File::copy($this->xmlfile, $this->destpath . '/models/forms/' . $this->params->get('view') . '.xml');

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
			$this->table[] = array('name' => $name, 'type' => $type);

			unset($primary);
		}

		// Declare the replace array
		$this->replace = array();

		$this->replace['VIEWNAME']            = $this->params->get('view');
		$this->replace['VIEWNAMEPLURAL']      = $inflector->toPlural($this->params->get('view'));
		$this->replace['VIEWNAMEUPPER']       = strtoupper($this->params->get('view'));
		$this->replace['VIEWNAMEUPPERPLURAL'] = strtoupper($inflector->toPlural($this->params->get('view')));
		$this->replace['VIEWNAMEUCFIRST']     = ucfirst($this->params->get('view'));

		$this->replace['PRIMARYNAME'] = $this->primary;

		$this->replace['OPTIONNAME']        = $this->params->get('option');
		$this->replace['OPTIONNAMEUPPER']   = strtoupper($this->params->get('option'));
		$this->replace['OPTIONNAMEUCFIRST'] = ucfirst($this->params->get('option'));

		$this->replace['COM_EXAMPLE_TAB_TITLE'] = ucfirst($this->replace['VIEWNAMEPLURAL']);

		$this->replace['CONTROLLERLISTNAME'] = ucfirst($this->params->get('option')) . "Controller" . ucfirst($this->replace['VIEWNAMEPLURAL']);
		$this->replace['CONTROLLERFORMNAME'] = ucfirst($this->params->get('option')) . "Controller" . ucfirst($this->params->get('view'));
		$this->replace['MODELLISTNAME']      = ucfirst($this->params->get('option')) . "Model" . ucfirst($this->replace['VIEWNAMEPLURAL']);
		$this->replace['MODELFORMNAME']      = ucfirst($this->params->get('option')) . "Model" . ucfirst($this->params->get('view'));
		$this->replace['VIEWLISTNAME']       = ucfirst($this->params->get('option')) . "View" . ucfirst($this->replace['VIEWNAMEPLURAL']);
		$this->replace['VIEWFORMNAME']       = ucfirst($this->params->get('option')) . "View" . ucfirst($this->params->get('view'));

		$this->replace['TABLENAME'] = ucfirst($this->params->get('option')) . "Table" . ucfirst($this->params->get('view'));

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
		if (file_exists($this->params->get('webpath') . "/administrator/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini"))
		{
			$buffer = file_get_contents($this->params->get('webpath') . "/administrator/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini");
		}
		else if (file_exists($this->params->get('webpath') . "/administrator/components/com_{$this->replace['OPTIONNAME']}/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini"))
		{
			$buffer = file_get_contents($this->params->get('webpath') . "/administrator/components/com_{$this->replace['OPTIONNAME']}/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini");
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
		return File::write($this->params->get('webpath') . "/administrator/language/en-GB/en-GB.com_{$this->replace['OPTIONNAME']}.ini", $buffer);
	}

	/**
	 * Replace files
	 *
	 * @since    1.0.0
	 */
	public function replaceFile($file, $list)
	{
		// Get the content of the file
		$buffer = file_get_contents(__DIR__ . "/stub" . $file);

		// Replace the defined content
		foreach ($list as $key => $value)
		{
			$buffer = str_replace("{{$key}}", $value, $buffer);
		}

		// Replace the name of the views
		$file = str_replace("examples", "{$this->replace['VIEWNAMEPLURAL']}", $file);
		$file = str_replace("example", "{$this->params->get('view')}", $file);

		// Set the correct destination pathfile
		$destfile = $this->params->get('webpath') . '/administrator/components/com_' . $this->params->get('option') . $file;

		return File::write($destfile, $buffer);

		return true;
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
		$table = "#__{$this->params->get('option')}_{$this->replace['VIEWNAMEPLURAL']}";

		foreach ($this->table as $t)
		{
			$type = $this->getMySqlType($t['type']);
			$buffer .= "\t`{$t['name']}` {$type},\n";
		}

		$buffer .= "\tconstraint {$table}_pk\n";
		$buffer .= "\tprimary key ({$this->table[0]['name']})\n";

		$table = "#__{$this->params->get('option')}_{$this->replace['VIEWNAMEPLURAL']}";

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
		switch ($xmltype)
		{
			case 'text':
				$return = 'VARCHAR(100)';
				break;
			case 'calendar':
				$return = 'DATETIME';
				break;
			case 'int':
			case 'hidden':
				$return = 'INT(11)';
				break;
		}

		return $return;
	}

} // end class

