<?php
<?php
/**
 * JoomlaCliTools
 *
 * @version    $Id$
 * @package    JoomlaCliTools
 * @copyright  Copyright 2021 Matias Aguirre. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 * @author     Matias Aguirre <maguirre@matware.com.ar>
 * @link       https://matware.com.ar
 */

// Prevent direct access to this file outside of a calling application.
defined('_JEXEC') or die;

/**
* RESTfulTester configuration class.
*
* @package Matware
* @since 1.0
*/
final class JConfig
{
	/**
	* The RESTful configuration and table pattern to search
	*
	* @var string
	* @since 1.0
	*/
	public $url = 'http://localhost/joomla15';
	public $username = 'admin';
	public $password = 'admin';
	public $restkey = 'beer';
}
