<?php include_once('view/widgets/top_content.php'); ?>

<div class="row">
	<div class="popular-widget col-lg-3 col-md-3">
	    <div class="no-padding">
	        <span class="title"><?php if(isset($this->langVars['Популярне'])) echo $this->langVars['Популярне']; else echo 'Популярне'; ?></span>
	    </div>
	    <div class="hero-feature">
	        <div class="thumbnail text-center">
	            <a href="<?php echo $this->basePath; ?>" class="link-p">
	                <img src="<?php echo $this->basePath . 'files/'; ?>2.jpg" alt="">
	            </a>
	            <div class="caption prod-caption">
	                <h4><a href="<?php echo $this->basePath; ?>">2011 BMW 3 SERIES Coupe 2 Doors</a></h4>
	                <p>
	                    </p><div class="btn-group">
	                        <a href="#" class="btn btn-primary btn-sm">$ 122.51</a>
	                    </div>
	                <p></p>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="col-lg-9 col-md-9 col-sm-12">
        <span class="title"><?php if(isset($this->langVars['Гарячі пропозиції'])) echo $this->langVars['Гарячі пропозиції']; else echo 'Гарячі пропозиції'; ?></span>
        <div id="hot-deals" class="carousel slide hot-deals-carousel" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="thumbnail" href="#"><img alt="" src="<?php echo $this->basePath . 'files/'; ?>1.jpg"></a>
                        </div>          
                        <div class="col-md-3">
                            <a class="thumbnail" href="#"><img alt="" src="<?php echo $this->basePath . 'files/'; ?>2.jpg"></a>
                        </div>
                        <div class="col-md-3">
                            <a class="thumbnail" href="#"><img alt="" src="<?php echo $this->basePath . 'files/'; ?>3.jpg"></a>
                        </div> 
                        <div class="col-md-3">
                            <a class="thumbnail" href="#"><img alt="" src="<?php echo $this->basePath . 'files/'; ?>4.jpg"></a>
                        </div>        
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="thumbnail" href="#"><img alt="" src="<?php echo $this->basePath . 'files/'; ?>5.jpg"></a>
                        </div>          
                        <div class="col-md-3">
                            <a class="thumbnail" href="#"><img alt="" src="<?php echo $this->basePath . 'files/'; ?>6.jpg"></a>
                        </div>
                        <div class="col-md-3">
                            <a class="thumbnail" href="#"><img alt="" src="<?php echo $this->basePath . 'files/'; ?>7.jpg"></a>
                        </div>  
                        <div class="col-md-3">
                            <a class="thumbnail" href=""><img alt="" src="<?php echo $this->basePath . 'files/'; ?>8.jpg"></a>
                        </div>        
                    </div>
                </div>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#hot-deals" data-slide-to="0" class="active"></li>
                <li data-target="#hot-deals" data-slide-to="1"></li>
            </ol>
            <!--
            <a data-slide="prev" href="#hot-deals" class="left carousel-control">‹</a>
            <a data-slide="next" href="#hot-deals" class="right carousel-control">›</a>
            -->
        </div>
    </div>
</div>