<?php
/**
 * Pvpollingplaces View for Pvpollingplaces Component
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license        GNU/GPL
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * Pvpollingplaces View
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class PvpollingplacesViewList extends JView
{
    /**
     * Pvpollingplaces view display method
     * @return void
     **/
    public function display($tpl = 'export')
    {

        // Get data from the model

        $items = &$this->get('Data');

        $this->assignRef('items', $items);

        parent::display($tpl);
    }
}
