<?php
/**
 * Places Controller for Pvpollingplaces Component
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 * @license        GNU/GPL
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Places Controller
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 */
class PvpollingplacesControllerPlaces extends PvpollingplacesController
{
    public function display()
    {
        JRequest::setVar('view', 'places');
        parent::display();
    }

    public function publish()
    {
        JRequest::checkToken() or jexit('Invalid Token');
        $cid = JRequest::getVar('cid');

        foreach ($cid as $id) {
            $row = JTable::getInstance('Place', 'Table');
            $row->load($id);
            $row->publish($id, 1);
        }
    }

    public function unpublish()
    {
        JRequest::checkToken() or jexit('Invalid Token');
        $cid = JRequest::getVar('cid');

        foreach ($cid as $id) {
            $row = JTable::getInstance('Place', 'Table');
            $row->load($id);
            $row->publish($id, 1);
        }
    }
}
