
<?php if(isset($this->user)) : ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <a class="col-lg-12 col-md-12 col-xs-12 btn btn-success disable-radius" href="<?php $this->location('user/account'); ?>"> <i class="fa fa-star-o"></i> <?php $this->translate('Мої автомобілі'); ?></a>
        </div>
    </div>
    <div class="row-offset-separator"></div>
<?php endif; ?>


<div class="row text-center">
    <div class="filter-widget">
        <form action="<?php $this->location('search'); ?>" enctype="multipart/form-data" method="post">

            <div class="form-group col-lg-12 col-md-12">
                <label class="control-label"><?php $this->translate('Тип транспорту'); ?></label>
                <select name="categories" class="form-control disable-radius">
                    <?php if(!empty($categories)) : ?>
                        <?php foreach($categories as $category) : ?>
                            <?php echo '<option value="'. $category['id'] .'">' . $category[$this->prefix . 'name'] . '</option>'; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group col-lg-12 col-md-12">
                <label class="control-label"><?php $this->translate('Марка'); ?></label>
                <select name="brands" class="form-control disable-radius">
                    <option value=""><?php $this->translate('Будь-який'); ?></option>
                    <?php if(!empty($brands)) : ?>
                        <?php foreach($brands as $brand) : ?>
                            <?php echo '<option  data-key="'. $brand['id'] .'" value="' . $this->copartManuf($brand['name']) .  '">' . $brand['name'] . '</option>'; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group col-lg-12 col-md-12">
                <label class="control-label"><?php $this->translate('Модель'); ?></label>
                <select name="models" class="form-control disable-radius">
                    <option value=""><?php $this->translate('Будь-яка'); ?></option>
                </select>
            </div>

            <div>
                <div class="col-lg-12 col-md-12">
                    <label class="control-label"><?php $this->translate('Рік'); ?></label>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-xs-6">
                    <select name="year_from" class="form-control disable-radius">
                        <option><?php $this->translate('Від'); ?></option>
                        <?php for($year = 1960; $year <= 2016; $year++) : ?>
                            <option <?php if($year == date('Y') - 10) echo "selected";?> value="<?php echo $year;?>"><?php echo $year;?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-xs-6">
                    <select name="year_to" class="form-control disable-radius">
                        <option><?php $this->translate('До'); ?></option>
                        <?php for($year = 1960; $year <= 2016; $year++) : ?>
                            <option <?php if($year == date('Y') + 1) echo "selected";?> value="<?php echo $year;?>"><?php echo $year;?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <span class="clearfix"></span>

            <div class="form-group col-lg-12 col-md-12 col-xs-12">
                <input type="submit" class="btn btn-primary col-lg-12 col-md-12 col-xs-12 disable-radius" value="<?php $this->translate($this->langVars['Пошук']); ?>">
            </div>
        </form>
    </div>
</div>

<div class="row-offset-separator md-separator-1"></div>


<?php  if(!empty($this->lastSearch)) : ?>
    <div class="popular-widget <?php if(empty($this->user)) echo 'no-user'; else echo 'is-user'; ?>">
        <div class="no-padding">
            <span class="title color bold"><?php $this->translate('Популярне'); ?></span>
        </div>

        <div class="hero-feature">
            <div class="thumbnail text-center relative">
                <a href="<?php $this->location('search/page/' . $this->lastSearch['lotId']); ?>" class="link-p block wh100">
                    <img src="<?php $this->print_s(str_replace('.JPG', 'X.JPG', $this->lastSearch['images'])); ?>" alt="last search">

                <div class="caption prod-caption">

                    <!--<a href="<?php echo $this->location('search/page/' . $this->lastSearch['lotId']); ?>" class="label label-primary popular-button">$ <?php echo filter_var($this->lastSearch['price'], FILTER_SANITIZE_NUMBER_FLOAT); ?> USD</a>-->
                </div>
                <span class="car-caption-wrapper">
                    <span class="offset-bottom-168"><?php $this->print_s($this->lastSearch['fullName']); ?></span>
                </span></a>
            </div>
        </div>
    </div>

<?php elseif(empty($this->lastSearch) && !empty($this->randomCars)) : $rand = rand(0, count($this->randomCars) - 1); ?>
    <?php //echo "<pre>";print_r($this->randomCars);?>
    <div class="popular-widget <?php if(empty($this->user)) echo 'no-user'; else echo 'is-user'; ?>">
        <div class="no-padding">
            <span class="title color bold"><?php $this->translate('Популярне'); ?></span>
        </div>

        <div class="hero-feature">
            <div class="thumbnail text-center relative">
                <a href="<?php echo $this->location('search/page/' . $this->randomCars[$rand]['lotId']); ?>" class="link-p">
                    <img src="<?php $this->print_s(str_replace('.JPG', 'X.JPG', $this->randomCars[$rand]['images'])); ?>" alt="last search">
                    <span class="caption-popup"><?php echo $this->randomCars[$rand]['fullName']; ?></span>
                </a>
                <div class="caption prod-caption">
                    <a href="<?php echo $this->location('search/page/' . $this->randomCars[$rand]['lotId']); ?>" class="label label-primary popular-button">$ <?php echo filter_var($this->randomCars[$rand]['price'], FILTER_SANITIZE_NUMBER_FLOAT); ?> USD</a>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
