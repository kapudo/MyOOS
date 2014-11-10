<?php
/* ----------------------------------------------------------------------
   $Id: function_block.php,v 1.1 2007/06/08 14:02:48 r23 Exp $

   OOS [OSIS Online Shop]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2007 by the OOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  /** ensure this file is being included by a parent file */
  defined( 'OOS_VALID_MOD' ) or die( 'Direct Access to this location is not allowed.' );


 /**
  * Content Block
  *
  * @link http://www.oos-shop.de/
  * @package Content Block
  * @author r23 <info@r23.de>
  * @copyright 2003 r23
  * @version $Revision: 1.1 $ - changed by $Author: r23 $ on $Date: 2007/06/08 14:02:48 $
  */

 /**
  * Return Block Side (left right)
  *
  * @param $block_id
  * @param $language
  * @return string
  */
  function oos_block_select_option($select_array, $key_value) {
    for ($i = 0, $n = count($select_array); $i < $n; $i++) {
      $name = 'block_side';
      $string .= '<br /><input type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';
      if ($key_value == $select_array[$i]) $string .= ' CHECKED';
      $string .= '> ' . $select_array[$i];
    }
    return $string;
  }

 /**
  * Return Block Name
  *
  * @param $block_id
  * @param $language
  * @return string
  */
  function oos_get_block_name($block_id, $lang_id = '') {

    if (!$lang_id) $lang_id = $_SESSION['language_id'];

    // Get database information
    $dbconn =& oosDBGetConn();
    $oostable =& oosDBGetTables();

    $block_infotable = $oostable['block_info'];
    $query = "SELECT block_name
              FROM " . $block_infotable . "
              WHERE block_id = '" . $block_id . "'
                AND block_languages_id = '" . intval($lang_id) . "'";
    $result =& $dbconn->Execute($query);

    $block_name = $result->fields['block_name'];

    // Close result set
    $result->Close();

    return $block_name;
  }

 /**
  * Return Block To Page
  *
  * @param $block_id
  * @param $language
  * @return string
  */
  function oos_show_block_to_page($block_id = '', $lang_id = '') {

    $select_page_type = '';
    if (oos_is_not_null($block_id)) {
      if (!$lang_id) $lang_id = $_SESSION['language_id'];
      $type_array = array();

      // Get database information
      $dbconn =& oosDBGetConn();
      $oostable =& oosDBGetTables();

      $page_typetable = $oostable['page_type'];
      $query = "SELECT page_type_id, page_type_name
                FROM " . $page_typetable . "
                WHERE page_type_languages_id = '" . intval($lang_id) . "'";
      $type_result =& $dbconn->Execute($query);

      while ($type = $type_result->fields) {
        $type_array[] = array('id' => $type['page_type_id'],
                              'text' => $type['page_type_name']);

        // Move that ADOdb pointer!
        $type_result->MoveNext();
      }

      // Close result set
      $type_result->Close();

      $block_to_page_array = array();

      $block_to_page_typetable = $oostable['block_to_page_type'];
      $query = "SELECT block_id, page_type_id 
                FROM " . $block_to_page_typetable . "
                WHERE block_id = '" . $block_id . "'";
      $block_to_page_result =& $dbconn->Execute($query);

      while ($block_to_page = $block_to_page_result->fields) {
        $block_to_page_array[] = $block_to_page['page_type_id'];

        // Move that ADOdb pointer!
        $block_to_page_result->MoveNext();
      }

      // Close result set
      $block_to_page_result->Close();

      for ($i = 0, $n = count($type_array); $i < $n; $i++) {
        $page = $type_array[$i]['id'];

        if (in_array ($page, $block_to_page_array)) {
          $select_page_type .= oos_draw_checkbox_field('page_type[]', $page, true) . $type_array[$i][text] . '<br />';
        } else {
          $select_page_type .= oos_draw_checkbox_field('page_type[]', $page) . $type_array[$i][text] . '<br />';
        }
      }

    }
    return $select_page_type;
  }

 /**
  * Return Select Block To Page
  *
  * @param $block_id
  * @param $language
  * @return string
  */
  function oos_select_block_to_page($lang_id = '') {

    $select_page_type = '';
    if (!$lang_id) $lang_id = $_SESSION['language_id'];

    // Get database information
    $dbconn =& oosDBGetConn();
    $oostable =& oosDBGetTables();

    $page_typetable = $oostable['page_type'];
    $query = "SELECT page_type_id, page_type_name
              FROM " . $page_typetable . "
              WHERE page_type_languages_id = '" . intval($lang_id) . "'";
    $result =& $dbconn->Execute($query);

    while ($type = $result->fields) {
      $select_page_type .= oos_draw_checkbox_field('page_type[]', $type['page_type_id']) . $type['page_type_name'] . '<br />';

      // Move that ADOdb pointer!
      $result->MoveNext();
    }

    // Close result set
    $result->Close();

    return $select_page_type;
  }


 /**
  * Return Info Block To Page
  *
  * @param $block_id
  * @param $language
  * @return string
  */
  function oos_info_block_to_page($block_id = '', $lang_id = '') {

    $info = '';
    if (oos_is_not_null($block_id)) {
     if (!$lang_id) $lang_id = $_SESSION['language_id'];
      $type_array = array();

      // Get database information
      $dbconn =& oosDBGetConn();
      $oostable =& oosDBGetTables();

      $block_to_page_typetable = $oostable['block_to_page_type'];
      $page_typetable = $oostable['page_type'];
      $query = "SELECT b2p.block_id, b2p.page_type_id, p.page_type_name
                FROM " . $block_to_page_typetable . " b2p,
                     " . $page_typetable . " p
                WHERE b2p.block_id = '" . (int)$block_id . "'
                  AND p.page_type_id = b2p.page_type_id
                  AND p.page_type_languages_id = '" . intval($lang_id) . "'";
      $result =& $dbconn->Execute($query);

      while ($block_info =  $result->fields) {
        $info .= $block_info['page_type_name']. '<br />';

        // Move that ADOdb pointer!
        $result->MoveNext();
      }
    }

    // Close result set
    $result->Close();

    return $info;
  }

?>