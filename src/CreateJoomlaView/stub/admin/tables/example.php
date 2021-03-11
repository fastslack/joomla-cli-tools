<?php
{HEADERCOMMENT}

// no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Table\Table;

/**
 * {OPTIONNAMEUCFIRST} {VIEWNAMEUCFIRST} table class
 *
 * @since  1.0.0
 */
class {TABLENAME} extends Table
{

	/**
	 * Constructor
	 *
	 * @param   Database  &$db  A database connector object
	 * @since   1.0.0
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__{OPTIONNAME}_{VIEWNAMEPLURAL}', 'id', $db);
	}
}
