<?php
/* ----------------------------------------------------------------------
   $Id: class_navigation_history.php 296 2013-04-13 14:48:55Z r23 $

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2014 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: navigation_history.php,v 1.5 2003/02/12 21:07:45 hpdl 
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );


/**
 * Class Navigation History
 *
 * @category   MyOOS [Shopsystem]
 * @package    Navigation History
 * @copyright  Copyright (c) 2003 - 2014 by the MyOOS Development Team. (http://www.oos-shop.de/)
 * @license    http://www.gnu.org/licenses/gpl.html GNU General Public License
 */
class oosNavigationHistory
{

     protected $path;
     protected $snapshot;

    /**
     * Constructor of our Class
     */
     public function __construct() {
         $this->reset();
     }


     function reset() {
         $this->path = array();
         $this->snapshot = array();
     }



    function set_snapshot($aSetPage = '') {
        global $sContent, $request_type;

        if (is_array($aSetPage)) {
            $this->snapshot = array('content' => $aSetPage['content'],
                                    'mode' => $aSetPage['mode'],
                                    'get' => $aSetPage['get']);
		} else {
			$get_all = '';
			if (isset($_GET)) {
				$get_all = oos_get_all_get_parameters();
				$get_all = oos_remove_trailing($get_all);
			}
			$this->snapshot = array('content' => $sContent,
									'mode' => $request_type,
									'get' => $get_all);
        }
    }


    function clear_snapshot() {
        $this->snapshot = array();
    }


    function set_path_as_snapshot($history = 0) {
        $pos = (count($this->path)-1-$history);
        $this->snapshot = array('content' => $this->path[$pos]['content'],
                                'mode' => $this->path[$pos]['mode'],
                                'get' => $this->path[$pos]['get']);
    }

}
