<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

  <div class="content">
    <?php print $node->content['og_mission']['#value']; ?>
  </div>

  <?php if ($display_submitted || $terms): ?>
    <div class="meta">
      <?php if ($display_submitted): ?>
        <span class="submitted">
          <?php
            print t('Submitted by !username on !datetime',
              array('!username' => $name, '!datetime' => $date));
          ?>
        </span>
      <?php endif; ?>

      <?php if ($terms): ?>
        <div class="terms terms-inline"><?php print $terms; ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php print $links; ?>
</div> <!-- /.node -->
