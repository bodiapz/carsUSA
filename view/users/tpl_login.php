<div class="col-lg-12 col-md-12">
    <h1 class="page-name"><?php $this->translate('Вхід'); ?></h1>
    <div class="page-name-horizontal"></div>
</div>

<div class="col-lg-5 col-md-5 col-lg-offset-3 col-md-offset-3">
    <form action="<?php $this->location('user/login'); ?>" method="post" enctype="multipart/form-data" >

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
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if(!empty($data['email'])) : echo $data['email']; endif; ?>">
        </div>

        <div class="form-group">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" placeholder="Пароль" value="<?php if(!empty($data['password'])) : echo $data['password']; endif; ?>">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary pull-right" value="Вхід">
            <a class="pull-right forgot-pass-link" href="<?php $this->location('user/forgot_password'); ?>"> <i class="fa fa-lock"></i> <?php $this->translate('Забули пароль'); ?></a>
            <div class="clearfix"></div>
        </div>

    </form>
</div>