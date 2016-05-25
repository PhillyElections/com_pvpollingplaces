<?php
/**
 * Pvpollingplaces Place controller
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 * @license        GNU/GPL
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Pvpollingplace Pvpollingplace Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class PvpollingplacesControllerPlace extends PvpollingplacesController
{
    /**
     * constructor (registers additional tasks to methods)
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Register Extra tasks
        $this->registerTask('add', 'edit');
        $this->registerTask('register', 'save');
        $this->registerTask('update', 'save');

    }

    /**
     * display the edit form
     * @return void
     */
    public function edit()
    {
        JRequest::setVar('view', 'place');

        parent::display();
    }

    /**
     * save a record (and redirect according to how it was saved)
     *
     * @return void
     */
    public function save()
    {
        JRequest::checkToken() or jexit('Invalid Token');

        $model = $this->getModel('place');

        if ($model->store()) {
            $msg = JText::_('Saved!');
        } else {
            // let's grab all those errors and make them available to the view
            JRequest::setVar('msg', $model->getErrors());

            return $this->edit();
        }

        $record_url = 'index.php?option=com_pvpollingplaces&controller=place&task=edit&cid[]=';

        $link = 'index.php?option=com_pvpollingplaces';

        if (JRequest::getVar('save_only')) {
            $link = $record_url . JRequest::getVar('id', '', 'int');
        }

        if (JRequest::getVar('save_and_previous')) {
            $link = $record_url . JRequest::getVar('previous', '', 'int');
        }

        if (JRequest::getVar('save_and_next')) {
            $link = $record_url . JRequest::getVar('next', '', 'int');
        }

        // Let's go back to the default view
        $this->setRedirect($link, $msg);
    }

    /**
     * remove record(s)
     *
     * @return void
     */
    public function remove()
    {
        JRequest::checkToken() or jexit('Invalid Token');

        $model = $this->getModel('applicant');
        if (!$model->delete()) {
            $msg = JText::_('Error: One or More Polling Place(s) Could not be Deleted');
        } else {
            $msg = JText::_('Polling Place(s) Deleted');
        }

        $this->setRedirect('index.php?option=com_pvpollingplaces', $msg);
    }

    /**
     * cancel editing a record
     *
     * @return void
     */
    public function cancel()
    {
        $msg = JText::_('Operation Cancelled');
        $this->setRedirect('index.php?option=com_pvpollingplaces', $msg);
    }
}
