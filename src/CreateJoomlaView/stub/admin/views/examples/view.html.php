<?php
{HEADERCOMMENT}

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Language\Text;

class {VIEWLISTNAME} extends HtmlView {

	/**
	 * An array of items
	 *
	 * @var     array
	 * @since   1.0.0
	 */
	protected $items;

	/**
	 * The pagination object
	 *
	 * @var     JPagination
	 * @since   1.0.0
	 */
	protected $pagination;

	/**
	 * The model state
	 *
	 * @var     object
	 * @since   1.0.0
	 */
	protected $state;

	/**
	 * Form object for search filters
	 *
	 * @var     JForm
	 * @since   1.0.0
	 */
	public $filterForm;

	/**
	 * The active search filters
	 *
	 * @var     array
	 * @since   1.0.0
	 */
	public $activeFilters;

	/**
	 * Display method of Opendays view
	 *
	 * @param   string  $tpl The template name
	 *
	 * @return string
	 *
	 * @since  1.0.0
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$this->state         = $this->get('State');
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
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
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @throws Exception
	 * @since  1.0.0
	 */
	protected function addToolBar()
	{
		$canDo = JHelperContent::getActions('com_{OPTIONNAME}', '{VIEWNAME}', $this->state->get('filter.published'));

		JToolBarHelper::title(JText::_('COM_{OPTIONNAMEUPPER}_{VIEWNAMEUPPERPLURAL}_TITLE'), 'plugin.png');

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

		JToolBarHelper::cancel('{VIEWNAMEPLURAL}.cancel', 'JTOOLBAR_CLOSE');
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
