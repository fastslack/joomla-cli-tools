<?php
/**
* JoomlaCliTools
*
* @version $Id$
* @package JoomlaCliTools
* @subpackage OAuth
* @copyright Copyright 2004 - 2013 Matias Aguirre. All rights reserved.
* @license GNU General Public License version 2 or later.
* @author Matias Aguirre <maguirre@matware.com.ar>
* @link http://www.matware.com.ar
*/

// Prevent direct access to this file outside of a calling application.
defined('_JEXEC') or die;

/**
* OAuth2Tester configuration class.
*
* @package Matware
* @since 1.0
*/
final class JConfig
{
	/**
	* The OAuth2Tester configuration
	*
	* @var string
	* @since 1.0
	*/
	// The API Rest URL to get the resource
	public $url = 'http://example.org/api/joomla:articles';
	// The Joomla! username
	public $username = 'test';
	// The Joomla! password
	public $password = 'test';
	// Signature method: PLAINTEXT | HMAC-SHA1 | RSA-SHA1
	public $signature_method = 'PLAINTEXT';
	// Random RESTful key
	public $rest_key = null;

	public function __construct()
	{
		$this->rest_key = $this->randomKey();
	}

	/**
	 * Generate a random (and optionally unique) key.
	 *
	 * @param   boolean  $unique  True to enforce uniqueness for the key.
	 *
	 * @return  string
	 *
	 * @since   1.0
	 */
	protected function randomKey($unique = false)
	{
		$str = md5(uniqid(rand(), true));

		if ($unique)
		{
			list ($u, $s) = explode(' ', microtime());
			$str .= dechex($u) . dechex($s);
		}
		return $str;
	}
} // end clas
