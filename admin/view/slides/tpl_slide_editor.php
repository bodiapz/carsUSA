<script>var slideId = <?php echo $slides[0]['id']; ?>;</script>
<link type="text/css" rel="stylesheet" href="<?php $this->location('assets/css/simpleSlider.css'); ?>">



<div class="row">
    <div class="col-lg-12">
        <button class="center-block slider-editor-add-label btn btn-primary"><i class="fa fa-plus-square"></i> &nbsp;Додати Текст</button>
    </div>

    <div class="slide-editor-wrapper col-lg-12">
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
                     data-controls-type="none"
                     data-arrows="true"
                    >

                    <?php foreach($slides as $slide) : ?>
                        <div class="slide" data-img="<?php echo $this->baseSitePath; ?>/files/slides/<?php $this->print_s($slide['file']); ?>">

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
    </div>
    
    <div class="row"><div class="col-lg-12 slider-settings"></div></div>

    <div class="col-lg-12 slide-labels">
        <?php if(!empty($texts)) : ?>
            <?php foreach($texts as $data) : ?>
                <?php include('view/slides/tpl_slide_label_edit.php'); ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>







