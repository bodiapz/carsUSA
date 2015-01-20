<div class="form-login-center">
    <form class="col-lg-12 form-login" method="post" action="<?php echo $this->basePath . 'user/forgot_password';?>" autocomplete="off">
        <?php if(!empty($error)) : ?>
            <div class="flash-message">
                <span class="text-danger text-center"><?php echo $error;?></span>
            </div>
        <?php endif;?>

        <?php if(!empty($thanks)) : ?>
            <div class="flash-message">
                <span class="text-info text-center"><?php echo $thanks;?></span>
            </div>
        <?php endif;?>

        <div class="form-group">
            <input class="form-control" type="email" name="email" id="email" placeholder="<?php $this->translate('Введіть Ваш Email'); ?>" value="<?php if(!empty($data['userName'])) : echo $data['userName']; endif;?>">
        </div>

        <div class="form-group">
            <input class="btn btn-primary pull-left" type="submit" name="submit" value="<?php $this->translate('Надіслати'); ?>">
        </div>
    </form>
</div>