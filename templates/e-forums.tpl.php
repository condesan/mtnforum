
<div id="e-forums">

  <?php

  foreach ($forums as $comm_id => $forum) {
    $comm = node_load($comm_id); ?>
    <h3><?php print $comm->title; ?></h3>
  <?php
    $header = array();
    $rows = array();
    foreach ($forum as $data) {
      $title = l($data->title, 'node/'.$data->nid);
      $description = node_teaser($data->body, NULL, 200);
      $date = date_make_date($data->created, NULL, DATE_UNIX);
      $post_date = date_format_date($date);
      $rows[] = array($title, $description, $post_date);
    }
    print theme('table', $header, $rows);
  }
  ?>

</div>
