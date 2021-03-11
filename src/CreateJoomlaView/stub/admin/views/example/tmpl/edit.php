<?php
{HEADERCOMMENT}

// No direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

// get document to add scripts
$document	= Factory::getDocument();
?>
<form action="<?php echo Route::_('index.php?option=com_{OPTIONNAME}&view={VIEWNAME}&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal">

<div class="row-fluid">

<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

	<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'general', Text::_('COM_{OPTIONNAMEUPPER}_{VIEWNAMEUPPER}S_TITLE', true)); ?>
	<div>
		<!-- Begin Content -->
		<div class="span6 form-horizontal">
			<?php echo $this->getHtmlFieldSet('{VIEWNAME}s'); ?>
		</div>
	</div>
	<?php echo HTMLHelper::_('bootstrap.endTab'); ?>
	<!-- End Content -->

</div>

<input type="hidden" name="option" value="com_{OPTIONNAME}" />
<input type="hidden" name="task" value="" />
<input name="jform[id]" id="jform_id" value="<?php echo $this->item->id; ?>" class="readonly" readonly="" type="hidden">
<input type="hidden" name="boxchecked" value="0" />
<?php echo HTMLHelper::_('form.token'); ?>
</form>
