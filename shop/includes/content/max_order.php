<?php
/* ----------------------------------------------------------------------
   $Id: max_order.php 409 2013-06-11 15:53:40Z r23 $

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2014 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: max_order.php v1.00 2003/04/27 JOHNSON
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2001 - 2003 osCommerce

   Max Order - 2003/04/27 JOHNSON - Copyright (c) 2003 Matti Ressler - mattifinn@optusnet.com.au
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  /** ensure this file is being included by a parent file */
  defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

  require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/info_max_order.php';

  // links breadcrumb
  $oBreadcrumb->add($aLang['navbar_title']);
$sCanonical = oos_href_link($aContents['info_max_order'], '', 'SSL', FALSE, TRUE);
$sPagetitle = $aLang['heading_title'];

  $aTemplate['page'] = $sTheme .  '/system/info.tpl';

  $nPageType = OOS_PAGE_TYPE_MAINPAGE;

  require_once MYOOS_INCLUDE_PATH . '/includes/oos_system.php';
  if (!isset($option)) {
    require_once MYOOS_INCLUDE_PATH . '/includes/info_message.php';
    require_once MYOOS_INCLUDE_PATH . '/includes/oos_blocks.php';
  }

  // assign Smarty variables;
  $smarty->assign(
      array(
          'breadcrumb'    => $oBreadcrumb->trail(BREADCRUMB_SEPARATOR),
          'heading_title' => $aLang['heading_title'],
          'heading_image' => 'contact_us.gif',
            'pagetitle'         => htmlspecialchars($sPagetitle),
            'canonical'         => $sCanonical,
      )
  );

// display the template
$smarty->display($aTemplate['page']);
