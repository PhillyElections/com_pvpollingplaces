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
            <label id="field1msg" for="field1">
    <?=JText::_('FIELD');?>:
            </label>
        </td>
        <td>
            <input type="text" id="field1" name="field1" size="60%" value="<?=($place->field1 ? $place->field1 : 'default');?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_('FIELD1 PLACEHOLDER');?>" />
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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `division_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ward` char(2) NOT NULL DEFAULT '',
  `division` char(2) NOT NULL DEFAULT '',
  `pin_address` varchar(255) NOT NULL,
  `display_address` varchar(255) DEFAULT NULL,
  `zip_code` int(5) unsigned NOT NULL,
  `location` varchar(255) NOT NULL DEFAULT '',
  `building` char(1) NOT NULL DEFAULT '',
  `parking` char(1) NOT NULL DEFAULT '',
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `elat` decimal(10,0) NOT NULL,
  `elng` decimal(11,0) NOT NULL,
  `alat` decimal(10,0) NOT NULL,
  `alng` decimal(11,0) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
-->