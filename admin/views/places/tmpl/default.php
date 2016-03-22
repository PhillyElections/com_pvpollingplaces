<?php defined('_JEXEC') or die('Restricted access');
$pagination = &$this->pagination;

jimport("pvcombo.PVCombo");
d(JRequest::get('REQUEST'));
$document = &JFactory::getDocument();
$document->addCustomTag('<script src="components/com_pvpollingplaces/assets/js/places.js" async defer></script>');
?>
<form action="<?=JRoute::_('index.php?option=com_pvpollingplaces');?>" method="post" name="adminForm" id="adminForm">
    <div id="editcell">
        <table class="adminlist">
            <thead>
                <tr>
                    <th colspan="14" id="filterWard" class="hiding">
<?php
for ($i = 0; $i < count($this->wards); $i++):
?><label><?=str_pad($this->wards[$i], 2, "0");?><input name="ward[]" type="checkbox" value="<?=$this->wards[$i];?>" <?=JRequest::getVar('ward', false) && in_array($i, JRequest::getVar('ward')) ? 'checked' : '';?> \></label>
<?php
endfor;
?>
                    </th>
                </tr>
               <tr>
                    <th colspan="14" id="filterDivision" class="hiding">
<?php
for ($i = 0; $i < count($this->divisions); $i++):
?><label><?=str_pad($this->divisions[$i], 2, "0");?><input name="d_id[]" type="checkbox" value="<?=$this->divisions[$i];?>" <?=JRequest::getVar('d_id', false) && in_array($i, JRequest::getVar('d_id')) ? 'checked' : '';?> \></label>
<?php
endfor;
?>
                    </th>
                </tr>
                <tr>
                    <th width="5px">
                        <?=JText::_('ID');?>
                    </th>
                    <th width="5px">
                        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?=count($this->items);?>);" />
                    </th>
                    <th width="5px">
                        P
                    </th>
                    <th><button id="btnWard" data-area="filterWard"><?=JText::_('Ward');?></button>
                    <?php //=JHTML::_('select.genericlist', PVCombo::getsFromObject($this->wards, 'ward', 'ward'), 'ward', 'multiple data-action="submits"', 'idx', 'value', (JRequest::getVar('ward') ? JRequest::getVar('ward') : ''), 'ward');;;;;;;;;;;;;;;;?>
                    </th>
                    <th><button id="btnDivision" data-area"filterDivision"><?=JText::_('Division');?></button>
                    <?php //=(isset($this->divisions) && count($this->divisions) ? JHTML::_('select.genericlist', PVCombo::getsFromObject($this->divisions, 'division', 'division'), 'd_id', 'multiple data-action="submits"', 'idx', 'value', (JRequest::getVar('d_id') ? JRequest::getVar('d_id') : ''), 'd_id') : JText::_('Division'));;;;;;;;;?></th>
                    <th><?=JText::_('Pin');?></th>
                    <th><?=JText::_('Display');?></th>
                    <th><?=JText::_('Name');?></th>
                    <th><?=JText::_('Location');?></th>
                    <th><?=JText::_('Entrance');?></th>
                    <th><?=JText::_('Accessiblility');?></th>
                    <th><?=JText::_('Published');?></th>
                    <th><?=JText::_('Created');?></th>
                    <th><?=JText::_('Updated');?></th>
                </tr>
            </thead>
            <?php
$k = 0;
for ($i = 0, $n = count($this->items); $i < $n; $i++) {
    $row = &$this->items[$i];
    $link = JRoute::_('index.php?option=com_pvpollingplaces&controller=place&task=edit&cid[]=' . $row->id);
    ?>
            <tr class="<?="row$k";?>">
                <td>
                    <?=$row->id;?>
                </td>
            <td>
                <?=JHTML::_('grid.id', $i, $row->id);?>
            </td>
            <td>
                <?=JHTML::_('grid.published', $row, $i);?>
            </td>
                <td><?=$row->ward;?></td>
                <td><?=$row->division;?></td>
                <td><?=$row->pin_address;?></td>
                <td><?=$row->display_address;?></td>
                <td><a href="<?=$link;?>"><?=$row->location;?></a></td>
                <td><?=$row->lat;?>,<?=$row->lng;?></td>
                <td><?=$row->elat;?>,<?=$row->elng;?></td>
                <td><?=$row->alat;?>,<?=$row->alng;?></td>
                <td><?=$row->published;?></td>
                <td><?=$row->created;?></td>
                <td><?=$row->updated;?></td>
            </tr>
            <?php
$k = 1 - $k;
}
?>
            <tfoot>
            <tr>
                <td colspan="14"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
            </tfoot>
        </table>
    </div>
    <?=JHTML::_('form.token');?>
    <input type="hidden" name="option" value="com_pvpollingplaces" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="places" />
    <input type="hidden" name="view" value="places" />
    <?=JHTML::_('form.token');?>
</form>