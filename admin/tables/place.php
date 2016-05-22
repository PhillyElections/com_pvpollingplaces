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

class TablePlace extends JTable
{
    public $id;
    public $division_id;
    public $ward;
    public $division;
    public $pin_address;
    public $display_address;
    public $zip_code;
    public $location;
    public $building;
    public $parking;
    public $lat;
    public $lng;
    public $elat;
    public $elng;
    public $alat;
    public $alng;
    public $published;
    public $checked_out;
    public $checked_out_time;
    public $created;
    public $updated;

    public function __construct(&$_db)
    {
        parent::__construct('#__pollingplaces', 'id', $_db);
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
