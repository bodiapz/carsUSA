
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-content-width100">
			<form id="registration" action="<?php $this->location('user/signup') ?>" method="post" enctype="multipart/form-data">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title"><?php $this->translate('Реєстрація');?></h4>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<input required="" type="text" name="first_name" class="form-control" placeholder="<?php $this->translate("Ім'я");?>" data-toggle="tooltip" data-placement="right" title="<?php $this->translate("Вкажіть Ваше Ім'я");?>">
					</div>

					<div class="form-group">
						<input required="" type="email" name="email" class="form-control" placeholder="Email"  data-toggle="tooltip" data-placement="right" title="<?php $this->translate("Вкажіть Ваш E-mail");?>">
					</div>

					<div class="form-group">
						<input required="" type="password" name="password" class="form-control" placeholder="Пароль"  data-toggle="tooltip" data-placement="right" title="<?php $this->translate("Вкажіть пароль не менше 6 символів");?>">
					</div>

					<div class="form-group">
			            <input required="" type="tel" name="phone" class="form-control" placeholder="Телефон">
			        </div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right" value="<?php $this->translate('Реєстрація');?>">
						<div class="clearfix"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
