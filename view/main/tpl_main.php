<?php if(!empty($slides)) : ?>
    <div class="slider-block">
        <div class="slider"
             data-width="inherit"
             data-height="inherit"
             data-effect="fade"
             data-transition-speed="1"
             data-animate-speed="6"
             data-transition-effect="scroll"
             data-controls-position="center bottom"
             data-controls-inline="true"
             data-controls-type="bullets"
             data-arrows="true"
            >

            <?php foreach($slides as $slide) : ?>
                <div class="slide" data-img="files/slides/<?php $this->print_s($slide['file']); ?>">

                    <?php if(!empty($slide['labels'])) : ?>
                        <?php foreach($slide['labels'] as $label) : ?>
                            <div class="slider-label" data-start-from="<?php $this->print_s($label['start_from']); ?>" data-move-to="<?php $this->print_s($label['move_to']); ?>" data-speed="<?php $this->print_s($label['duration']); ?>">
                                <?php $this->print_s($label['text']); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<div class="offset24"></div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <span class="title color bold"><?php $this->translate('Пропозиції'); ?></span>
        <div class="carousel-hotdeals-slider-inner">
            <div id="hot-deals" class="carousel slide hot-deals-carousel" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $randomCars = $this->randomCars; if(!empty($randomCars)) : ?>


                        <?php for($i = 0; $i <= ceil(count($randomCars)/4); $i++) : ?>

                                <div class="item <?php if($i == 0) echo 'active'; ?>">
                                    <div class="row">
                                        <?php for($counter = 0; $counter < 3; $counter++) : ?>
                                            <?php if(!empty($randomCars[$counter + $i * 3])) : ?>
                                                <div class="col-md-4 col-xs-4 col-xs-4">
                                                    <a class="thumbnail relative" href="<?php $this->location('search/page/' . $randomCars[$counter + $i * 3]['lotId']); ?>">

                                                        <img alt="<?php echo $randomCars[$counter + $i * 3]['fullName']; ?>" src="<?php $this->imagesBigger($randomCars[$counter + $i * 3]['images']); ?>">
                                                        <span class="car-caption-wrapper">
                                                            <span><?php echo $randomCars[$counter + $i * 3]['fullName']; ?></span>
                                                        </span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                        <?php endfor; ?>
                    <?php endif; ?>
                </div>

                <ol class="carousel-indicators">
                    <li data-target="#hot-deals" data-slide-to="0" class="active"></li>
                    <li data-target="#hot-deals" data-slide-to="1" class=""></li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>


