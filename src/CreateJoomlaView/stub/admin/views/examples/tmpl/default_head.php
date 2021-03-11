<?php
{HEADERCOMMENT}

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
