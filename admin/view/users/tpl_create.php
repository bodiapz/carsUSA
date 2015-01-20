
<div class="form-content col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4">
    <form action="<?php $this->location('user/create'); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Ім'я користувача</label>
            <input type="text" name="username" class="form-control" value="<?php if(!empty($user['title'])) echo $user['username']; ?>">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php if(!empty($user['email'])) echo $user['email']; ?>">
        </div>

        <div class="form-group">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" value="<?php if(!empty($user['password'])) echo $user['password']; ?>">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Зберегти">
        </div>
    </form>
</div>