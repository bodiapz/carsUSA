<div class="login-form-inner offset-top50">
    <form action="<?php $this->location('user/login'); ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <input type="email" name="email" class="form-control" required/>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" required/>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success pull-right" value="Ввійти"/>
            <div class="clearfix"></div>
        </div>

    </form>
</div>