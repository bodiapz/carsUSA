<div class="online-chat-wrapper hidden-xs hidden-sm">
    <button type="button" id="online-chat" class="btn-online-chat btn btn-primary chat-open"><?php $this->translate($this->langVars['Онлайн консультація']); ?></button>
    <div class="online-chat-inner">
        <div class="online-chat-head">
            <div class="support"></div>	<h5><?php $this->translate($this->langVars['Онлайн консультація']); ?></h5>
            <div class="clearfix"></div>
        </div>
        <div class="online-chat-body">
            <div class="line">
                <h5>По телефону:</h5>
                <?php if(!empty($this->configData['phones'])) : ?>
                    <?php foreach($this->configData['phones'] as $phone) : ?>
                        <a href="callto:<?php $this->print_s($phone); ?>"><i class="fa fa-phone"></i> <?php $this->print_s($phone); ?></a><br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="line">
                <h5>По E-mail:</h5>
                <a href="mailto:<?php $this->print_s($this->configData['contacts']['email']); ?>"><i class="fa fa-envelope"></i> <?php $this->print_s($this->configData['contacts']['email']); ?></a>
            </div>
            <div class="line">
                <h5>По Skype</h5>
                <a href="callto:<?php $this->print_s($this->configData['contacts']['skype']); ?>"><i class="fa fa-skype"></i> <?php $this->print_s($this->configData['contacts']['skype']); ?></a>
            </div>
            <div class="line">
                <a href="#chat" id="chat_open" class="fancy-open"><i class="fa fa-comments"></i> онлайн чат</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="online-chat-wrapper navbar-chat">
                <div class="online-chat-inner">
                    <div class="online-chat-head">
                        <div class="support"></div>	<h5><?php $this->translate($this->langVars['Онлайн консультація']); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="online-chat-body">
                        <div class="line">
                            <h5>По телефону:</h5>
                            <?php if(!empty($this->configData['phones'])) : ?>
                                <?php foreach($this->configData['phones'] as $phone) : ?>
                                    <a href="callto:<?php $this->print_s($phone); ?>"><i class="fa fa-phone"></i> <?php $this->print_s($phone); ?></a>
                                    <br/>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="line">
                            <h5>По E-mail:</h5>
                            <a href="mailto:<?php $this->print_s($this->configData['contacts']['email']); ?>"><i class="fa fa-envelope"></i> <?php $this->print_s($this->configData['contacts']['email']); ?></a>
                        </div>
                        <div class="line">
                            <h5>По Skype</h5>
                            <a href="callto:<?php $this->print_s($this->configData['contacts']['skype']); ?>"><i class="fa fa-skype"></i> <?php $this->print_s($this->configData['contacts']['skype']); ?></a>
                        </div>
                        <div class="line">
                            <a href="#chat" id="chat_open_" class="fancy-open"><i class="fa fa-comments"></i> онлайн чат</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>