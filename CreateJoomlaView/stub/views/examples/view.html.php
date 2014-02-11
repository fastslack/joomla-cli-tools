<?php
/**
* {OPTIONNAMEUCFIRST}
*
* @version $Id:
* @package Matware.{OPTIONNAMEUCFIRST}
* @copyright Copyright (C) 2004 - 2014 Matware. All rights reserved.
* @author Matias Aguirre
* @email maguirre@matware.com.ar
* @link http://www.matware.com.ar/
* @license GNU General Public License version 2 or later; see LICENSE
*/
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class {VIEWLISTNAME} extends JViewLegacy {

	protected $items;

	protected $pagination;

	protected $state;

	function display($tpl = null) {

		$this->state		= $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// Add the toolbar
		$this->addToolBar();

		parent::display($tpl);
	}

	/**
	* Setting the toolbar
	*/
	protected function addToolBar() 
	{
		$canDo = JHelperContent::getActions('com_{OPTIONNAME}', '{VIEWNAME}', $this->state->get('filter.published'));
		$user  = JFactory::getUser();

		JToolBarHelper::title(JText::_( 'COM_{OPTIONNAMEUPPER}_{VIEWNAMEUPPERPLURAL}_TITLE' ), 'plugin.png' );

		if ($canDo->get('core.create'))
		{
			JToolbarHelper::addNew('{VIEWNAME}.add');
		}

		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
		{
			JToolbarHelper::editList('{VIEWNAME}.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::publish('{VIEWNAMEPLURAL}.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('{VIEWNAMEPLURAL}.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		}

		JToolBarHelper::spacer();
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		return array(
			{VIEWFILTERLIST}
		);
	}
}
