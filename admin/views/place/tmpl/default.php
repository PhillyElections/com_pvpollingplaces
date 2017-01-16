<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
$document = &JFactory::getDocument();

// we'll need this for the combos
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
  <div class="right fifty-five">
    <div id="map"></div>
    <p>Click to set:
      <ul class="markers">
        <li class="marker" data-marker="building"><img src="/components/com_voterapp/polling.png" /> <?=JText::_('BUILDING');?></li>
        <li class="marker" data-marker="entrance"><img src="components/com_pvpollingplaces/assets/images/e.png" /><?=JText::_('MAIN ENTRANCE');?></li>
        <li class="marker" data-marker="accessible"><img src="components/com_pvpollingplaces/assets/images/h.png" /><?=JText::_('ACCESSIBLE ENTRANCE');?></li>
        <li class="marker-cancel"><img src="components/com_pvpollingplaces/assets/images/x.png" /><?=JText::_('STOP PLACING MARKERS');?></li>
        <li class="marker-clear"><?=JText::_('CLEAR MARKERS');?></li>
      </ul>
    </p>
  </div>
  <div class="left">
<?php
if ($this->neighbors->previous):
?>
    <div class="left">
	    <a title="<?=JText::_('SKIP TO DIVISION');?> <?=$this->neighbors->previous->wd;?>" class="btn" href="<?=JRoute::_('index.php?option=com_pvpollingplaces&controller=place&task=edit&cid[]=' . $this->neighbors->previous->id);?>" ><?=JText::_('PREVIOUS');?></a>
    </div>
<?php
endif;
if ($this->neighbors->next):
?>
    <div class="right">
      <a title="Skip to division: <?=$this->neighbors->next->wd;?>" class="btn" href="<?=JRoute::_('index.php?option=com_pvpollingplaces&controller=place&task=edit&cid[]=' . $this->neighbors->next->id);?>" ><?=JText::_('NEXT');?></a>
    </div>
<?php
endif;
?>
<div class="clearfix"></div>

    <table class="contentpane clearfix forty-five">
      <tr>
        <td height="40">
          <label id="publishedmsg" for="published"><?=JText::_("PUBLISHED");?>:</label>
        </td>
        <td>
          <input type="checkbox" id="published" name="published" value="published" <?=($place->published ? "checked" : "");?> />
          <label id="idmsg" class="right" for="id">ID: <?=($place->id ? $place->id : "");?></label>
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="pin_addressmsg" for="pin_address"><?=JText::_("PIN_ADDRESS");?>:</label>
        </td>
        <td>
          <input type="text" id="pin_address" name="pin_address" size="60" value="<?=($place->pin_address ? $place->pin_address : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("PIN_ADDRESS PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="display_addressmsg" for="display_address"><?=JText::_("DISPLAY_ADDRESS");?>:</label>
        </td>
        <td>
          <input type="text" id="display_address" name="display_address" size="60" value="<?=($place->display_address ? $place->display_address : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("DISPLAY_ADDRESS PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="zip_codemsg" for="zip_code"><?=JText::_("ZIP_CODE");?>:</label>
        </td>
        <td>
          <input type="text" id="zip_code" name="zip_code" size="60" value="<?=($place->zip_code ? $place->zip_code : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("ZIP_CODE PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="locationmsg" for="location"><?=JText::_("LOCATION");?>:</label>
        </td>
        <td>
          <input type="text" id="location" name="location" size="50%" value="<?=($place->location ? $place->location : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("LOCATION PLACEHOLDER");?>" /> <span id="find_by_name" class="btn">Find</span>
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="display_locationmsg" for="display_location"><?=JText::_("DISPLAY_LOCATION");?>:</label>
        </td>
        <td>
          <input type="text" id="display_location" name="display_location" size="60" value="<?=($place->display_location ? $place->display_location : "");?>" class="inputbox required" maxlength="60" placeholder="<?=JText::_("DISPLAY_LOCATION PLACEHOLDER");?>" />
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="buildingmsg" for="building"><?=JText::_("BUILDING");?>:</label>
        </td>
        <td>
          <?=JHTML::_('select.genericlist', PVCombo::gets('building'), 'building', 'class="input_box required"', 'idx', 'value', ($place->building ? $place->building : ''), 'building');?>
        </td>
      </tr>
      <tr>
        <td height="40">
          <label id="parkingmsg" for="parking"><?=JText::_("PARKING");?>:</label>
        </td>
        <td>
          <?=JHTML::_('select.genericlist', PVCombo::gets('parking'), 'parking', 'class="input_box required"', 'idx', 'value', ($place->parking ? $place->parking : ''), 'parking');?>
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
                <td><?=JText::_('Building');?></td>
                <td id="display-building"></td>
              </tr>
              <tr>
                <td><?=JText::_('Main Entrance');?></td>
                <td id="display-entrance"></td>
              </tr>
              <tr>
                <td><?=JText::_('Accessible Entrance');?></td>
                <td id="display-accessible"></td>
              </tr>
            </tbody>
          </table>
          <input type="hidden" id="lat" name="lat" value="<?=($place->lat ? $place->lat : "");?>" />
          <input type="hidden" id="lng" name="lng" value="<?=($place->lng ? $place->lng : "");?>" />
          <input type="hidden" id="elat" name="elat" value="<?=($place->elat ? $place->elat : "");?>" />
          <input type="hidden" id="elng" name="elng" value="<?=($place->elng ? $place->elng : "");?>" />
          <input type="hidden" id="alat" name="alat" value="<?=($place->alat ? $place->alat : "");?>" />
          <input type="hidden" id="alng" name="alng" value="<?=($place->alng ? $place->alng : "");?>" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input class="button validate" name="save_and_close" type="submit" value="<?=$this->isNew ? JText::_('CREATE') : JText::_('SAVE AND CLOSE');?>" />
<?php
if (!$this->isNew):
?>
          <input class="button validate" name="save_only" type="submit" value="<?=JText::_('UPDATE');?>" />
          <input type="hidden" name="task" value="update" />
<?php
if ($this->neighbors->previous):
?>
          <input class="button validate" name="save_and_previous" type="submit" value="<?=JText::_('SAVE AND PREVIOUS');?>" />
          <input type="hidden" name="next" value="<?=$this->neighbors->previous->id;?>" />
<?php
endif;
if ($this->neighbors->next):
?>
          <input class="button validate" name="save_and_next" type="submit" value="<?=JText::_('SAVE AND NEXT');?>" />
          <input type="hidden" name="next" value="<?=$this->neighbors->next->id;?>" />
<?php
endif;
else:
?>
          <input type="hidden" name="task" value="create" />
<?php
endif;
?>
          <input type="hidden" name="controller" value="place" />
          <input type="hidden" name="id" value="<?=$place->id;?>" />
          <?=JHTML::_('form.token');?>
        </td>
      </tr>
    </table>
  </div>
</form>
