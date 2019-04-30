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
