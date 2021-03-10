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

$user		= JFactory::getUser();
$listOrder	= $this->escape($this->state->get('list.ordering'));
$userId		= $user->get('id');

foreach($this->items as $i => $item):

	$ordering   = ($listOrder == 't.id');
	$canCreate  = $user->authorise('core.create',     'com_{OPTIONNAME}.{VIEWNAME}.'.$item->id);
	$canEdit    = $user->authorise('core.edit',       'com_{OPTIONNAME}.{VIEWNAME}.'.$item->id);
	$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
	$canEditOwn = $user->authorise('core.edit.own',   'com_{OPTIONNAME}.{VIEWNAME}.'.$item->id) && $item->created_by == $userId;
	$canChange  = $user->authorise('core.edit.state', 'com_{OPTIONNAME}.{VIEWNAME}.'.$item->id) && $canCheckin;
?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td class="center" width="50">
			<div class="btn-group">
				<?php echo JHtml::_('jgrid.published', $item->published, $i, '{VIEWNAMEPLURAL}.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
				<?php
				// Create dropdown items
				$action = ($item->published == 1) ? 'unpublish' : 'publish';
				JHtml::_('actionsdropdown.' . $action, 'cb' . $i, '{VIEWNAMEPLURAL}');

				// Render dropdown list
				echo JHtml::_('actionsdropdown.render', $this->escape($item->title));
				?>
			</div>
		</td>
		{VIEWLISTBODY}
		<td>
			<?php echo $item->id; ?>
		</td>
	</tr>
<?php endforeach; ?>
