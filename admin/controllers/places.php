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
}
