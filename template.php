<?php
// $Id: template.php,v 1.21 2009/08/12 04:25:15 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to mkht_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: mkht_breadcrumb()
 *
 *   where mkht is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Implementation of HOOK_theme().
 */
function mkht_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function mkht_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/**function mkht_preprocess_page(&$vars, $hook) {
  watchdog('mkht', var_export($vars['primary_links'], TRUE));
}*/

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
 /**
function mkht_preprocess_node(&$vars, $hook) {
  watchdog('mkht', var_export($vars['primary_links'], TRUE));

  // Optionally, run node-type-specific preprocess functions, like
  // mkht_preprocess_node_page() or mkht_preprocess_node_story().
  /*$function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}*/

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function mkht_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function mkht_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override theme_filefield_file to open PDF documents in a new window
 */
function mkht_filefield_file($file) {
  // Views may call this function with a NULL value, return an empty string.
  if (empty($file['fid'])) {
    return '';
  }

  $path = $file['filepath'];
  $url = file_create_url($path);
  $icon = theme('filefield_icon', $file);

  // Set options as per anchor format described at
  $options = array(
    'attributes' => array(
      'type' => $file['filemime'] . '; length=' . $file['filesize'],
    ),
  );

  // Use the description as the link text if available.
  if (empty($file['data']['description'])) {
    $link_text = $file['filename'];
  }
  else {
    $link_text = $file['data']['description'];
    $options['attributes']['title'] = $file['filename'];
  }

  //open files of particular mime types in new window
  $new_window_mimetypes = array(
    'application/pdf',
    'text/plain'
  );
  if (in_array($file['filemime'], $new_window_mimetypes)) {
    $options['attributes']['target'] = '_blank';
  }

  return '<div class="filefield-file clear-block">'. $icon . l($link_text, $url, $options) .'</div>';
}

function mkht_imagefield_formatter_image_plain($element) {
  $node = $element['#node'];
  if ($node->type == 'profile') {
    $sex = $node->field_sex[0]['value'];
    if ($sex == 2) { // Feminine
      $img_default = $node->field_profile_picture[0]['default'];
      if ($img_default) {
        $element['#item']['filepath'] = '/imagefield_default_images/girl.jpg';
        $element['#item']['filename'] = 'girl.jpg';
      }
    }
  }
  // Inside a view $element may contain null data. In that case, just return.
  if (empty($element['#item']['fid'])) {
    return '';
  }

  $field = content_fields($element['#field_name']);
  $item = $element['#item'];

  $item['data']['alt'] = isset($item['data']['alt']) ? $item['data']['alt'] : '';
  $item['data']['title'] = isset($item['data']['title']) ? $item['data']['title'] : NULL;

  $class = 'imagefield imagefield-'. $field['field_name'];
  return  theme('imagefield_image', $item, $item['data']['alt'], $item['data']['title'], array('class' => $class));
}



function mkht_preprocess_views_view_fields(&$vars) {
  global $base_url, $language;
  $view = $vars['view'];
  if ($view->name == 'users') {
    $sex = $vars['row']->node_data_field_profile_picture_field_sex_value;
    $picture_fid = $vars['row']->node_data_field_profile_picture_field_profile_picture_fid;
    $nid = $vars['row']->nid;
    if (!$picture_fid && $sex == 2) {
      $pic_female_url = drupal_get_path('theme', 'mkht').'/images/girl.jpg';
      $img = theme('imagecache', 'profile_picture_block', $pic_female_url, '', '');
      $href = '/'.$language->language.'/node/'.$nid;
      $vars['fields']['field_profile_picture_fid']->content = '<a href="'.$href.'">'.$img.'</a>';
    }    
  }
}
 
function mkht_preprocess_page(&$vars) {
/*
 if ($vars['node']->type != "") {
    $vars['template_files'][] = "page-node-" . $vars['node']->type;
  }
*/

  if (arg(0) == 'node' && arg(2) == 'og' && (arg(3) == 'forums' || arg(3) == 'chat' || arg(3) == 'document' || arg(3) == 'announcement' || arg(3) == 'job')) {
    $node = node_load(arg(1));
    $vars['title'] = '';
  }
  else if (arg(0) == 'node') {
    $node = node_load(arg(1));
    if ($node->type == 'forums' || $node->type == 'community' || (arg(1) == 'add' && arg(2) == 'forum') || $node->type == 'campaign') {
      $vars['title'] = '';
    }
  }

}

function mkht_breadcrumb($breadcrumb) {
  $sep = ' &gt; ';
  $output = '';
  if (arg(0) == 'node' && is_numeric(arg(1))) {
      $node = node_load(arg(1));      
      switch ($node->type) {
        case 'forums':
        case 'forum':
          $breadcrumb = array();
          if ($node->type == 'forum') {
            $forum_id = db_result(db_query('SELECT nid FROM {term_node} WHERE tid = (SELECT f.tid FROM {forum} f WHERE f.nid=%d)', $node->nid));
            $forum = node_load($forum_id);
            $topic = $node;
          }
          else {
            $forum = $node;
          }
          $node_groups = og_get_node_groups($forum);
          if ($node_groups) {
            foreach ($node_groups as $gid => $og_title) {
              $group = node_load($gid);
              if ($group->type == 'community') {
                $gid_comm = $gid;
                $title_comm = $group->title;
                break;
              }
            }            
          }
          if ($forum) {
            $breadcrumb[] = l($title_comm, 'node/'.$gid_comm);
            $breadcrumb[] = l(t('Forums'), 'node/'.$gid_comm.'/og/forums');
            $breadcrumb[] = l($forum->title, 'node/'.$forum->nid);
          }
          if ($topic) {
            $breadcrumb[] = l($topic->title, 'node/'.$topic->nid);
          }
          break;
        case 'chat':
          $breadcrumb = array();
          $room = chatroom_chat_load($node);
          $crid = $room->chat->crid;
          $comm = node_load($crid);
          $breadcrumb[] = l(t('Communities'), 'communities');
          $breadcrumb[] = l($comm->title, 'node/'.$comm->nid);
          $breadcrumb[] = l(t('Chats'), 'node/'.$comm->nid.'/og/chat');
          $breadcrumb[] = l($node->title, 'node/'.$node->nid);
          break;
        case 'announcement':
        case 'job':
          $breadcrumb = array();
          $node_groups = og_get_node_groups($node);
          if ($node_groups) {
            foreach ($node_groups as $gid => $og_title) {
              $group = node_load($gid);
              if ($group->type == 'community') {
                $gid_comm = $gid;
                $title_comm = $group->title;
                $group_name = t('Communities');
                $group_path = 'communities';
                break;
              }
              else if ($group->type == 'campaign') {
                $gid_comm = $gid;
                $title_comm = $group->title;
                $group_name = t('Campaigns');
                $group_path = 'ecampaigns';
                break;
              }
            }
            $breadcrumb[] = l($group_name, $group_path);
            $breadcrumb[] = l($title_comm, 'node/'.$gid_comm);
            if ($node->type == 'announcement') {
              if ($group_path == 'communities') {
                $breadcrumb[] = l(t('Announcements'), 'node/'.$gid_comm.'/og/announcement');
              }
              else {
                $breadcrumb[] = l(t('Announcements'), 'node/'.$gid_comm.'/announcement');
              }
            }
            else {
              $breadcrumb[] = l(t('Jobs'), 'node/'.$gid_comm.'/og/job');
            }
            $breadcrumb[] = l($node->title, 'node/'.$node->nid);
          }
          break;
        case 'community':
          $breadcrumb = array();
          $breadcrumb[] = l(t('Communities'), 'communities');
          $breadcrumb[] = l($node->title, 'node/'.$node->nid);
          if (arg(2) == 'og' ) {
            if (arg(3)) {
                $breadcrumb[] = l(arg(3), 'node/'.$node->nid.'/og/'.arg(3));
            }
          }
          break;
        case 'campaign':
          $breadcrumb = array();
          $breadcrumb[] = l(t('Campaigns'), 'ecampaigns');
          $breadcrumb[] = l($node->title, 'node/'.$node->nid);
          break;
      }
  }
  else if (arg(0) == 'node' && arg(1) == 'add' && arg(3) == 'og') {    
    $breadcrumb = array();
    $type = arg(2);
    $group = node_load(arg(4));    
    $breadcrumb[] = l(t('Communities'), 'communities');
    $breadcrumb[] = l($group->title, 'node/'.$group->nid);
    $breadcrumb[] = l($type, 'node/'.$group->nid.'/og/'.$type);
  }
  else if (arg(0) == 'comment') {
    $breadcrumb = array();
    if (arg(1) == 'reply') {
      $node = node_load(arg(2));
    }
    else if (arg(1) == 'edit') {
      $cid = arg(2);
      $nid = db_result(db_query('SELECT nid FROM {comments} WHERE cid = %d', $cid));
      $node = node_load($nid);
    }

    if (isset($node) && $node->type == 'forum') {
      $topic = $node;
      $forum = mkh_get_forum_by_topic($node->nid);
      $node_groups = og_get_node_groups($forum);
      if ($node_groups) {
        foreach ($node_groups as $gid => $og_title) {
          $group = node_load($gid);
          if ($group->type == 'community') {
            $gid_comm = $gid;
            $title_comm = $group->title;
            break;
          }
        }
      }
      $breadcrumb[] = l($title_comm, 'node/'.$gid_comm);
      $breadcrumb[] = l(t('Forums'), 'node/'.$gid_comm.'/og/forums');
      $breadcrumb[] = l($forum->title, 'node/'.$forum->nid);
      $breadcrumb[] = l($topic->title, 'node/'.$topic->nid);
    }
  }

  if ($breadcrumb) {
    $output  = '<div class="breadcrumb">'.implode($breadcrumb, $sep) . $sep.'</div>';
  }

  return $output;

}



