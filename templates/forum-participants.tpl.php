<div id="forum-participants">
  <?php if (!empty($node->forum_participants)): ?>
    <?php
      foreach ($node->forum_participants as $topic_id => $users) {
        $topic = node_load($topic_id);
      ?>
      <div class="topic-participants">
        <div class="forum-topic-title"><?php print l($topic->title, 'node/'.$topic->nid); ?></div>
        <?php if ($topic): ?>
        <ul>
      <?php
            foreach ($users as $uid => $profile) {
              $name = $profile->field_lastname[0]['value'].' '.$profile->field_firstname[0]['value'];
              if (trim($name) == '') {
                $user = user_load($uid);
                $name = $user->name;
              }
          ?>
              <li><?php print l($name, 'user/'.$uid); ?></li>
      <?php } ?>
        </ul>
        <?php endif; ?>
      </div>
    <?php } ?>
  <?php else: ?>
        <?php print t('There is still participating in this forum'); ?>
  <?php endif; ?>
</div>
