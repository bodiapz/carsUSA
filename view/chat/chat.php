<?php if(empty($messages)) : ?>
<div class="logo-chat">
</div>
<?php endif; ?>
<? if(!empty($messages)) : ?>
    <div class="chat-message">
        <? foreach($messages as $message) : ?>
            <div class="message <? echo ($message['type'] == 0) ? "user-message" : "support-message"; ?>">
                <div class="message"><? echo $message['message']; ?>
                </div>
                <div class="triangle">
                </div>
                <span class="chat-time"><? echo date('h:i:s',strtotime($message['created_at'])); ?></span>
            </div>

        <? endforeach; ?>
    </div>
<? endif; ?>

<? if(!empty($last_id)) : ?>
    <input type="hidden" name="last_id" id="last_id" value="<? echo $last_id['id']; ?>">
<? endif; ?>
<span class="fa fa-send chat-send-message"></span>