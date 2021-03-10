<?php
/**
* {OPTIONNAMEUCFIRST}
*
* @version $Id:
* @package Matware.{OPTIONNAMEUCFIRST}
* @copyright Copyright (C) 2004 - 2019 Matware. All rights reserved.
* @author Matias Aguirre
* @email maguirre@matware.com.ar
* @link http://www.matware.com.ar/
* @license GNU General Public License version 2 or later; see LICENSE
*/
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;

?>
<tr>
	<th width="20">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
	</th>
	<th>
		&nbsp;
	</th>
	{VIEWLISTHEAD}
	<th width="5">
		<?php echo Text::_('JGRID_HEADING_ID'); ?>
	</th>
</tr>
