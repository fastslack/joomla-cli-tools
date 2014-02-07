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
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * {VIEWFORMNAME} View
 */
class {VIEWFORMNAME} extends JViewLegacy
{
	/**
	* display method of Exercise view
	* @return void
	*/
	public function display($tpl = null) 
	{
		// get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
	    JError::raiseError(500, implode('<br />', $errors));
	    return false;
		}
		// Assign the Data
		$this->form = $form;
		$this->item = $item;

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

	/**
	* Setting the toolbar
	*/
	protected function addToolBar() 
	{
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);
		$isNew = ($this->item->id == 0);
		JToolBarHelper::title($isNew ? JText::_('JTOOLBAR_NEW')
				                         : JText::_('JTOOLBAR_EDIT'));
		JToolBarHelper::save('{VIEWNAME}.save');
		JToolbarHelper::save2new('{VIEWNAME}.save2new');
		JToolBarHelper::cancel('{VIEWNAME}.cancel', $isNew ? 'JTOOLBAR_CANCEL'
				                                               : 'JTOOLBAR_CLOSE');
	}


	protected function getHtmlFieldSet($name) {

		$fieldset = '<fieldset class="form-vertical"><div class="control-group form-inline">';
	
		foreach($this->form->getFieldset($name) as $field)
		{
			$fieldset .= $field->label; 
			$fieldset .= '<div class="controls">';
			$fieldset .= $field->input;
			$fieldset .= '</div>';
		} 
	
		$fieldset .= '</div></fieldset>';

		return $fieldset;
	}

}
