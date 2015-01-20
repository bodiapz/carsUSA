<? if(!empty($messages)) : ?>
    <div class="chat-message">
        <? foreach($messages as $message) : ?>
            <div class="message <? echo ($message['type'] != 0) ? "user-message" : "support-message"; ?>">
                <div class="message"><? if($message['type'] == 0) : echo $message['message']; else : echo $message['message'];endif; ?>
                </div>
                <div class="triangle">
                </div>
                <span class="chat-time"><? echo date('h:i:s',strtotime($message['created_at'])); ?></span>
            </div>

        <? endforeach; ?>
    </div>
<? endif; ?>
