<?php
/**
 * Pvpollingplaces View for Pvpollingplaces Component
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 * @license        GNU/GPL
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * Pvpollingplaces View
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 */
class PvpollingplacesViewPlaces extends JView
{
    /**
     * Pvpollingplaces view display method
     * @return void
     **/
    public function display($tpl = null)
    {
        $divlink = $wardlink = '';
        JToolBarHelper::title(JText::_('Pollingplaces Manager'), 'generic.png');
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
//        JToolBarHelper::addNewX();
        JToolBarHelper::publish();
        JToolBarHelper::unpublish();

        // Get data from the model

/*        $model = $this->getModel('Wards');
$wards = $model->getData();
$this->assignRef('wards', $wards);

// leaving division wiring in place
if (JRequest::getVar('ward', false) && !JRequest::getVar('format', false)) {
if (JRequest::getVar('div', false)) {
$divlink = "&div=" . JRequest::getVar('div');
}
$wardlink = "&ward=" . JRequest::getVar('ward');
$model = $this->getModel('Divisions');
$divisions = $model->getData();
$this->assignRef('divisions', $divisions);
}
 */
        $t = &JToolbar::getInstance('toolbar');
        $t->appendButton('Link', 'default', 'Export Filter', 'index.php?option=com_pvpollingplaces&controller=places&format=raw' . $wardlink . $divlink);

        $items      = &$this->get('Data');
        $pagination = &$this->get('Pagination');

        $this->assignRef('items', $items);
        $this->assignRef('pagination', $pagination);

        parent::display($tpl);
    }
}
