<?php
{HEADERCOMMENT}

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

use Joomla\CMS\Session\Session;
use Joomla\CMS\MVC\Controller\AdminController;

/**
 * {COM_EXAMPLE_TAB_TITLE} list controller class.
 *
 * @since 1.0.0
 */
class {CONTROLLERLISTNAME} extends AdminController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    Optional. Model name
	 * @param   string  $prefix  Optional. Class prefix
	 * @param   array   $config  Optional. Configuration array for model
	 *
	 * @return  object    The Model
	 *
	 * @throws  Exception
	 * @since   1.0.0
	 */
	public function getModel($name = '{VIEWNAMEUCFIRST}', $prefix = '{OPTIONNAMEUCFIRST}Model', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	/**
	 * Method to provide child classes the opportunity to process after the delete task.
	 *
	 * @param   JModelLegacy   $model   The model for the component
	 * @param   mixed          $ids     array of ids deleted.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	protected function postDeleteHook(JModelLegacy $model, $ids = null)
	{
	}

	/**
	 * Method to cancel an edit.
	 *
	 * @param   string  $key  The name of the primary key of the URL variable.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function cancel($key = null)
	{
		Session::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$this->setRedirect( 'index.php?option=com_{OPTIONNAME}', null );
	}
}
