<div class="modal fade" id="loginModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-content-width100">
			<form action="<?php $this->location('user/login'); ?>" method="post" enctype="multipart/form-data">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title"><?php $this->translate('Вхід'); ?></h4>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="E-mail">
					</div>

					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Пароль">
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right" value="<?php $this->translate('Увійти'); ?>">
                        <a class="pull-right forgot-pass-link-modal" href="<?php $this->location('user/forgot_password'); ?>"> <i class="fa fa-lock"></i> <?php $this->translate('Забули пароль'); ?></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>