<?php 
/*
Plugin Name: Search links
Version: auto
Description: Perform a search with a link, no need to use the search form.
Plugin URI: auto
Author: plg
Author URI: http://le-gall.net/pierrick
*/

/**
 * This is te main file of the plugin, called by Piwigo in "include/common.inc.php" line 137.
 * At this point of the code, Piwigo is not completely initialized, so nothing should be done directly
 * except define constants and event handlers (see http://piwigo.org/doc/doku.php?id=dev:plugins)
 */

defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');

// +-----------------------------------------------------------------------+
// | Add event handlers                                                    |
// +-----------------------------------------------------------------------+

add_event_handler('init', 'search_links_init_fake_search');

function search_links_init_fake_search()
{
  global $conf;

  // search.php?mindate=2011-01-15&maxdate=2011-01-31&album=23
  //
  // what does search.php expects in $_POST ?
  //
  // Array
  // (
  //     [date_type] => date_creation
  //     [start_day] => 4
  //     [start_month] => 1
  //     [start_year] => 2010
  //     [end_day] => 19
  //     [end_month] => 1
  //     [end_year] => 2013
  //     [cat] => Array
  //         (
  //             [0] => 111
  //         )
  //     [subcats-included] => 1
  //     [submit] => Submit
  // )
  
  if (script_basename() != 'search')
  {
    return;
  }

  $is_search_link = false;

/*
  if (isset($_GET['mindate']))
  {
    $mindate_unixtime = strtotime($_GET['mindate']);
    $_POST['start_year'] = date('Y', $mindate_unixtime);
    $_POST['start_month'] = date('m', $mindate_unixtime);
    $_POST['start_day'] = date('d', $mindate_unixtime);

    $_POST['date_type'] = 'date_creation';

    $is_search_link = true;
  }

  if (isset($_GET['maxdate']))
  {
    $maxdate_unixtime = strtotime($_GET['maxdate']);
    $_POST['end_year'] = date('Y', $maxdate_unixtime);
    $_POST['end_month'] = date('m', $maxdate_unixtime);
    $_POST['end_day'] = date('d', $maxdate_unixtime);

    $_POST['date_type'] = 'date_creation';

    $is_search_link = true;
  }
*/
  if (isset($_GET['album']) and is_numeric($_GET['album']))
  {
    $_GET['cat_id'] = $_GET['album'];
  }

  if (isset($_GET['word']))
  {
    $_GET['q'] = $_GET['word'];

/*
    // on which fields?
    $basic_fields = array('file', 'name', 'comment');
    $_POST['fields'] = array();
    if (isset($_GET['fields']))
    {
      $user_fields = array();
      foreach (explode(',', $_GET['fields']) as $field)
      {
        $field = trim($field);
        if (in_array($field, $basic_fields))
        {
          $_POST['fields'][] = $field;
        }
      }

      if (count($_POST['fields']) == 0)
      {
        die("invalid fields");
      }
    }
    elseif (isset($conf['search_links_fields']) and is_array($conf['search_links_fields']))
    {
      foreach ($conf['search_links_fields'] as $field)
      {
        $field = trim($field);
        if (in_array($field, $basic_fields))
        {
          $_POST['fields'][] = $field;
        }
      }
    }
    else
    {
      $_POST['fields'] = $basic_fields;
    }
*/
  }
}

?>