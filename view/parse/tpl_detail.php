<script>var carId = <?php if($carId > 0 ) echo $carId; else echo 0; ?></script>

<div class="row">
    <div class="col-lg-10 col-md-10 col-xs-10">
        <h2 class="dark-blue size24 offset-bottom-25 car-title"><?php $this->print_s($car['fullName']); ?></h2>
    </div>

    <div class="col-lg-2 text-right col-md-2 col-xs-2 favorites">
        <?php include('view/parse/tpl_fav.php'); ?>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="page-name-horizontal"></div>
    </div>
</div>

<div class="col-lg-6 col-md-6 col-xs-12">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <div class="row row-table odd">
                <div class="col-lg-5 col-md-5"><b>Штат:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car_ext['Location'])) echo str_replace('Inspection Services', '', trim(substr($car_ext['Location'], 0, 80))); else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table even">
                <div class="col-lg-5 col-md-5"><b>Одометр:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car['odometer'])) echo $car['odometer']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table odd">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Основні ушкодження'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car_ext['Primary Damage'])) echo $car_ext['Primary Damage']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table even">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Другорядні пошкодження'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car_ext['Secondary Damage']) && strlen(html_entity_decode($car_ext['Secondary Damage'])) > 2) echo trim($car_ext['Secondary Damage']); else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table odd">
                <div class="col-lg-5 col-md-5"><b>№ VIN:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car['vin'])) echo $car['vin']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table even">
                <div class="col-lg-5 col-md-5"><b>Тип кузова:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car['type'])) echo $car['type']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table odd">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Колір'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car['color'])) echo $car['color']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table even">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Двигун'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car['engine'])) echo $car['engine']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table odd">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Привід'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car['wheels'])) echo $car['wheels']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table even">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Циліндрів'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car_ext['Cylinder'])) echo $car_ext['Cylinder']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table odd">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Пальне'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car['fuel'])) echo ($car['fuel'] == 'GAS') ? 'Бензин' : (($car['fuel'] == 'DIESEL') ? 'Дизель' : $car['fuel']); else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table even">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Примітка'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car_ext['Bid Status'])) echo $car_ext['Bid Status']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table odd">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Поточна ставка'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car['price'])) echo $car['price']; else $this->translate('Не вказано'); ?></div>
            </div>
            <div class="row row-table even ">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('До кінця аукціону'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><?php if(!empty($car_ext['Time Left'])) echo $car_ext['Time Left']; else $this->translate('Не вказано'); ?></div>
            </div>

            <div class="row row-table odd red-bg color-white">
                <div class="col-lg-5 col-md-5"><b><?php $this->translate('Lot ID'); ?>:</b></div>
                <div class="col-lg-7 col-md-7"><b><?php if(!empty($car['lotId'])) echo $car['lotId']; else $this->translate('lotId'); ?></b></div>
            </div>

        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 col-xs-12 no-offset-right">
    <ul class="bxslider gallery">
        <?php if(!empty($images)) : ?>
            <?php foreach($images as $image) : ?>
                <?php $badChars = array('.jpg', '.JPG'); ?>
                <?php $goodChars = array('X.jpg', 'X.JPG'); ?>

                <li class="animated fadeInLeftBig"><a data-fancybox-group="group1" href="http://<?php echo str_replace($badChars, $goodChars, $image); ?>"><img src="http://<?php echo str_replace($badChars, $goodChars, $image); ?>"  alt="<?php echo $image; ?>"/></a></li>
            <?php endforeach; ?>
        <?php endif; ?>

    </ul>
    <div id="bx-pager" class="col-lg-12 col-md-12 offset-bottom-2v">

        <?php if(!empty($images)) : $counter = 0; ?>
            <?php foreach($images as $image) : ?>
                <div class="col-lg-4 col-md-4 col-xs-4"><a data-slide-index="<?php echo $counter; ?>" href=""><img src="http://<?php echo $image; ?>" alt="<?php echo $image; ?>"/></a></div>
            <?php $counter++; endforeach; ?>
        <?php endif; ?>

    </div>
</div>
<div class="fancybox"></div>
