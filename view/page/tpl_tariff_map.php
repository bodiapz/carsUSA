
<div class="row">
	<div class="col-lg-12 col-md-12 map-price relative">
		<div class="row line">
			<?php $dollar = 0; if(!empty($prices)) : ?>
				<?php foreach($prices as $price) : $dollar++; ?>
					<div class="col-lg-2 col-md-2 <?php if($dollar == 1) echo 'col-lg-offset-1 col-md-offset-1'; ?> text-center">
						<div class="row">
							<span class="dollar dollar-<?php echo $dollar; ?>"><i class="fa fa-dollar"></i></span>
							<span class="text getItemPrice" data-price="<?php echo $price['price']; ?>"><?php $this->translate($this->langVars['Від']); ?> $ <?php echo $price['price']; ?></span>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="col-lg-12 col-md-12 map text-center">
		<img src="<?php $this->location('assets/images/usa-map-arial.png');?>" alt="" usemap="#Map" />

		<span data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" class="absolute cities new-york" data-value="1">New York, NY</span>
		<span data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" class="absolute cities baltimore" data-value="2">Baltimore, MD</span>
		<span data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" class="absolute cities savannah" data-value="3">Savannah, GA</span>
		<span data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" class="absolute cities jacksonville" data-value="4">Jacksonville, FL</span>
		<span data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" class="absolute cities miami" data-value="5">Miami, FL</span>
		<span data-price="<?php if(!empty($prices[3]['price'])) echo $prices[3]['price']; ?>" class="absolute cities galveston" data-value="6">Galveston, TX</span>
		<span data-price="<?php if(!empty($prices[1]['price'])) echo $prices[1]['price']; ?>" class="absolute cities los-angeles" data-value="7">Los Angeles, CA</span>

		<map name="Map" id="Map">
		    <area data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" data-value="1" alt="Нью Йорк, NJ" title="Нью Йорк, NJ" shape="rect" coords="670,175,686,159" />
		    <area data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" data-value="2" alt="Балтімор, MD" title="Балтімор, MD" shape="rect" coords="642,209,659,193" />
		    <area data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" data-value="3" alt="Савана, GA" title="Савана, GA" shape="rect" coords="601,348,615,332" />
		    <area data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" data-value="4" alt="Джексонвіль, FL" title="Джексонвіль, FL" shape="rect" coords="591,353,612,371" />
		    <area data-price="<?php if(!empty($prices[4]['price'])) echo $prices[4]['price']; ?>" data-value="5" alt="Маямі, FL" title="Маямі, FL" shape="rect" coords="624,432,644,450" />
		    <area data-price="<?php if(!empty($prices[3]['price'])) echo $prices[3]['price']; ?>" data-value="6" alt="Гальвістон, TX" title="Гальвістон, TX" shape="rect" coords="414,386,431,404" />
		    <area data-price="<?php if(!empty($prices[1]['price'])) echo $prices[1]['price']; ?>" data-value="7" alt="Лос Анжелес, CA" title="Лос Анжелес, CA" shape="rect" coords="57,276,74,294" />
		</map>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 select-transporting">
		<div class="row">
				<div class="col-lg-12 col-md-12">
					<h4 class="col-lg-12 col-md-12 text-center"><span><?php $this->translate($this->langVars['Доставка до порту морем']); ?></span></h4>
					<div class="col-lg-6 col-md-6">
						<div class="row">
							<div class="form-group col-lg-12 col-md-12">
								<label class="col-lg-6 col-md-6 control-label"><?php $this->translate($this->langVars['Порт відправки']); ?></label>
								<select name="port" class="col-lg-6 col-md-6 form-control">
									<option data-price="<?php $this->print_s($prices[4]['price']); ?>"  value="1">Нью Йорк, NJ</option>
									<option data-price="<?php $this->print_s($prices[4]['price']); ?>"  value="2">Балтімор, MD</option>
									<option data-price="<?php $this->print_s($prices[4]['price']); ?>"  value="3">Савана, GA</option>
									<option data-price="<?php $this->print_s($prices[4]['price']); ?>"  value="4">Джексонвіль, FL</option>
									<option data-price="<?php $this->print_s($prices[4]['price']); ?>"  value="5">Маямі, FL</option>
									<option data-price="<?php $this->print_s($prices[3]['price']); ?>"  value="6">Гальвістон, TX</option>
									<option data-price="<?php $this->print_s($prices[0]['price']); ?>"  value="7">Лос Анжелес, CA</option>
								</select>
							</div>

							<div class="form-group col-lg-12 col-md-12">
								<label class="col-lg-6 col-md-6 control-label"><?php $this->translate($this->langVars['Кількість автомобілів']); ?></label>
								<input value="1" type="number" min="1" name="quantity_auto" class="col-lg-6 col-md-6 form-control">

							</div>

                            <div class="col-lg-12 col-md-12">
                                <h5 class="counted_price"><?php $this->translate('Вартість доставки до порту в США'); ?>: &nbsp;<span class="counted_price_inner badge badge-primary">$<?php echo $prices[4]['price'];?></span></h5>
                            </div>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 border-left-separator">
						<div class="row">
							<div class="form-group col-lg-12 col-md-12">
								<label class="col-lg-6 col-md-6 control-label"><?php $this->translate($this->langVars['Країна прибуття']); ?></label>
								<select name="countries" class="col-lg-6 col-md-6 form-control">
									<?php if(!empty($countries)) : ?>
										<?php foreach($countries as $country) : ?>
											<option value="<?php echo $country['id']; ?>" <?php if($country['id'] == $this->configData['config']['defaultCountryId']) echo 'selected';?>><?php echo $country[$this->prefix . 'name']; ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div>

							<div class="form-group col-lg-12 col-md-12">
								<label class="col-lg-6 col-md-6 control-label"><?php $this->translate($this->langVars['Порт прибуття']); ?></label>

                                <select name="ports" class="col-lg-6 col-md-6 form-control"><?php include('view/widgets/ports.php'); ?></select>
							</div>

                            <div class="col-lg-12 col-md-12">
                                <h5 class="counted_shipment_price"><?php $this->translate('Вартість доставки у вибраний порт'); ?>: &nbsp;<span class="counted_price_inner badge badge-primary">$<?php echo $ports[0]['single_price'];?></span></h5>
                                <h5 class="counted_shipment_price"><?php $this->translate('Термін доставки від'); ?> <span class="days_from"><?php echo $ports[0]['days_from'];?></span> до <span class="days_to"><?php echo $ports[0]['days_to'];?></span> <?php $this->translate('днів'); ?></h5>
                            </div>
                            <script>
                                var single_price    = <?php echo $ports[0]['single_price'];?>;
                                var container_price = <?php echo $ports[0]['container_price'];?>;
                                var days_from       = <?php echo $ports[0]['days_from'];?>;
                                var days_to         = <?php echo $ports[0]['days_to'];?>;
                            </script>
						</div>
					</div>
				</div>
		</div>
	</div>
	



    <div class="col-lg-12 col-md-12">
        <div class="row-offset"></div>
        <div class="col-lg-6 col-md-6">
            <h4 class="call-to-us"><?php $this->translate('Зателефонуйте, щоб уточнити ціну'); ?> : </h4>
        </div>
		<div class="col-lg-3 col-md-3 text-right">
			<div class="phone-wrapper">
                <?php if(!empty($this->configData['phones'])) : ?>
                    <?php foreach($this->configData['phones'] as $phone) : ?>
                        <div class="col-lg-12 col-lg-12">
                            <span class="ico-phone"></span> <a class="text size16 pull-left" href="callto:<?php $this->print_s($phone); ?>" ><?php $this->print_s($phone); ?></a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php include_once('view/widgets/auctions.php'); ?>