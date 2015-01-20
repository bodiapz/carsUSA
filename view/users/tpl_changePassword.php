<div class="form-login-center">

    <form class="col-lg-12 form-login" method="post" action="" autocomplete="off">
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
            <input class="form-control" type="password" name="oldpassword" id="password" placeholder="<?php $this->translate('Старий пароль'); ?>">
        </div>
		
        <div class="form-group">
            <input class="form-control" type="password" name="password" id="password" placeholder="<?php $this->translate('Новий пароль'); ?>">
        </div>

        <div class="form-group">
            <input class="btn btn-primary pull-left" type="submit" name="submit" value="<?php $this->translate('Змінити'); ?>">
        </div>

    </form>
</div>