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
        JToolBarHelper::title(JText::_('Pvpollingplaces Manager'), 'generic.png');
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();
        JToolBarHelper::publish();
        JToolBarHelper::unpublish();
        $t = &JToolbar::getInstance('toolbar');
        $t->appendButton('Link', 'default', 'Export Filter', 'index.php?option=com_pvpollingplaces&controller=places&format=raw');
        // Get data from the model

        d($this, $this->getModel('Places'), $this->getModel('Divisions'), $this->getModel('Wards'));

        if (JRequest::getVar('ward')) {
            d($this->getModel('Wards'));
        }

        if (JRequest::getVar('d_id')) {
            d($this->getModel('Divisions'));
        }

        $items = &$this->get('Data');
        $pagination = &$this->get('Pagination');

        $this->assignRef('items', $items);
        $this->assignRef('pagination', $pagination);

        parent::display($tpl);
    }
}
