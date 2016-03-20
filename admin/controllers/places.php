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
        // if 'raw' isn't explicit, set to 'html'
        $view = $this->getView('places', JRequest::getWord('format', 'html'));
        $view->setModel($this->getModel('Places'), true);
        $view->setModel($this->getModel('Wards'), false);

        if (JRequest::getVar('ward', false)) {
            $view->setModel($this->getModel('Divisions'), false);
        }

        $view->display();
    }

    public function publish()
    {
        JRequest::checkToken() or jexit('Invalid Token');

        $model = $this->getModel('places');
        $model->publish();
        $this->display();
    }

    public function unpublish()
    {
        JRequest::checkToken() or jexit('Invalid Token');

        $model = $this->getModel('places');
        $model->unpublish();
        $this->display();
    }
}
