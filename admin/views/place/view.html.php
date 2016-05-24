<?php
/**
 * Place View for Pvpollingplaces Component
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 * @license     GNU/GPL
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * Place View
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 */
class PvpollingplacesViewPlace extends JView
{
    /**
     * display method of Place view
     * @return void
     **/
    public function display($tpl = null)
    {

        $place     = &$this->get('Data');
        $neighbors = &$this->get('Neighbors');

        $isNew = ($place->id < 1);

        $text = $isNew ? JText::_('New') : JText::_('Edit');
        JToolBarHelper::title(JText::_('Place') . ': <small><small>[ ' . $text . ' ]</small></small>');
        if ($isNew) {
            JToolBarHelper::save('save', 'Register');
            JToolBarHelper::cancel('cancel', 'Close');
            // We'll use a separate template for new places: default_add
            $tpl = 'add';
        } else {
            // for existing items the button is renamed `close`
            JToolBarHelper::save('save', 'Update');
            JToolBarHelper::cancel('cancel', 'Close');
        }

        $this->assignRef('place', $place);
        $this->assignRef('neighbors', $neighbors);
        $this->assignRef('isNew', $isNew);
        d($neighbors, $this);
        parent::display($tpl);
    }
}
