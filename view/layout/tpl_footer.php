<footer>
    	<div class="container">
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4><?php if(isset($this->langVars['Інформація'])) echo $this->langVars['Інформація']; else echo 'Інформація'; ?></h4>
        			<ul>
                        <?php if(!empty($pages)) : ?>
                            <?php foreach($pages as $page) : ?>
                                <li><a href="<?php $this->location('page/view/' . $page['permalink']); ?>"><?php echo $page[$this->prefix . 'title']; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4><?php if(isset($this->langVars['Категорії'])) echo $this->langVars['Категорії']; else echo 'Категорії'; ?></h4>
        			<ul>
                        <?php if(!empty($categories)) : ?>
                            <?php foreach($categories as $category) : ?>
        				        <li><a href="<?php $this->location('search/index/' . $category['permalink']); ?>"><?php echo $category[$this->prefix . 'name']; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4><?php if(isset($this->langVars['Наші послуги'])) echo $this->langVars['Наші послуги']; else echo 'Наші послуги'; ?></h4>
        			<ul>
        				<li><a target="_blank" href="http://www.bank.gov.ua/control/uk/curmetal/detail/currency?period=daily">Курс НБУ: <?php if(!empty($this->currency)) echo $this->currency; ?></a></li>
        				<li><a href="<?php $this->location('page/tariff_map'); ?>"><?php if(isset($this->langVars['Карта тарифів доставки'])) echo $this->langVars['Карта тарифів доставки']; else echo 'Карта тарифів доставки'; ?></a></li>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4><?php if(isset($this->langVars['Ми в соціальних мережах'])) echo $this->langVars['Ми в соціальних мережах']; else echo 'Ми в соціальних мережах'; ?></h4>
                    <div class="connection-wrapper">
                        <?php if(!empty($this->configData['phones'])) : ?>
                            <?php foreach($this->configData['phones'] as $phone) : ?>
                                <a href="callto:<?php $this->print_s($phone); ?>"><i class="fa fa-phone"></i> <?php $this->print_s($phone); ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <br/>
                        <a href="<?php $this->print_s($this->configData['contacts']['email']); ?>"><i class="fa fa-envelope"></i> <?php $this->print_s($this->configData['contacts']['email']); ?></a>
                        <br/>
                        <a href="callto:<?php $this->print_s($this->configData['contacts']['skype']); ?>"><i class="fa fa-skype"></i> <?php $this->print_s($this->configData['contacts']['skype']); ?></a>
                    </div>

                    <br/>

        			<div class="social-wrapper">
                        <a class="ico ico-facebook pull-left" href="<?php $this->print_s($this->configData['contacts']['facebook']); ?>"></a>
                        <a class="ico ico-twitter pull-left" href="<?php $this->print_s($this->configData['contacts']['twitter']); ?>"></a>
                        <a class="ico ico-google pull-left" href="<?php $this->print_s($this->configData['contacts']['googleplus']); ?>"></a>
                    </div>
        		</div>
        	</div>
        </div>
        <div class="text-center copyright">
        	<?php echo 'Copyright &copy; ' . date('Y') . ' CALL2BID. '; ?><?php $this->translate('Всі права захищені'); ?>.
        </div>
    </footer>

    <div class="fancy-box" id="chat" style="width: 322px; height: 300px;">
        <div class="chat none" style="display: block;">
            <div class="chat-wrapper">
                <div class="logo-chat">
                    <span class="chat-logo"></span>
                    <h3>Введіть Ваше запитання</h3>
                </div>
            </div>
            <input type="text" name="chat-message" placeholder="Введіть повідомлення"> <i class="fa fa-level-down"></i>
        </div>
    </div>

    <a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
    	<i class="fa fa-angle-double-up"></i>
    </a>