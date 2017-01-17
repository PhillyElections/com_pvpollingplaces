<?php
/**
 * Pvpollingplaces Place table
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 * @license        GNU/GPL
 */

defined('_JEXEC') or die('Restricted access');

/**
 * @package Philadelphia.Votes
 */

class TablePlacedivision extends JTable
{
    public $id;
    public $pollingplace_id;
    public $division_id;
    public $published;
    public $checked_out;
    public $checked_out_time;
    public $created;
    public $updated;

    public function __construct(&$_db)
    {
        parent::__construct('#__pv_pollingplace_divisions', 'id', $_db);
    }

    /**
     * override parent::check
     *
     * @return boolean
     */
    public function check()
    {
        // we need a first_name
        /*        if (!JString::trim($this->field)) {
        $this->setError(JText::_('VALIDATION FIELD REQUIRED'));
        }
         */
        if (count($this->getErrors())) {
            return false;
        }
        return true;
    }
}
