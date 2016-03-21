<?php defined('_JEXEC') or die('Restricted access');
$pagination = &$this->pagination;

jimport("pvcombo.PVCombo");
JHTML::_('behavior.combobox');
//$document = &JFactory::getDocument();
//$document->addCustomTag('<script src="components/com_pvpollingplaces/assets/js/places.js" async defer></script>');
?>
<form action="<?=JRoute::_('index.php?option=com_pvpollingplaces');?>" method="post" name="adminForm" id="adminForm">
    <div id="editcell">
        <table class="adminlist">
            <thead>
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
                    <th>
                    <input class="combobox" type="text" name="ward" id="ward" value="<?=JText::_('Ward');?>" />
  <ul id="combobox-ward" style="display:none;">
   <?php
for ($i = 0, $n = count($this->wards); $i < $n; $i++):
    echo '<li>' . $this->wards[$i]->ward . '</li>';
endfor;
?>
   </ul>
                    <?php //=JHTML::_('select.genericlist', PVCombo::getsFromObject($this->wards, 'ward', 'ward', JText::_('Ward')), 'ward', 'class="combobox" data-action="submits"', 'idx', 'value', (JRequest::getVar('ward') ? JRequest::getVar('ward') : ''), 'ward');;;?>
                    </th>
                    <th><?=(isset($this->divisions) && count($this->divisions) ? JHTML::_('select.genericlist', PVCombo::getsFromObject($this->divisions, 'division', 'division', JText::_('Division')), 'd_id', 'class="combobox" data-action="submits"', 'idx', 'value', (JRequest::getVar('d_id') ? JRequest::getVar('d_id') : ''), 'd_id') : JText::_('Division'));?></th>
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