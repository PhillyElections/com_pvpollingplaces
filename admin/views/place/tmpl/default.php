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
$document->addStyleSheet('components/com_pvpollingplaces/assets/css/place.css');
$document->addCustomTag('<script src="components/com_pvpollingplaces/assets/js/place.js" async defer></script>');
?>
<form action="<?=JRoute::_('index.php?option=com_pvpollingplaces');?>" method="post" id="adminForm" name="adminForm" class="form-validate">
  <div class="right wrapper fifty-five">
    <div id="map"></div>
    <p>Click to set:
      <ul class="markers">
        <li class="marker" data-marker="building"><img src="/components/com_voterapp/polling.png" /> Building</li>
        <li class="marker" data-marker="entrance"><img src="components/com_pvpollingplaces/assets/images/e.png" />Main Entrance</li>
        <li class="marker" data-marker="accessible"><img src="components/com_pvpollingplaces/assets/images/h.png" />Accessible Entrance</li>
        <li class="marker-cancel"><img src="components/com_pvpollingplaces/assets/images/x.png" />Stop placing markers</li>
      </ul>
    </p>
  </div>
  <div class="left">
    <table class="contentpane clearfix forty-five">
      <tr>
        <td height="40">
          <label id="idmsg" for="id"><?=JText::_("ID");?>:</label>
        </td>
        <td>
          <input type="text" id="id" name="id" size="60%" value="<?=($place->id ? $place->id : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ID PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="division_idmsg" for="division_id"><?=JText::_("DIVISION_ID");?>:</label>
        </td>
        <td>
          <input type="text" id="division_id" name="division_id" size="60%" value="<?=($place->division_id ? $place->division_id : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("DIVISION_ID PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="wardmsg" for="ward"><?=JText::_("WARD");?>:</label>
        </td>
        <td>
          <input type="text" id="ward" name="ward" size="60%" value="<?=($place->ward ? $place->ward : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("WARD PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="divisionmsg" for="division"><?=JText::_("DIVISION");?>:</label>
        </td>
        <td>
          <input type="text" id="division" name="division" size="60%" value="<?=($place->division ? $place->division : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("DIVISION PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="pin_addressmsg" for="pin_address"><?=JText::_("PIN_ADDRESS");?>:</label>
        </td>
        <td>
          <input type="text" id="pin_address" name="pin_address" size="60%" value="<?=($place->pin_address ? $place->pin_address : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("PIN_ADDRESS PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="display_addressmsg" for="display_address"><?=JText::_("DISPLAY_ADDRESS");?>:</label>
        </td>
        <td>
          <input type="text" id="display_address" name="display_address" size="60%" value="<?=($place->display_address ? $place->display_address : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("DISPLAY_ADDRESS PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="zip_codemsg" for="zip_code"><?=JText::_("ZIP_CODE");?>:</label>
        </td>
        <td>
          <input type="text" id="zip_code" name="zip_code" size="60%" value="<?=($place->zip_code ? $place->zip_code : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ZIP_CODE PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="locationmsg" for="location"><?=JText::_("LOCATION");?>:</label>
        </td>
        <td>
          <input type="text" id="location" name="location" size="60%" value="<?=($place->location ? $place->location : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("LOCATION PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="display_locationmsg" for="display_location"><?=JText::_("DISPLAY_LOCATION");?>:</label>
        </td>
        <td>
          <input type="text" id="display_location" name="display_location" size="60%" value="<?=($place->display_location ? $place->display_location : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("LOCATION PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="buildingmsg" for="building"><?=JText::_("BUILDING");?>:</label>
        </td>
        <td>
          <input type="text" id="building" name="building" size="60%" value="<?=($place->building ? $place->building : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("BUILDING PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="parkingmsg" for="parking"><?=JText::_("PARKING");?>:</label>
        </td>
        <td>
          <input type="text" id="parking" name="parking" size="60%" value="<?=($place->parking ? $place->parking : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("PARKING PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="latmsg" for="lat"><?=JText::_("COORDINATES");?>:</label>
        </td>
        <td>
          <table>
            <tbody>
              <tr>
                <td>Building</td>
                <td id="display-building"></td>
              </tr>
              <tr>
                <td>Main Entrance</td>
                <td id="display-entrance"></td>
              </tr>
              <tr>
                <td>Accessible Entrance</td>
                <td id="display-accessible"></td>
              </tr>
            </tbody>
          </table>
          <input type="hidden" id="lat" name="lat" size="60%" value="<?=($place->lat ? $place->lat : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("LAT PLACEHOLDER");?>" />
          <input type="hidden" id="lng" name="lng" size="60%" value="<?=($place->lng ? $place->lng : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("LNG PLACEHOLDER");?>" />
          <input type="hidden" id="elat" name="elat" size="60%" value="<?=($place->elat ? $place->elat : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ELAT PLACEHOLDER");?>" />
          <input type="hidden" id="elng" name="elng" size="60%" value="<?=($place->elng ? $place->elng : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ELNG PLACEHOLDER");?>" />
          <input type="hidden" id="alat" name="alat" size="60%" value="<?=($place->alat ? $place->alat : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ALAT PLACEHOLDER");?>" />
          <input type="hidden" id="alng" name="alng" size="60%" value="<?=($place->alng ? $place->alng : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ALNG PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="publishedmsg" for="published"><?=JText::_("PUBLISHED");?>:</label>
        </td>
        <td>
          <input type="checkbox" id="published" name="published" value="published" <?=($place->published ? "checked" : "");?> />
        </td>
      </tr>
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
  </div>
</form>