<?php
/**
 * PVPollingplaces bootstrap file
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 * @license        GNU/GPL
 */

defined('_JEXEC') or die('Restricted access');

/**
 * @package Philadelphia.Votes
 */

// Uzer
jimport('uzer.Uzer');
Uzer::blok(JFactory::getUser(), 'Administrator');

// pull in the super-groovy debugger
jimport('kint.kint');

$language = JFactory::getLanguage();
$language->load(JRequest::getCmd('option'), JPATH_SITE);

// Require the base controller

require_once JPATH_COMPONENT . DS . 'controller.php';

// Require specific controller if requested
if ($controller = JRequest::getWord('controller', 'places')) {
    $path = JPATH_COMPONENT . DS . 'controllers' . DS . $controller . '.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

// Create the controller
$classname = 'PvpollingplacesController' . ucfirst($controller);

$controller = new $classname();

// Perform the Request task
$controller->execute(JRequest::getVar('task'));

// Redirect if set by the controller
$controller->redirect();
