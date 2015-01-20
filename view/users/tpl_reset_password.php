<div class="form-login-center">
	<form action="<?php $this->basePath . 'user/newPassword?token=' . $token; ?>" method="post" enctype="multipart/form-data">

		<div class="form-group">
			<label><?php $this->translate('Новий пароль'); ?></label>
			<input  class="form-control" type="email" name="password" value=""/>
		</div>

		<div class="form-group">
			<input  class="btn btn-primary pull-left" type="submit" value="<?php $this->translate('Змінити'); ?>"/>
		</div>

	</form>
</div>