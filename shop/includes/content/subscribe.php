<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2014 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  /** ensure this file is being included by a parent file */
  defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

  require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/newsletter_subscribe_success.php';

  $origin_href = oos_href_link($aContents['main']);
  $_SESSION['newsletter'] = 1;

  // links breadcrumb
  $oBreadcrumb->add($aLang['navbar_title_1'], oos_href_link($aContents['newsletter']));
  $oBreadcrumb->add($aLang['navbar_title_2']);

  $aTemplate['page'] = $sTheme . '/page/newsletter_subscribe_success.html';

  $nPageType = OOS_PAGE_TYPE_MAINPAGE;

  require_once MYOOS_INCLUDE_PATH . '/includes/system.php';
  if (!isset($option)) {
    require_once MYOOS_INCLUDE_PATH . '/includes/message.php';
    require_once MYOOS_INCLUDE_PATH . '/includes/blocks.php';
  }

  // assign Smarty variables;
  $smarty->assign(
      array(
          'breadcrumb' => $oBreadcrumb->trail(),
          'heading_title' => $aLang['heading_title'],
		  'robots'		=> 'noindex,follow,noodp,noydir'
      )
  );
  $smarty->assign('origin_href', $origin_href);

// display the template
$smarty->display($aTemplate['page']);
