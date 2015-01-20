<h3 class="text-center">Зміна паролю користувача</h3>

<div class="offset-top-bottom-25"></div>

<form class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4 offset-top25px form-user-edit" action="<?php echo $this->basePath . 'user/change_password/' . $user_id; ?>" method="post">
    <div class="form-group">
        <label>Новий пароль</label>
        <?php if(!empty($error)) : ?>
            <br/><span class="text-danger change-pass-error"><?php echo $error; ?></span><br/>
        <?php endif; ?>
        <input type="password" class="form-control" name="password"/>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary pull-right" value="Зберегти"/>
        <div class="clearfix"></div>
    </div>
</form>