<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
$document = &JFactory::getDocument();
// we'll need these for the combo
jimport("pvcombo.PVCombo");
if (count(JRequest::getVar('msg', null, 'post'))) {
    foreach (JRequest::getVar('msg', null, 'post') as $msg) {
        JError::raiseWarning(1, $msg);
    }
}
$place = $this->place;

$document->addCustomTag('<script src="components/com_pvpollingplaces/assets/js/pollingplaces.js" async defer></script>');
?>
<form action="<?=JRoute::_('index.php?option=com_pvpollingplaces');?>" method="post" id="adminForm" name="adminForm" class="form-validate">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
    <tr>
        <td height="40">
            <label id="field1msg" for="display_address">
    <?=JText::_('FIELD');?>:
            </label>
        </td>
        <td>
            <input type="text" id="display_address" name="display_address" size="60%" value="<?=($place->display_address ? $place->display_address : '');?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_('DISPLAY_ADDRESS PLACEHOLDER');?>" />
        </td>
    </tr>
    <tr>
        <td height="40">
            <label id="field2msg" for="field2">
    <?=JText::_('FIELD2');?>:
            </label>
        </td>
        <td>
    <?=JHTML::_('select.genericlist', PVCombo::gets('state'), 'field2', 'class="inputbox required"', 'idx', 'value', ($place->field2 ? $place->field2 : 'default'), 'field2');?>
    </td>
    <tr>
        <td height="40">&nbsp;</td>
        <td>
            <button class="button validate" type="submit"><?=$this->isNew ? JText::_('CREATE') : JText::_('UPDATE');?></button>
            <input type="hidden" name="task" value="<?=$this->isNew ? 'create' : 'update';?>" />
            <input type="hidden" name="controller" value="place" />
            <input type="hidden" name="id" value="<?=$place->id;?>" />
            <?=JHTML::_('form.token');?>
        </td>
    </tr>
</table>
</form>
<!--
  $places->id
  $places->division_id
  $places->ward
  $places->division
  $places->pin_address
  $places->display_address
  $places->zip_code
  $places->location
  $places->building
  $places->parking
  $places->lat
  $places->lng
  $places->elat
  $places->elng
  $places->alat
  $places->alng
  $places->published
  $places->checked_out
  $places->checked_out_time
  $places->created
  $places->updated
-->