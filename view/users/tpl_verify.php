
<div class="col-lg-5 col-md-5 col-lg-offset-3 col-md-offset-3">
    <form action="<?php $this->location('user/verify'); ?>" method="post" enctype="multipart/form-data" >

        <?php if(!empty($error)) : ?>
            <div class="flash-message">
                <span class="text-danger text-center"><?php echo $error; ?></span>
            </div>
        <?php endif;?>

        <div class="form-group">
            <label><?php $this->translate('Код з СМС'); ?></label>
            <input type="text" name="verify" class="form-control" placeholder="Код з СМС">
        </div>

        <div class="form-group">
            <a href="<?php $this->location('user/verify?resend'); ?>" class="btn btn-success pull-left"><?php $this->translate('Переслати код підтвердження'); ?></a>
            <input type="submit" class="btn btn-primary pull-right" value="<?php $this->translate('Підтвердити'); ?>">
            <div class="clearfix"></div>
        </div>

    </form>
</div>