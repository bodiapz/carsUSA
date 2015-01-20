<footer>
    	<div class="container">
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4><?php if(isset($this->langVars['Інформація'])) echo $this->langVars['Інформація']; else echo 'Інформація'; ?></h4>
        			<ul>
                        <li><a href="<?php echo $this->basePath; ?>"><?php if(isset($this->langVars['Головна'])) echo $this->langVars['Головна']; else echo 'Головна'; ?></a></li>
        				<li><a href="<?php echo $this->basePath; ?>"><?php if(isset($this->langVars['Про нас'])) echo $this->langVars['Про нас']; else echo 'Про нас'; ?></a></li>
        				<li><a href="<?php echo $this->basePath; ?>"><?php if(isset($this->langVars['Контакти'])) echo $this->langVars['Контакти']; else echo 'Контакти'; ?></a></li>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4><?php if(isset($this->langVars['Категорії'])) echo $this->langVars['Категорії']; else echo 'Категорії'; ?></h4>
        			<ul>
                        <?php if(!empty($categories)) : ?>
                            <?php foreach($categories as $category) : ?>
        				        <li><a href="<?php echo $this->basePath . 'search/index/' . $category['permalink']; ?>"><?php echo $category[$this->prefix . 'name']; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4><?php if(isset($this->langVars['Наші послуги'])) echo $this->langVars['Наші послуги']; else echo 'Наші послуги'; ?></h4>
        			<ul>
        				<li><a href="<?php echo $this->basePath; ?>">Курс USD: 14.650</a></li>
        				<li><a href="<?php echo $this->basePath; ?>"><?php if(isset($this->langVars['Митний калькулятор'])) echo $this->langVars['Митний калькулятор']; else echo 'Митний калькулятор'; ?></a></li>
        				<li><a href="<?php echo $this->basePath; ?>"><?php if(isset($this->langVars['Карта тарифів доставки'])) echo $this->langVars['Карта тарифів доставки']; else echo 'Карта тарифів доставки'; ?></a></li>
        				<li><a href="<?php echo $this->basePath; ?>"><?php if(isset($this->langVars['Розрахунок вартості авто'])) echo $this->langVars['Розрахунок вартості авто']; else echo 'Розрахунок вартості авто'; ?></a></li>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4><?php if(isset($this->langVars['Ми в соціальних мережах'])) echo $this->langVars['Ми в соціальних мережах']; else echo 'Ми в соціальних мережах'; ?></h4>
        			<div class="social-wrapper">
                        <a class="ico ico-facebook pull-left" href="https://www.facebook.com/"></a>
                        <a class="ico ico-twitter pull-left" href="https://twitter.com"></a>
                        <a class="ico ico-google pull-left" href="https://www.google.com.ua/"></a>
                    </div>
        		</div>
        	</div>
        </div>
        <div class="navbar-inverse text-center copyright">
        	<?php if(isset($this->langVars['Copy'])) echo $this->langVars['Copy']; else echo 'Copyright &copy; 2014 CALL2BID. Всі права захищені.'; ?>
        </div>
    </footer>

    <a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
    	<i class="fa fa-angle-double-up"></i>
    </a>