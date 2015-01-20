<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php $this->translate('Вибране'); ?></a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php $this->translate('Історія перегляду'); ?></a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><?php $this->translate('Повідомлення'); if($new_count > 0) echo '(' . $new_count . ')';?></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">

            <?php if(!empty($favCars)) : ?>
                <div class="row"><br>
                    <?php foreach($favCars as $userCar) : ?>
                        <div class="col-lg-4 col-md-4">
                            <a class="thumbnail relative user-cars-inner" href="<?php $this->location('search/page/' . $userCar['lotId']) ?>">
                                <img src="<?php $this->imagesBigger($userCar['images']); ?>" alt="<?php echo $userCar['fullName']; ?>"/>

                                <span class="user-cars">
                                    <?php $this->print_s($userCar['fullName'] . $userCar['year']); ?>
                                </span>
                            </a>
                            <span id="ask_price" data-id="<?php echo $userCar['user_cars_id'];?>" data-lotid="<?php echo $userCar['lotId'];?>" data-fullname="<?php echo $userCar['fullName'];?>" class="btn btn-primary col-md-12 margin-bottom20 <?php if($userCar['ask_price'] == 1) echo 'active';?>" ><?php if($userCar['ask_price'] == 1) echo $this->translate('Перевірте повідомлення'); else echo $this->translate('Взнати ціну');?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="row"><br>
                    <div class="col-lg-6 col-md-6">
                        <blockquote>
                            <p><?php $this->translate('Ви ще не додали жодного автомобіля у вибране.'); ?></p>
                        </blockquote>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="profile">

            <?php if(!empty($userCars)) : ?>
                <div class="row"><br>
                    <?php foreach($userCars as $userCar) : ?>
                        <div class="col-lg-4 col-md-4">
                            <a class="thumbnail relative user-cars-inner" href="<?php $this->location('search/page/' . $userCar['lotId']) ?>">
                                <img src="<?php $this->imagesBigger($userCar['images']); ?>" alt="<?php echo $userCar['fullName']; ?>"/>

                                <span class="user-cars">
                                    <?php $this->print_s($userCar['fullName'] . $userCar['year']); ?>
                                </span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="row"><br>
                    <div class="col-lg-6 col-md-6">
                        <blockquote>
                            <p><?php $this->translate('Ви ще не переглянули жодного автомобіля.'); ?></p>
                        </blockquote>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages"><?php echo $messages;?></div>
    </div>

</div>