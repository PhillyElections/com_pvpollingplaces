<?php defined('_JEXEC') or die('Restricted access');
$pagination = &$this->pagination;

jimport('pvcombo.PVCombo');

$document = &JFactory::getDocument();
$document->addCustomTag('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>');
$document->addCustomTag('<script src="/media/multi-column-select/Multi-Column-Select/Multi-Column-Select.js"></script>');
$document->addCustomTag('<script src="components/com_pvpollingplaces/assets/js/filter.js"></script>');
$document->addStyleSheet('components/com_pvpollingplaces/assets/css/filter.css');

?>
<form action="<?=JRoute::_('index.php?option=com_pvpollingplaces');?>" method="post" name="adminForm" id="adminForm">
    <div id="editcell">
        <table class="adminlist">
        <thead>
<?php /*
if (count($this->items) or JRequest::getVar('ward')):

<tr>
<th colspan="14" id="selectcontrol" data-filter="Filter by Wards">
HTML::_('select.genericlist', PVCombo::getsFromObject($this->wards, 'ward', 'ward'), 'ward[]', 'multiple', 'idx', 'value', (JRequest::getVar('ward') ? JRequest::getVar('ward') : ''), 'ward');
</th>
</tr>

endif;
 */;?>
            <tr>
                <th width="5px"><?=JText::_('ID');?></th>
                <th width="5px"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?=count($this->items);?>);" /></th>
                <th width="5px">P</th>
                <th><?=JText::_('PIN');?></th>
                <th><?=JText::_('DISPLAY');?></th>
                <th><?=JText::_('NAME');?></th>
                <th><?=JText::_('BUILDING');?></th>
                <th><?=JText::_('ENTRANCE');?></th>
                <th><?=JText::_('ACCESSIBILITY');?></th>
                <th><?=JText::_('PUBLISHED');?></th>
                <th><?=JText::_('CREATED');?></th>
                <th><?=JText::_('UPDATED');?></th>
            </tr>
        </thead>
        <tbody>
            <?php
$k = 0;
for ($i = 0, $n = count($this->items); $i < $n; ++$i) {
    $row  = &$this->items[$i];
    $link = JRoute::_('index.php?option=com_pvpollingplaces&controller=place&task=edit&cid[]=' . $row->id);
    ?>
            <tr class="<?="row$k";
    ?>">
                <td><?=$row->id;?></td>
                <td><?=JHTML::_('grid.id', $i, $row->id);?></td>
                <td><?=JHTML::_('grid.published', $row, $i);?></td>
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
        </tbody>
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
    <?=JHTML::_('form.token');?>
</form>
