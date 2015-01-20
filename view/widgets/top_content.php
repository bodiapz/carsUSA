<div class="row top-content">
    <div class="category-widget col-lg-3 col-md-3">
        <div class="no-padding">
            <span class="title"><?php $this->translate($this->langVars['Категорії']); ?></span>
        </div>

        <div class="list-group list-categ">
            <?php if(!empty($categories)) : ?>
                <?php foreach($categories as $category) : ?>
                    <a href="<?php $this->location('category/view/' . $category['permalink']); ?>" class="list-group-item <?php if($current == $category['permalink']) echo 'active'; ?>"><i class="fa fa-angle-right"></i> <?php echo $category[$this->prefix . 'name']; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row text-center col-lg-3 col-md-3">
        <div class="row-offset-12"></div>
        <div class="filter-widget">
            <form action="<?php $this->location('search'); ?>" enctype="multipart/form-data" method="post" class="col-lg-12">
                <div class="form-group">
                    <label class="control-label pull-left"><?php $this->translate($this->langVars['Тип транспорту']); ?></label>
                    <select name="categories" class="form-control">
                        <option><?php $this->translate($this->langVars['Будь-який']); ?></option>
                        <?php if(!empty($categories)) : ?>
                            <?php foreach($categories as $category) : ?>
                                <?php echo '<option value="'. $category['id'] .'">' . $category[$this->prefix . 'name'] . '</option>'; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label pull-left"><?php $this->translate($this->langVars['Марка']); ?></label>
                    <div class="clearfix"></div>
                    <select name="brands" class="form-control">
                        <option><?php $this->translate($this->langVars['Будь-яка']); ?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label pull-left"><?php if(isset($this->langVars['Модель'])) echo $this->langVars['Модель']; else echo 'Модель'; ?></label>
                    <select name="models" class="form-control">
                        <option val=""><?php $this->translate($this->langVars['Будь-яка']); ?></option>
                    </select>
                </div>

                <span class="clearfix"></span>

                <div class="form-group">
                    <label class="control-label pull-left"><?php $this->translate($this->langVars['Рік']); ?></label>
                </div>
                <span class="clearfix"></span>
                <div class="form-group col-lg-7 pull-left row">
                    <select name="year_from" class="form-control">
                        <option><?php $this->translate($this->langVars['Будь-який']); ?></option>
                        <?php for($year = 1960; $year <= 2016; $year++) : ?>
                            <?php echo '<option value="'. $year .'">' . $year . '</option>'; ?>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group col-lg-7 pull-right row">
                    <select name="year_to" class="form-control">
                        <option><?php $this->translate($this->langVars['Будь-який']); ?></option>
                        <?php for($year = 1960; $year <= 2016; $year++) : ?>
                            <?php echo '<option value="'. $year .'">' . $year . '</option>'; ?>
                        <?php endfor; ?>
                    </select>
                </div>

                <span class="clearfix"></span>

                <div class="form-group">
                    <label class="control-label pull-left"><?php $this->translate($this->langVars['Пробіг']); ?></label>
                </div>
                <div class="form-group">
                    <input type="text" name="" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary col-lg-12 col-md-12" value="<?php $this->translate($this->langVars['Пошук']); ?>">
                </div>
            </form>
        </div>
    </div>

    <div class="text-center col-lg-3 col-md-3">
        <h5 class="form-type"><?php $this->translate($this->langVars['Тип аукціону']); ?></h5>
        <div class="filter-widget filter-widget-block-2">
            <form action="" class="col-lg-12">
                <div class="form-group">
                    <label><input type="checkbox" name="" value="1"> Чисті авто купити одразу</label>
                    <label><input type="checkbox" name="" value="2"> Чисті авто зробити ставку</label>
                    <label><input type="checkbox" name="" value="3"> Пошкоджені авто купити одразу</label>
                    <label><input type="checkbox" name="" value="4"> Пошкоджені авто зробити ставку</label>
                    <label><input type="checkbox" name="" value="5"> Автомобілі наших дилерів</label>
                    <label><input type="checkbox" name="" value="6"> Конфісковані автомобілі</label>
                </div>
            </form>
            <span class="titre"><?php if(isset($this->langVars['Будь ласка, виберіть один чи декілька типів аукціону'])) echo $this->langVars['Будь ласка, виберіть один чи декілька типів аукціону']; else echo 'Будь ласка, виберіть один чи декілька типів аукціону'; ?></span>
        </div>
    </div>

    <div class="text-center col-lg-3 col-md-3">
        <h5 class="form-type"><?php if(isset($this->langVars['Розміщення'])) echo $this->langVars['Розміщення']; else echo 'Розміщення'; ?></h5>
        <div class="filter-widget filter-widget-block-2">
            <form action="" class="col-lg-12">
                <div class="form-group">
                    <label><input type="checkbox" name="" value="1"> Alaska</label>
                    <label><input type="checkbox" name="" value="2"> Alabama</label>
                    <label><input type="checkbox" name="" value="3"> Arkansas</label>
                    <label><input type="checkbox" name="" value="4"> Arizona</label>
                    <label><input type="checkbox" name="" value="5"> California</label>
                    <label><input type="checkbox" name="" value="6"> Colorado</label>
                    <label><input type="checkbox" name="" value="7"> Connecticut</label>
                    <label><input type="checkbox" name="" value="8"> Washington, D.C.</label>
                    <label><input type="checkbox" name="" value="9"> Delaware</label>
                    <label><input type="checkbox" name="" value="10"> Florida</label>
                    <label><input type="checkbox" name="" value="11"> Georgia</label>
                    <label><input type="checkbox" name="" value="12"> Hawaii</label>
                    <label><input type="checkbox" name="" value="13"> Iowa</label>
                    <label><input type="checkbox" name="" value="14"> Idaho</label>
                    <label><input type="checkbox" name="" value="15"> Illinois</label>
                    <label><input type="checkbox" name="" value="16"> Indiana</label>
                    <label><input type="checkbox" name="" value="17"> Kansas</label>
                    <label><input type="checkbox" name="" value="18"> Kentucky</label>
                    <label><input type="checkbox" name="" value="19"> Louisiana</label>
                    <label><input type="checkbox" name="" value="20"> Massachusetts</label>
                    <label><input type="checkbox" name="" value="21"> Maryland</label>
                    <label><input type="checkbox" name="" value="22"> Maine</label>
                    <label><input type="checkbox" name="" value="23"> Michigan</label>
                    <label><input type="checkbox" name="" value="24"> Minnesota</label>
                    <label><input type="checkbox" name="" value="25"> Missouri</label>
                    <label><input type="checkbox" name="" value="26"> Mississippi</label>
                    <label><input type="checkbox" name="" value="27"> Montana</label>
                    <label><input type="checkbox" name="" value="28"> North Carolina</label>
                    <label><input type="checkbox" name="" value="29"> North Dakota</label>
                    <label><input type="checkbox" name="" value="30"> Nebraska</label>
                    <label><input type="checkbox" name="" value="31"> New Hampshire</label>
                    <label><input type="checkbox" name="" value="32"> New Jersey</label>
                    <label><input type="checkbox" name="" value="33"> New Mexico</label>
                    <label><input type="checkbox" name="" value="34"> Nevada</label>
                    <label><input type="checkbox" name="" value="35"> New York</label>
                    <label><input type="checkbox" name="" value="36"> Ohio</label>
                    <label><input type="checkbox" name="" value="37"> Oklahoma</label>
                    <label><input type="checkbox" name="" value="38"> Oregon</label>
                    <label><input type="checkbox" name="" value="39"> Pennsylvania</label>
                    <label><input type="checkbox" name="" value="40"> Puerto Rico</label>
                    <label><input type="checkbox" name="" value="41"> Rhode Island</label>
                    <label><input type="checkbox" name="" value="42"> South Carolina</label>
                    <label><input type="checkbox" name="" value="43"> South Dakota</label>
                    <label><input type="checkbox" name="" value="44"> Tennessee</label>
                    <label><input type="checkbox" name="" value="45"> Texas</label>
                    <label><input type="checkbox" name="" value="46"> Utah</label>
                    <label><input type="checkbox" name="" value="47"> Virginia</label>
                    <label><input type="checkbox" name="" value="48"> Virgin Islands</label>
                    <label><input type="checkbox" name="" value="49"> Vermont</label>
                    <label><input type="checkbox" name="" value="50"> Washington</label>
                    <label><input type="checkbox" name="" value="51"> Wisconsin</label>
                    <label><input type="checkbox" name="" value="52"> West Virginia</label>
                    <label><input type="checkbox" name="" value="53"> Wyoming</label>
                    <label><input type="checkbox" name="" value="54"> Alberta</label>
                    <label><input type="checkbox" name="" value="55"> British Columbia</label>
                    <label><input type="checkbox" name="" value="56"> Manitoba</label>
                    <label><input type="checkbox" name="" value="57"> New Brunswick</label>
                    <label><input type="checkbox" name="" value="58"> Newfoundland and Labrador</label>
                    <label><input type="checkbox" name="" value="59"> Nova Scotia</label>
                    <label><input type="checkbox" name="" value="60"> Ontario</label>
                    <label><input type="checkbox" name="" value="61"> Prince Edward Island</label>
                    <label><input type="checkbox" name="" value="62"> Quebec</label>
                    <label><input type="checkbox" name="" value="63"> Saskatchewan</label>
                </div>
            </form>
            <span class="titre"><?php if(isset($this->langVars['Будь ласка, виберіть один чи декілька штатів'])) echo $this->langVars['Будь ласка, виберіть один чи декілька штатів']; else echo 'Будь ласка, виберіть один чи декілька штатів'; ?></span>
        </div>
    </div>
</div>

<!--<div class="stripe-line"></div>-->