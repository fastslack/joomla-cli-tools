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
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
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
		<?php echo JText::_('JGRID_HEADING_ID'); ?>
	</th>
</tr>
