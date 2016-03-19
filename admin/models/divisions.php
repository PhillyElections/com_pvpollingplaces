<?php
/**
 * Divisions Model for Pvpollingplaces Component
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 * @license        GNU/GPL
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

/**
 * Places Model
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 */
class PvpollingplacesModelDivisions extends JModel
{
    /**
     * divisions data array
     *
     * @var array
     */
    public $_data;

    /**
     * divisions total
     *
     * @var int
     */
    public $_total;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    public function _buildQuery()
    {
        $where = '';
        if (JRequest('ward')) {
            $where = 'where ward=' . $this->_db->quoteName(JRequest('ward'));
        }

        $query = ' SELECT distinct id, division_id, division FROM #__divisions ' . $where;

        return $query;
    }

    /**
     * Retrieves the Pvpollingplace data
     * @return array Array of objects containing the data from the database
     */
    public function getData()
    {
        // if data hasn't already been obtained, load it
        if (empty($this->_data)) {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList($query);
        }
        return $this->_data;
    }

    public function getTotal()
    {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }
}
