
<div class="chat none">

	
    <div class="chat-wrapper">
        <? $this->load->view('frontend/templates/chat', array('messages' => $this->messages)); ?>
    </div>

    <input type="text" name="chat-message" placeholder="<?php echo $this->vars['enter_message']?>">
</div>


