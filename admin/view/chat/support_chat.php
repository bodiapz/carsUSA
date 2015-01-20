    <?php if(!empty($chats)) : ?>
            <?php foreach($chats as $chat) : ?>
                <div class="support-chat relative" data-last-id="<?php echo $chat['last_id']; ?>" data-token="<?php echo $chat['token'];?>">
                    <span class="chat-close"></span>
                    <div class="chat-header">Онлайн чат</div>

                    <div class="chat-wrapper is-new-chat">
                        <? echo $chat['chat']; ?>
                    </div>

                    <input type="text" name="chat-message" placeholder="">
                    <span class="fa fa-send chat-send-message"></span>
                </div>
            <?php endforeach; ?>
    <?php endif; ?>
