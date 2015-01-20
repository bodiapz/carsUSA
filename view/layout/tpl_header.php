<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 lang-inner">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-xs-6 xs-text-left">
                        <ul class="dropdown-lang-inner relative">
                            <li>
                                <?php if(isset($_SESSION['language']) && $_SESSION['language'] == '' || $_SESSION['language'] == 'ua') : ?>
                                    <span><?php $this->translate($this->langVars['Українська']); ?> </span> <a href="javascript:void(0);" class="ico-lang ico-ua <?php if(isset($_SESSION['language']) && $_SESSION['language'] == '' || $_SESSION['language'] == 'ua') echo 'active'; ?>" title="<?php $this->translate($this->langVars['Українська']); ?>"></a>
                                <?php else : ?>
                                    <span><?php $this->translate($this->langVars['Російська']); ?> </span> <a href="javascript:void(0);" class="ico-lang ico-ru <?php if(isset($_SESSION['language']) && $_SESSION['language'] == 'ru') echo 'active'; ?>" title="<?php $this->translate($this->langVars['Російська']); ?>"></a>
                                <?php endif; ?>

                                <ul class="dropdown-lang">
                                    <?php $uri = explode('&', $_SERVER['REQUEST_URI']); ?>
                                    <li><a href="<?php echo $uri[0];?>&amp;lang=ua" class="ico-lang ico-ua <?php if(isset($_SESSION['language']) && $_SESSION['language'] == '' || $_SESSION['language'] == 'ua') echo 'active'; ?>" title="<?php $this->translate($this->langVars['Українська']); ?>"></a></li>
                                    <li><a href="<?php echo $uri[0];?>&amp;lang=ru" class="ico-lang ico-ru <?php if(isset($_SESSION['language']) && $_SESSION['language'] == 'ru') echo 'active'; ?>" title="<?php $this->translate($this->langVars['Російська']); ?>"></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-2 col-xs-6">
                        <div class="row relative">
                            <?php if(isset($_SESSION['user'])) : ?>
                                <div class="btn-group user-menu-bar">
                                    <a href="<?php echo $this->basePath . 'user/account'; ?>" class="btn-xs slide-down">
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo ucwords($_SESSION['user']['first_name']); ?>
                                    </a>
                                    <div class="dropdownmenu-user">
                                        <ul>
                                            <li><a href="<?php $this->location('user/account'); ?>"><?php $this->translate('Мої автомобілі'); ?></a></li>
                                            <li><a href="<?php $this->location('user/reset_password'); ?>"><?php $this->translate('Змінити пароль'); ?></a></li>
                                        </ul>
                                    </div>
                                    <a href="<?php $this->location('user/logout') ?>" class="btn-xs signout"> <i class="fa fa-sign-out"></i> <?php $this->translate('Вихід'); ?></a>
                                </div>
                            <?php else: ?>
                                <div class="btn-group user-menu-bar">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#registrationModal" class="btn-xs">
                                        <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;<?php $this->translate('Реєстрація'); ?>
                                    </a>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="btn-xs signout"> <i class="fa fa-sign-in"></i> <?php $this->translate('Вхід'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<header>
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-4 col-xs-3 column-xsm-5">
            	<div class="logo-wrapper">
            		<h1 class="text-logo pull-left"><a class="color" href="<?php $this->location(); ?>"><?php echo $this->configData['config']['title']; ?></a></h1><a class="logo pull-left hidden-xs hidden-sm" href="<?php $this->location(); ?>"></a>
            	</div>
            </div>

            <div class="col-lg-2 col-md-2 col-xs-3 well phones-inner column-xsm-5">
                <?php if(!empty($this->configData['phones'])) : ?>
                    <?php foreach($this->configData['phones'] as $phone) : ?>
            	        <div class="width100v height30px phone-inner"><span class="ico-phone icon-phone-2x pull-left"></span> <a href="callto:<?php $this->print_s($phone); ?>" class="pull-left"><?php $this->print_s($phone); ?></a></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-6 column-xsm-12">
            	<div class="well header-search">
                    <form action="<?php $this->location(); ?>">
                        <div class="input-group">
                            <input name="input-search" type="text" class="form-control input-search disable-radius" placeholder="<?php $this->translate('Наприклад'); ?>: Mercedes-Benz G-Class 2003"/>
                            <span class="input-group-btn">
                                <button id="search_car" class="btn btn-default no-border-left disable-radius" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

			<div class="col-lg-2 col-md-2 hidden-xs hidden-sm">
				<div class="row">
					<div class="social-wrapper well">
						<a class="ico ico-google" href="<?php $this->print_s($this->configData['contacts']['googleplus']); ?>"></a>
						<a class="ico ico-twitter" href="<?php $this->print_s($this->configData['contacts']['twitter']); ?>"></a>
						<a class="ico ico-facebook" href="<?php $this->print_s($this->configData['contacts']['facebook']); ?>"></a>
					</div>
				</div>
			</div>

        </div>
    </div>
</header>

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
		<div class="row">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle xs-chat pull-left" data-toggle="modal" data-target="#chatModal">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-headphones"></span> <?php $this->translate('Он-лайн консультація'); ?>
				</button>
				<button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
		</div>
		
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav pull-left"  aria-expanded="true">
                <li><a href="<?php $this->location(); ?>"><?php $this->translate('Головна'); ?></a></li>
                <li><a href="<?php $this->location('page/tariff_map'); ?>"><?php $this->translate('Карта тарифів доставки'); ?></a></li>

                <?php if(!empty($pages)) : ?>
                    <?php foreach($pages as $page) : ?>
                        <li><a href="<?php $this->location('page/view/' . $page['permalink']); ?>"><?php echo $page[$this->prefix . 'title']; ?></a></li>
                    <?php endforeach; ?>
                    
                <?php endif; ?>

            </ul>

            <ul class="nav navbar-nav pull-center hidden-xs">
            	<li><a class="course" target="_blank" href="http://www.bank.gov.ua/control/uk/curmetal/detail/currency?period=daily">Курс НБУ: <?php if(!empty($this->currency)) echo round($this->currency, 4); ?></a></li>
            </ul>


            <div id="clock-ny"></div>


            
            <div class="pull-right dates hidden-md hidden-xs hidden-sm">
            	<div style="margin: 0px 0px 0px; display: inline-block; text-align: center;"><script type="text/javascript" src="http://localtimes.info/world_clock2.php?&amp;cp1_Hex=ffffff&amp;cp2_Hex=FFFFFF&amp;cp3_Hex=000000&amp;fwdt=72&amp;ham=0&amp;hbg=1&amp;hfg=0&amp;sid=0&amp;mon=0&amp;wek=0&amp;wkf=0&amp;sep=0&amp;widget_number=21000&amp;lcid=USCA0638"></script></div>
            	<div style="margin: 0px 0px 0px; display: inline-block; text-align: center;"><script type="text/javascript" src="http://localtimes.info/world_clock2.php?&amp;cp1_Hex=ffffff&amp;cp2_Hex=FFFFFF&amp;cp3_Hex=000000&amp;fwdt=72&amp;ham=0&amp;hbg=1&amp;hfg=0&amp;sid=0&amp;mon=0&amp;wek=0&amp;wkf=0&amp;sep=0&amp;widget_number=21000&amp;lcid=USNY0996"></script></div>
            	<div style="margin: 0px 0px 0px; display: inline-block; text-align: center;"><script type="text/javascript" src="http://localtimes.info/world_clock2.php?&amp;cp1_Hex=ffffff&amp;cp2_Hex=FFFFFF&amp;cp3_Hex=000000&amp;fwdt=72&amp;ham=0&amp;hbg=1&amp;hfg=0&amp;sid=0&amp;mon=0&amp;wek=0&amp;wkf=0&amp;sep=0&amp;widget_number=21000&amp;lcid=USIL0225"></script></div>
            	<div style="margin: 0px 0px 0px; display: inline-block; text-align: center;"><script type="text/javascript" src="http://localtimes.info/world_clock2.php?&amp;cp1_Hex=ffffff&amp;cp2_Hex=FFFFFF&amp;cp3_Hex=000000&amp;fwdt=72&amp;ham=0&amp;hbg=1&amp;hfg=0&amp;sid=0&amp;mon=0&amp;wek=0&amp;wkf=0&amp;sep=0&amp;widget_number=21000&amp;lcid=UPXX0016"></script></div>
            </div>

        </div>
    </div>
</nav>