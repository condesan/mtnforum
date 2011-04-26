
<div id="forum-contents">

  <?php

  if ((in_array($GLOBALS['user']->uid, $node->moderators)) || $node->is_comm_admin): ?>
    <div id="forum-topic-actions">
      <?php print l(t('Add new topic'), 'node/add/forum/'.$node->nid); ?>
    </div>
  <?php endif; ?>

  <div id="forum-topic-list">

    <?php if (!empty($node->forum_contents)): ?>
      <?php
        foreach ($node->forum_contents as $nid => $topic) {
          ?>
          <?php if ($topic->title): ?>
            <div class="forum-topic-title"><?php print l($topic->title, 'node/'.$topic->nid); ?></div>
          <?php endif; ?>
          <?php if ($topic->body): ?>
            <div class="forum-topic-body"><?php print $topic->body; ?></div>
          <?php endif; ?>
          <?php if ($topic->field_topic_publications): ?>
            <div class="forum-topic-publications">
              <h3><?php print t('Publications'); ?></h3>
              <?php
              foreach ($topic->field_topic_publications as $pub_nid) {
                $pub = node_load($pub_nid);?>
                <div class="topic-publication">
                  <?php print l($pub->title, 'node/'.$pub->nid); ?>
                </div>
              <?php } ?>
            </div>
          <?php endif; ?>
      <?php } ?>
    <?php else: ?>
          <?php print t('There is still no content in this forum'); ?>
    <?php endif; ?>




  </div>

</div>

