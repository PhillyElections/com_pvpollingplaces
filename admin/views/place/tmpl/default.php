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
    <tr>         <td height="40">             <label id="idmsg" for="id">     <?=JText::_("ID");?>:             </label>         </td>         <td>             <input type="text" id="id" name="id" size="60%" value="<?=($places->id ? $places->id : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ID PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="division_idmsg" for="division_id">     <?=JText::_("DIVISION_ID");?>:             </label>         </td>         <td>             <input type="text" id="division_id" name="division_id" size="60%" value="<?=($places->division_id ? $places->division_id : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("DIVISION_ID PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="wardmsg" for="ward">     <?=JText::_("WARD");?>:             </label>         </td>         <td>             <input type="text" id="ward" name="ward" size="60%" value="<?=($places->ward ? $places->ward : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("WARD PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="divisionmsg" for="division">     <?=JText::_("DIVISION");?>:             </label>         </td>         <td>             <input type="text" id="division" name="division" size="60%" value="<?=($places->division ? $places->division : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("DIVISION PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="pin_addressmsg" for="pin_address">     <?=JText::_("PIN_ADDRESS");?>:             </label>         </td>         <td>             <input type="text" id="pin_address" name="pin_address" size="60%" value="<?=($places->pin_address ? $places->pin_address : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("PIN_ADDRESS PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="display_addressmsg" for="display_address">     <?=JText::_("DISPLAY_ADDRESS");?>:             </label>         </td>         <td>             <input type="text" id="display_address" name="display_address" size="60%" value="<?=($places->display_address ? $places->display_address : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("DISPLAY_ADDRESS PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="zip_codemsg" for="zip_code">     <?=JText::_("ZIP_CODE");?>:             </label>         </td>         <td>             <input type="text" id="zip_code" name="zip_code" size="60%" value="<?=($places->zip_code ? $places->zip_code : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ZIP_CODE PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="locationmsg" for="location">     <?=JText::_("LOCATION");?>:             </label>         </td>         <td>             <input type="text" id="location" name="location" size="60%" value="<?=($places->location ? $places->location : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("LOCATION PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="buildingmsg" for="building">     <?=JText::_("BUILDING");?>:             </label>         </td>         <td>             <input type="text" id="building" name="building" size="60%" value="<?=($places->building ? $places->building : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("BUILDING PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="parkingmsg" for="parking">     <?=JText::_("PARKING");?>:             </label>         </td>         <td>             <input type="text" id="parking" name="parking" size="60%" value="<?=($places->parking ? $places->parking : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("PARKING PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="latmsg" for="lat">     <?=JText::_("LAT");?>:             </label>         </td>         <td>             <input type="text" id="lat" name="lat" size="60%" value="<?=($places->lat ? $places->lat : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("LAT PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="lngmsg" for="lng">     <?=JText::_("LNG");?>:             </label>         </td>         <td>             <input type="text" id="lng" name="lng" size="60%" value="<?=($places->lng ? $places->lng : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("LNG PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="elatmsg" for="elat">     <?=JText::_("ELAT");?>:             </label>         </td>         <td>             <input type="text" id="elat" name="elat" size="60%" value="<?=($places->elat ? $places->elat : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ELAT PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="elngmsg" for="elng">     <?=JText::_("ELNG");?>:             </label>         </td>         <td>             <input type="text" id="elng" name="elng" size="60%" value="<?=($places->elng ? $places->elng : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ELNG PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="alatmsg" for="alat">     <?=JText::_("ALAT");?>:             </label>         </td>         <td>             <input type="text" id="alat" name="alat" size="60%" value="<?=($places->alat ? $places->alat : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ALAT PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="alngmsg" for="alng">     <?=JText::_("ALNG");?>:             </label>         </td>         <td>             <input type="text" id="alng" name="alng" size="60%" value="<?=($places->alng ? $places->alng : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ALNG PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="publishedmsg" for="published">     <?=JText::_("PUBLISHED");?>:             </label>         </td>         <td>             <input type="text" id="published" name="published" size="60%" value="<?=($places->published ? $places->published : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("PUBLISHED PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="checked_outmsg" for="checked_out">     <?=JText::_("CHECKED_OUT");?>:             </label>         </td>         <td>             <input type="text" id="checked_out" name="checked_out" size="60%" value="<?=($places->checked_out ? $places->checked_out : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("CHECKED_OUT PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="checked_out_timemsg" for="checked_out_time">     <?=JText::_("CHECKED_OUT_TIME");?>:             </label>         </td>         <td>             <input type="text" id="checked_out_time" name="checked_out_time" size="60%" value="<?=($places->checked_out_time ? $places->checked_out_time : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("CHECKED_OUT_TIME PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="createdmsg" for="created">     <?=JText::_("CREATED");?>:             </label>         </td>         <td>             <input type="text" id="created" name="created" size="60%" value="<?=($places->created ? $places->created : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("CREATED PLACEHOLDER");?>" />         </td>     </tr>
    <tr>         <td height="40">             <label id="updatedmsg" for="updated">     <?=JText::_("UPDATED");?>:             </label>         </td>         <td>             <input type="text" id="updated" name="updated" size="60%" value="<?=($places->updated ? $places->updated : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("UPDATED PLACEHOLDER");?>" />         </td>     </tr>
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
id
division_id
ward
division
pin_address
display_address
zip_code
location
building
parking
lat
lng
elat
elng
alat
alng
published
checked_out
checked_out_time
created
updated
ID
DIVISION_ID
WARD
DIVISION
PIN_ADDRESS
DISPLAY_ADDRESS
ZIP_CODE
LOCATION
BUILDING
PARKING
LAT
LNG
ELAT
ELNG
ALAT
ALNG
PUBLISHED
CHECKED_OUT
CHECKED_OUT_TIME
CREATED
UPDATED
-->