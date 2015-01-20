<?php if(!empty($messages)) : ?>
    <div class="chat-message">
        <?php foreach($messages as $message) : ?>
            <div class="message <? echo ($message['type'] == 0) ? "user-message" : "support-message"; ?>">
                <div class="message"><? echo $message['message']; ?>
                </div>
                <div class="triangle">
                </div>
                <span class="chat-time"><? echo date('h:i:s',strtotime($message['created_at'])); ?></span>
            </div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>
