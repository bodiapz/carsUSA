<?php if(isset($this->user['id'])) : ?>
    <?php if(isset($state) && $state == true) : ?>
        <div class="del-from-fav">
            <?php $this->translate('Вибране')?> <i class="fa fa-star"></i>
        </div>
    <?php else : ?>
        <div class="add-to-fav">
            <?php $this->translate('У вибране')?> <i class="fa fa-star-o"></i>
        </div>
    <?php endif; ?>
<?php endif; ?>