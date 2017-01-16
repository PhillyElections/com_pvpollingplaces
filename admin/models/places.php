<?php
/**
 * Places Model for Pvpollingplaces Component
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
class PvpollingplacesModelPlaces extends JModel
{
    /**
     * Pvpollingplaces data array
     *
     * @var array
     */
    public $_data;

    /**
     * Items total
     * @var integer
     */
    public $_total;

    /**
     * Pagination object
     * @var object
     */
    public $_pagination;

    public function __construct()
    {
        parent::__construct();

        $mainframe = JFactory::getApplication();

        // Get pagination request variables
        $limit      = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = $mainframe->getUserStateFromRequest('global.list.limitstart', 'limitstart', '', 'int');

        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        // Store pagination values locally
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);

        // Set filter state in session and store locally
        $this->setState('wards', $mainframe->getUserStateFromRequest('com_pvpollingplaces.wards', 'ward', ''));
        $this->setState('divisions', $mainframe->getUserStateFromRequest('com_pvpollingplaces.divisions', 'div', ''));

    }

    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    public function _buildQuery()
    {
        $where      = '';
        $tmp        = array();
        $query      = ' SELECT * FROM `#__pv_pollingplaces` AS `p`, `#__pv_pollingplace_divisions` AS `pd`, `#__divisions` AS `d` ';
        $wards_list = $divisions_list = array();

        $wards     = $this->getState('wards');
        $divisions = $this->getState('divisions');

        if ($divisions) {
            $where = ' where ';
            foreach ($divisions as $division) {
                $div_elem = (string) JString::substr(trim($division), 0, 2);
                if (!isset($divisions_list[$div_elem])) {
                    $divisions_list[$div_elem] = array();
                }
                array_push($divisions_list[$div_elem], $this->_db->quote(JString::substr($division, 2, 2)));
            }
            foreach ($divisions_list as $ward => $divs) {
                $tmp[] = '(ward=' . $this->_db->quote($ward) . ' and division in (' . implode(', ', $divs) . '))';

            }
            $where .= implode(' or ', $tmp);

        } elseif ($wards) {
            foreach ($wards as $ward) {
                $wards_list[] = $this->_db->quote((int) $ward);
            }
            $where = ' WHERE ';
            $where .= '   TRIM(LEADING \'0\' FROM ward) in (' . implode(", ", $wards_list) . ') ';
            $where .= '   AND `d`.`id`=`pd`.`division_id` ';
            $where .= '   AND `p`.`id`=`pd`.`pollingplace_id` ';
        }

        return $query . $where;
    }

    /**
     * Retrieves the Pvpollingplace data
     *
     * @return array Array of objects containing the data from the database
     */
    public function getData()
    {
        // if data hasn't already been obtained, load it
        if (empty($this->_data)) {
            $query       = $this->_buildQuery();
            $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        }
        return $this->_data;
    }

    /**
     * Set results count as $this->_total and return
     *
     * @return mixed
     */
    public function getTotal()
    {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query        = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }

    /**
     * create pagination , set to $this->_pagination and return
     *
     * @return mixed
     */
    public function getPagination()
    {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
        }
        return $this->_pagination;
    }

    /**
     * publish items
     *
     * @return void
     */
    public function publish()
    {
        $cid = JRequest::getVar('cid');

        foreach ($cid as $id) {
            $row = JTable::getInstance('Place', 'Table');
            $row->load($id);
            $row->publish($id, 1);
        }
    }

    /**
     * unpublish items
     *
     * @return void
     */
    public function unpublish()
    {
        $cid = JRequest::getVar('cid');

        foreach ($cid as $id) {
            $row = JTable::getInstance('Place', 'Table');
            $row->load($id);
            $row->publish($id, 0);
        }
    }
}
