<div class="col-lg-12 col-md-12">
    <form action="<?php $this->location('user/contact'); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label><?php $this->translate("Ім'я"); ?></label>
            <input type="text" name="name" class="form-control"/>
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control"/>
        </div>

        <div class="form-group">
            <label><?php $this->translate('Повідомлення'); ?></label>
            <textarea name="message" class="form-control textarea-max-width"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary pull-right" value="<?php $this->translate('Надіслати'); ?>"/>
            <div class="clearfix"></div>
        </div>
    </form>
</div>