<div class="col-lg-12 col-md-12">
    <h1 class="page-name"><?php $this->translate('Реєстрація'); ?></h1>
    <div class="page-name-horizontal"></div>
</div>

<form id="registration" action="<?php $this->location('user/signup') ?>" method="post" enctype="multipart/form-data">
    <div class="col-lg-12 col-md-12">
        <?php if(!empty($errors)) : ?>
            <div class="flash-message">
                <?php foreach($errors as $error) : ?>
                    <span class="text-danger text-center"><?php echo $error; ?></span><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($thanks)) : ?>
            <div class="flash-message">
                <span class="text-info text-center"><?php echo $thanks; ?></span>
            </div>
        <?php else : ?>

            <div class="form-group">
                <input required="" type="text" name="first_name" class="form-control" placeholder="Ім'я" data-toggle="tooltip" data-placement="right" title="Вкажіть Ваше Ім'я">
            </div>

            <div class="form-group">
                <input required="" type="email" name="email" class="form-control" placeholder="Email"  data-toggle="tooltip" data-placement="right" title="Вкажіть Ваш E-mail">
            </div>

            <div class="form-group">
                <input required="" type="password" name="password" class="form-control" placeholder="Пароль"  data-toggle="tooltip" data-placement="right" title="Вкажіть пароль не менше 6 символів">
            </div>

            <div class="form-group">
                <input required="" type="tel" name="phone" class="form-control" placeholder="Телефон">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary pull-right" value="Реєстрація">
                <div class="clearfix"></div>
            </div>

        <?php endif; ?>
    </div>
</form>