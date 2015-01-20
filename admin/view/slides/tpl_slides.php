<div class="col-lg-12 col-md-12">
    <h3>Редактор слайдів</h3>
</div>

<div class="col-lg-12 col-md-12">
    <fieldset class="padding16">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-10 col-md-10">
                        <div id="image"></div>
                        <div id="db-progress" class="progress progress-success width100-progress">
                            <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="0" id="db_bar">
                                <span class="progress-info"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 text-right">
                        <button class="fileupload-trigger btn btn-primary">Завантажити</button>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>


<div class="col-lg-12 col-md-12 slider-container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?php if(!empty($slides)) : ?>
                <?php foreach($slides as $slide) : ?>
                    <div class="slide-wrapper col-lg-3 col-md-3">
                        <a href="<?php $this->location('slider/slide/' . $slide['id']); ?>">
                            <img data-id="<?php echo $slide['id']; ?>" src="<?php echo $this->baseSitePath . 'files/slides/' . $slide['file']; ?>" width="200">
                            <div class="delete-slide" data-id="<?php echo $slide['id']; ?>"><i class="fa fa-times"></i></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>