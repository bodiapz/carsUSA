<h3 class="text-center">Edit User <span class="name"><?php if(!empty($user['id'])) echo $user['username']; ?></span></h3>

<div class="offset-top-bottom-25"></div>

<form class="col-lg-6 col-md-6 col-lg-offset-3 form-user-edit" action="<?php echo $this->basePath . 'user/edit/' . $user['id']; ?>" method="post">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?php if(!empty($user['email'])) echo $user['email']; ?>" required/>
    </div>

    <div class="form-group offset-bottom-50">
        <label class="control-label">Birthdate</label>
        <div class="clearfix"></div>
        <select class="form-control col-span-35 select-1 pull-left" name="b_month">
            <option value="1" <?php if($user['b_month'] == '1') : echo 'selected';endif;?>>January</option>
            <option value="2" <?php if($user['b_month'] == '2') : echo 'selected';endif;?>>February</option>
            <option value="3" <?php if($user['b_month'] == '3') : echo 'selected';endif;?>>March</option>
            <option value="4" <?php if($user['b_month'] == '4') : echo 'selected';endif;?>>April</option>
            <option value="5" <?php if($user['b_month'] == '5') : echo 'selected';endif;?>>May</option>
            <option value="6" <?php if($user['b_month'] == '6') : echo 'selected';endif;?>>June</option>
            <option value="7" <?php if($user['b_month'] == '7') : echo 'selected';endif;?>>July</option>
            <option value="8" <?php if($user['b_month'] == '8') : echo 'selected';endif;?>>August</option>
            <option value="9" <?php if($user['b_month'] == '9') : echo 'selected';endif;?>>September</option>
            <option value="10" <?php if($user['b_month'] == '10') : echo 'selected';endif;?>>October</option>
            <option value="11" <?php if($user['b_month'] == '11') : echo 'selected';endif;?>>November</option>
            <option value="12" <?php if($user['b_month'] == '12') : echo 'selected';endif;?>>December</option>
        </select>
        <select class="form-control col-span-25 select-2 pull-left" name="b_day">
            <?php for($value = 1; $value <= 31; $value++) : ?>
                <option value="<?php echo $value;?>" <?php if($user['b_day'] == $value) echo "selected";?>><?php if($value > 0) : echo $value; endif;?></option>
            <?php endfor; ?>
        </select>
        <select class="form-control col-span-30 select-3 pull-left" name="b_year">
            <?php for($value = 1950; $value < 2014; $value++) : ?>
                <option value="<?php echo $value;?>" <?php if($user['b_year'] == $value) echo "selected";?>><?php if($value > 0) : echo $value; endif;?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="gender">Gender</label>
        <div class="clearfix"></div>
        <label class="gender"><input type="radio" name="gender" value="m" <?php if($user['gender'] == 'm') : echo 'checked';endif;?>/> Male</label>
        <label class="gender"><input type="radio" name="gender" value="f" <?php if($user['gender'] == 'f') : echo 'checked';endif;?>/> Female</label>
    </div>

    <div class="form-group">
        <label>Nickname</label>
        <input type="text" class="form-control" name="username" value="<?php if(!empty($user['username'])) echo $user['username']; ?>"/>
    </div>

    <div class="form-group">
        <label><input type="checkbox" class="" name="admin" <?php if(!empty($user['admin']) && $user['admin'] == 1) echo 'checked'; ?> value="1"/> Is Admin</label>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Save"/>
    </div>
</form>