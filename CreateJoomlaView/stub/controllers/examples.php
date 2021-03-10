<?php
/**
 * {OPTIONNAMEUCFIRST}
 *
 * @version    $Id:
 * @package    {CONFIGPACKAGE}
 * @copyright  {CONFIGCOPYRIGHT}
 * @author     {CONFIGAUTHOR}
 * @email      {CONFIGEMAIL}
 * @link       {CONFIGLINK}
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class {CONTROLLERLISTNAME} extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since   1.0
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
	 * @since   1.0
	 */
	protected function postDeleteHook(JModelLegacy $model, $ids = null)
	{
	}

	/**
	 * Method to cancel an edit.
	 *
	 * @param   string  $key  The name of the primary key of the URL variable.
	 *
	 * @return  boolean  True if access level checks pass, false otherwise.
	 *
	 * @since   1.6
	 */
	public function cancel($key = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$this->setRedirect( 'index.php?option=com_{OPTIONNAME}', null );
	}
}
