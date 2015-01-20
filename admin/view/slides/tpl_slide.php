<div class="slide-wrapper col-lg-3 col-md-3">
    <a href="<?php $this->location('slider/slide/' . $slide['id']); ?>">
        <img data-id="<?php echo $id; ?>" src="<?php echo $this->baseSitePath . 'files/slides/' . $slide; ?>" width="200">
        <div class="delete-slide" data-id="<?php echo $slide['id']; ?>"><i class="fa fa-times"></i></div>
    </a>
</div>

