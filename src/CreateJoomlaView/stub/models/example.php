<?php
/**
 * {OPTIONNAMEUCFIRST}
 *
 * @version   $Id:
 * @package   Matware.{OPTIONNAMEUCFIRST}
 * @copyright Copyright (C) 2004 - 2019 Matware. All rights reserved.
 * @author    Matias Aguirre
 * @email     maguirre@matware.com.ar
 * @link      http://www.matware.com.ar/
 * @license   GNU General Public License version 2 or later; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\CMS\MVC\Model\AdminModel;

/**
 * {OPTIONNAMEUCFIRST} {VIEWNAMEUCFIRST} Model
 *
 * @package  {OPTIONNAMEUCFIRST}
 * @since    1.0.0
 */
class {MODELFORMNAME} extends AdminModel
{
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  Table  A database object
	 * @since   1.0.0
	 */
	public function getTable($type = '{VIEWNAMEUCFIRST}', $prefix = '{OPTIONNAMEUCFIRST}Table', $config = array())
	{
		return Table::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return      mixed   A JForm object on success, false on failure
	 * @since       1.0.0
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_{OPTIONNAME}.{VIEWNAME}', '{VIEWNAME}',
			array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return      mixed   The data for the form.
	 * @since       1.0.0
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = Factory::getApplication()->getUserState('com_{OPTIONNAME}.edit.{VIEWNAME}.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  boolean  True on success, False on error.
	 *
	 * @since   1.0.0
	 */
	public function save($data)
	{
		$table = Table::getInstance('{VIEWNAMEUCFIRST}', '{OPTIONNAMEUCFIRST}Table');

		$key = $table->getKeyName();
		$pk = (!empty($data[$key])) ? $data[$key] : (int) $this->getState($this->getName() . '.id');
		$isNew = true;

		// Allow an exception to be thrown.
		try
		{
			// Load the row if saving an existing record.
			if ($pk > 0)
			{
				$table->load($pk);
				$isNew = false;
			}

			// Bind the equipment info data.
			if (!$table->save($data))
			{
				$this->setError($table->getError());
				return false;
			}

			// Clean the cache.
			$this->cleanCache();

		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		$pkName = $table->getKeyName();

		if (isset($table->$pkName))
		{
			$this->setState($this->getName() . '.id', $table->$pkName);
		}

		$this->setState($this->getName() . '.new', $isNew);

		return true;
	}
}
