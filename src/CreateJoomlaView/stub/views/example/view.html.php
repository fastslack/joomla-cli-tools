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
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * {VIEWFORMNAME} View
 */
class {VIEWFORMNAME} extends HtmlView
{
	/**
	 * Display method of {VIEWFORMNAME} view
	 *
	 * @return null
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
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @throws Exception
	 * @since  1.0.0
	 */
	protected function addToolBar()
	{
		$input = Factory::getApplication()->input;

		$input->set('hidemainmenu', true);
		$isNew = ($this->item->id == 0);

		ToolBarHelper::title($isNew ? JText::_('JTOOLBAR_NEW')
				                         : JText::_('JTOOLBAR_EDIT'));
		ToolBarHelper::save('{VIEWNAME}.save');
		ToolbarHelper::save2new('{VIEWNAME}.save2new');
		ToolBarHelper::cancel('{VIEWNAME}.cancel', $isNew ? 'JTOOLBAR_CANCEL'
				                                               : 'JTOOLBAR_CLOSE');
	}

	/**
	 * Get HTML fieldset
	 */
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
