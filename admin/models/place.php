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
 * Place Model
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 */
class PvpollingplacesModelPlace extends JModel
{

    private $_criteria;

    /**
     * Constructor that retrieves the ID from the request
     *
     * @access    public
     * @return    void
     */
    public function __construct()
    {
        parent::__construct();

        $array = JRequest::getVar('cid', 0, '', 'array');
        $id    = JRequest::getInt('id');
        if ($id) {
            // in case we're updating and check() failed
            $this->setId((int) $id);
        } else {
            $this->setId((int) $array[0]);
        }

        // We have an id, so we can set the previous/next strings
        $this->_criteria           = new stdClass();
        $this->_criteria->next     = ' id = (select min(id) from #__pollingplaces where id > ' . $this->_db->quote($this->_id) . ') ';
        $this->_criteria->previous = ' id = (select max(id) from #__pollingplaces where id < ' . $this->_db->quote($this->_id) . ') ';

        $mainframe = JFactory::getApplication();

        // Set filter state in session and store locally
        $this->setState('wards', $mainframe->getUserState('com_pvpollingplaces.wards', 'ward', ''));
        $this->setState('divisions', $mainframe->getUserState('com_pvpollingplaces.divisions', 'div', ''));
    }

    /**
     * Method to set the place identifier
     *
     * @access    public
     * @param    int place identifier
     * @return    void
     */
    public function setId($id)
    {
        // Set id and wipe data
        $this->_id   = $id;
        $this->_data = null;
    }

    /**
     * Method to get an place
     *
     * @return object with data
     */
    public function &getData()
    {
        // Load the data
        if (empty($this->_data)) {
            $query = ' SELECT * FROM #__pollingplaces ' .
            '  WHERE id = ' . $this->_db->quote($this->_id);
            $this->_db->setQuery($query);
            $this->_data = $this->_db->loadObject();
        }
        if (!$this->_data) {
            $this->_data           = new stdClass();
            $this->_data->id       = 0;
            $this->_data->greeting = null;
        }
        return $this->_data;
    }

    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    public function _buildQuery()
    {
        $where      = '';
        $tmp        = array();
        $query      = ' SELECT * FROM #__pollingplaces ';
        $wards_list = $divisions_list = array();

        $wards     = $this->getState('wards');
        $divisions = $this->getState('divisions');

        if ($divisions) {
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
            $filter_criteria = implode(' or ', $tmp);

        } elseif ($wards) {
            foreach ($wards as $ward) {
                $wards_list[] = $this->_db->quote((int) $ward);
            }

            $filter_criteria = ' and (TRIM(LEADING \'0\' FROM ward) in (' . implode(", ", $wards_list) . ')) ';
        }

        $where = ' where ';
        $where .= ' (id = (select min(id) from #__pollingplaces where id > ' . $this->_db->quote($this->_id) . ' ' . $filter_criteria . ' )) or ' .
        '( id = (select max(id) from #__pollingplaces where id < ' . $this->_db->quote($this->_id) . ' ' . $filter_criteria . ' )) ';

        return $query . $where;
    }

    /**
     * Retrieves the Pvpollingplace data
     *
     * @return array Array of objects containing the data from the database
     */
    public function &getNeighbors()
    {
        // Load the data
        if (empty($this->_neighbors)) {
            $query = $this->_buildQuery();
            $this->_db->setQuery($query);
            $this->_neighbors = $this->_db->loadObject();
        }
        d($query, $this->_neighbors);
        return $this->_neighbors;
    }

    /**
     * Method to store a record
     *
     * @access    public
     * @return    boolean    True on success
     */
    public function store()
    {
        $row     = &$this->getTable();
        $dateNow = JFactory::getDate();

        $data = JRequest::get('post');

        if ($data['id']) {
            $data['updated'] = $dateNow->toMySQL();
        }

        if ($data['published']) {
            $data['published'] = 1;
        } else {
            $data['published'] = 0;
        }

        // Bind the form fields to the place table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Make sure the Pvpollingplace record is valid
        if (!$row->check()) {
            //$this->setError($this->_db->getErrorMsg());
            foreach ($row->getErrors() as $msg) {
                $this->setError($msg);
            }
            return false;
        }

        // Store the web link table to the database
        if (!$row->store()) {
            $this->setError($row->getErrorMsg());
            return false;
        }

        return true;
    }

    /**
     * Method to delete record(s)
     *
     * @access    public
     * @return    boolean    True on success
     */
    public function delete()
    {
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');

        $row = &$this->getTable();

        if (count($cids)) {
            foreach ($cids as $cid) {
                if (!$row->delete($cid)) {
                    $this->setError($row->getErrorMsg());
                    return false;
                }
            }
        }
        return true;
    }
}
