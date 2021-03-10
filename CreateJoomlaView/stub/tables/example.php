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
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * {OPTIONNAMEUCFIRST} {VIEWNAMEUCFIRST} table class
 *
 */
class {TABLENAME} extends JTable {

  /**
   * Constructor
   *
   * @param object Database connector object
   */
	function __construct(&$_db) {
		parent::__construct('#__{OPTIONNAME}_{VIEWNAMEPLURAL}', 'id', $_db);
	}
}
