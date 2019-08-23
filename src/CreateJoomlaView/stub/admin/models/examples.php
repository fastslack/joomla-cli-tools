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
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\Utilities\ArrayHelper;

/**
 * {OPTIONNAMEUCFIRST} {COM_EXAMPLE_TAB_TITLE} Model
 *
 * @package  {OPTIONNAMEUCFIRST}
 * @since    1.0.0
 */
class {MODELLISTNAME} extends ListModel
{
	/**
	 * Constructor.
	 *
	 * @param   array $config An optional associative array of configuration settings.
	 * @see     ListModel
	 * @since   1.0.0
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			{MODALFILTERLIST}
		}

		parent::__construct($config);
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string $type   The table type to instantiate
	 * @param   string $prefix A prefix for the table class name. Optional.
	 * @param   array  $config Configuration array for model. Optional.
	 *
	 * @return  Table  A database object
	 * @since   1.0.0
	 */
	public function getTable($type = '{VIEWNAMEUCFIRST}', $prefix = '{OPTIONNAMEUCFIRST}Table', $config = array())
	{
		return Table::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * @param   string $ordering  The ordering field
	 * @param   string $direction The ordering direction
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.0.0
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$accessId = $this->getUserStateFromRequest($this->context . '.filter.access', 'filter_access', null, 'int');
		$this->setState('filter.access', $accessId);

		$published = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $published);

		// Load the parameters.
		$params = ComponentHelper::getParams('com_{OPTIONNAME}');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('t.{PRIMARYNAME}', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 * @since   1.0.0
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.access');
		$id .= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return  string  An SQL query
	 * @since   1.0.0
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = Factory::getDBO();

		$query = $db->getQuery(true);

		// Select some fields
		$query->select(
			$db->quoteName(
				array(
{SQLSELECTFIELDS}
				),
				array(
{SQLSELECTFIELDS2}
				)
			)
		):

		// From the #__{OPTIONNAME}_{VIEWNAMEPLURAL} table
		$query->from($db->quoteName('#__{OPTIONNAME}_{VIEWNAMEPLURAL}') . ' AS {VIEWNAMEPLURAL}');

		// Filter by search in {PRIMARYNAME}
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('{VIEWNAMEPLURAL}.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->quote('%' . $db->escape($search, true) . '%');
				$query->where('{VIEWNAMEPLURAL}.{PRIMARYNAME} LIKE ' . $search);
			}
		}

		// Add the list ordering clause.
		$ordering = $this->state->get('list.fullordering', '{PRIMARYNAME} ASC');
		$query->order($db->escape($ordering));

		return $query;
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission for the component.
	 *
	 * @since   1.0.0
	 */
	protected function canDelete($record)
	{
		$user = Factory::getUser();
		return $user->authorise('core.delete', $this->option);
	}

	/**
	 * Method to delete groups.
	 *
	 * @param   array  An array of item ids.
	 *
	 * @return  boolean  Returns true on success, false on failure.
	 */
	public function delete($itemIds)
	{
		// Sanitize the ids.
		$itemIds = (array) $itemIds;

		ArrayHelper::toInteger($itemIds);

		// Get a group row instance.
		$table = $this->getTable();

		// Iterate the items to delete each one.
		foreach ($itemIds as $itemId)
		{
			if (!$table->delete($itemId))
			{
				$this->setError($table->getError());

				return false;
			}
		}

		// Clean the cache
		$this->cleanCache();

		return true;
	}
}
