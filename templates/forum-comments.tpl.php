<div id="forum-comments">
  <div id="forum-topic-comments-list">
    <?php
      if ($node->forum_contents) {
        foreach ($node->forum_contents as $nid => $topic) {
          ?>
          <?php if ($topic->title): ?>
            <div class="forum-topic-comment-title"><h2><?php print l($topic->title, 'node/'.$topic->nid); ?></h2></div>
          <?php endif; ?>
          <?php if ($topic->body): ?>
            <div class="forum-topic-comment-body"><?php print $topic->body; ?></div>
          <?php endif; ?>
          <?php if ($topic): ?>
          <div class="forum-topic-comments">
            <a href="javascript:void(0);" class="link-comment" style="font-size: 10pt;"><em>--&nbsp;<?php print t('Comments'); ?>&nbsp;--</em></a>
            <div class="comments-content">
              <a name="topic-<?php print $topic->nid; ?>"></a>

              <?php  
                $dest = drupal_get_destination();
                if ($GLOBALS['user']->uid == 0) {
                  print t('<a href="@login">Login</a> or <a href="@register">register</a> to post comments', array('@login' => url('user/login', array('query' => $dest)), '@register' => url('user/register', array('query' => $dest))));
                }
                else {                  
                  $comm_id = mkh_get_og_community_id();
                  $comm = node_load($comm_id);
                  $is_comm_member = og_is_group_member($comm_id, TRUE, $GLOBALS['user']->uid);                  
                  if (!$is_comm_member) {
                    print t('You are not member of the group !comm . Consider <a href="!url">joining this group</a> to post comments.', array('!comm'=>$comm->title, '!url' => url("og/subscribe/$comm_id", array('query' => $dest))));
                  }
                  else { ?>
                    <div class="comment_add"><?php print l(t('Add new comment'), 'comment/reply/'.$nid, array('fragment' => 'comment-form'));?></div>
            <?php }              
                }
              ?>
              <?php print comment_render($topic); ?>
            </div>
          </div>
          <?php endif; ?>
    <?php }
        }
        else {
          print t('There is still comments in this forum');
        }
    ?>
  </div>
</div>

