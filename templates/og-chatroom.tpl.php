<?php
// $Id:
?>
<div id="og-classroom">

  <?php if ($chats->content['open_chats']): ?>
    <div id="og-open-chats">
      <?php print $chats->content['open_chats']['title']['#value']; ?>
      <?php print $chats->content['open_chats']['table']['#value']; ?>
    </div>
  <?php else: ?>
    <div id="og-open-chats">
      <?php print t('There are no open chats in this group'); ?>
    </div>
  <?php endif; ?>

  <?php if ($chats->content['archived_chats']): ?>
    <div id="og-archived-chats">
        <?php print $chats->content['archived_chats']['header']['#value']; ?>
        <?php print $chats->content['archived_chats']['table']['#value']; ?>
    </div>
  <?php endif; ?>

  <?php if ($chats->content['add_chat']): ?>
    <div id="og-add-chat">
      <?php print $chats->content['add_chat']['#value']; ?>
    </div>
  <?php endif; ?>

</div>
