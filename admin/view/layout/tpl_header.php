<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav pull-left">
                <li><a href="<?php $this->location(); ?>">Головна</a></li>
                <li class="nav-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Сторінки <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php $this->location('pages/list_pages'); ?>">Список сторінок</a></li>
                        <li><a href="<?php $this->location('pages/create'); ?>">Додати сторінку</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="<?php $this->location('pages/zones'); ?>">
                        Карта тарифів доставки
                    </a>


                    <!--<ul class="dropdown-menu">
                        <?php if(!empty($prices)) : ?>
                            <?php foreach($prices as $price) : ?>
                                <li><a href="<?php $this->location('pages/tariff_map/' . $price['id']); ?>"><?php echo $price['name']; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>-->
                </li>
                <li class="nav-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Користувачі <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php $this->location('user/list_users'); ?>">Список користувачів</a></li>
                        <li><a href="<?php $this->location('user/create'); ?>">Додати користувача</a></li>
                    </ul>
                </li>
                <li><a href="<?php $this->location('slider/slides'); ?>">Слайдер</a></li>
                <li><a href="<?php $this->location('chat/show_chat'); ?>">Чат</a></li>
            </ul>
            <div class="col-lg-2 pull-right">
                <div class="row">
                    <?php if(isset($_SESSION['user'])) : ?>
                        <div class="btn-group user-menu-bar">
                            <a href="<?php echo $this->basePath . 'user/account'; ?>" class="btn-xs">
                                <i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo ucwords($_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']); ?>
                            </a>
                            <a href="<?php $this->location('user/logout') ?>" class="btn-xs signout"> <i class="fa fa-sign-out"></i> Вихід</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>