<div class="customs-calculator-wrapper">
	<h2 class="text-center">
        Попередній розрахунок вартості автомобіля <br/>
        та його розмитнення
    </h2>
	<h3 class="text-center">Митний калькулятор</h3>

	<div class="col-lg-12 col-md-12 customs-calculator-inner">
		<h4 class="text-center text-primary">Виберіть тип транспортного засобу</h4>

        <br/>

        <div class="customs-calculator col-lg-12 col-md-12" role="tabpanel">
            <ul id="customsCalculatorTab" class="nav nav-tabs row" role="tablist">
                <li role="presentation" class=""><a href="#auto"     role="tab" id="auto-tab"     data-toggle="tab" aria-controls="home"      aria-expanded="true"></a></li>
                <li role="presentation" class=""><a href="#moto"     role="tab" id="moto-tab"     data-toggle="tab" aria-controls="profile"   aria-expanded="true"></a></li>
                <li role="presentation" class=""><a href="#freight"  role="tab" id="freight-tab"  data-toggle="tab" aria-controls="profile"   aria-expanded="true"></a></li>
                <li role="presentation" class=""><a href="#bus"      role="tab" id="bus-tab"      data-toggle="tab" aria-controls="profile"   aria-expanded="true"></a></li>
            </ul>
            <div id="customsCalculatorTabContent" class="tab-content overflow">
                <div role="tabpanel" class="tab-pane fade in" id="auto" aria-labelledby="home-tab">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <h3>Легковий автомобіль</h3>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="auto_price">Ціна в $:</label>
                                <input type="text" id="auto_price" name="auto_price" class="form-control" data-auto-type="1">
                            </div>
                        </div>

                        <div class="col-lg-6 col-lg-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="auto_obem">Об'єм (куб. см.):</label>
                                <input id="auto_obem" name="auto_obem" class="form-control" placeholder="1.5" data-auto-type="1">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label>Тип мотора:</label>
                                <br/>
                                <label class="column-span-1"><input type="radio" name="auto_petrol" value="1" checked data-auto-type="1"> Бензин</label>
                                <label class="column-span-2"><input type="radio" name="auto_petrol" value="2" data-auto-type="1"> Дизель</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label>Вік авто:</label>
                                <br/>
                                <label class="column-span-3"><input type="radio" name="auto_age" value="1" checked data-auto-type="1"> Новий</label>
                                <label class="column-span-4"><input type="radio" name="auto_age" value="3" data-auto-type="1"> До 5 років</label>
                                <label class="column-span-5"><input type="radio" name="auto_age" value="7" data-auto-type="1"> Більше 5 років</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <span class="btn btn-primary btn-sm pull-right" id="myto_calculation" data-auto-type="1">Розрахувати</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade in" id="moto" aria-labelledby="profile-tab">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <h3>Мотоцикл</h3>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="auto_price">Ціна в $:</label>
                                <input type="text" id="auto_price" name="auto_price" class="form-control" data-auto-type="2">
                            </div>
                        </div>

                        <div class="col-lg-6 col-lg-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="auto_obem">Об'єм (куб. см.):</label>
                                <input id="auto_obem" name="auto_obem" class="form-control" placeholder="1.5" data-auto-type="2">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <span class="btn btn-primary btn-sm pull-right" id="myto_calculation" data-auto-type="2">Розрахувати</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="freight" aria-labelledby="dropdown1-tab">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <h3>Грузовий автомобіль</h3>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="auto_price">Ціна в $:</label>
                                <input type="text" id="auto_price" name="auto_price" class="form-control" data-auto-type="3">
                            </div>
                        </div>

                        <div class="col-lg-6 col-lg-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="auto_obem">Об'єм (куб. см.):</label>
                                <input id="auto_obem" name="auto_obem" class="form-control" placeholder="1.5" data-auto-type="3">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label>Вік автомобіля:</label>
                                <br/>
                                <label class="column-span-3"><input type="radio" name="auto_age" value="1" checked data-auto-type="3"> Новий</label>
                                <label class="column-span-4"><input type="radio" name="auto_age" value="3" data-auto-type="3"> До 5 років</label>
                                <label class="column-span-5"><input type="radio" name="auto_age" value="7" data-auto-type="3"> Більше 5 років</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <span class="btn btn-primary btn-sm pull-right" id="myto_calculation" data-auto-type="3">Розрахувати</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="bus" aria-labelledby="dropdown2-tab">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <h3>Автобус</h3>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="auto_price">Ціна в $:</label>
                                <input type="text" id="auto_price" name="auto_price" class="form-control" data-auto-type="4">
                            </div>
                        </div>

                        <div class="col-lg-6 col-lg-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="auto_obem">Об'єм (куб. см.):</label>
                                <input id="auto_obem" name="auto_obem" class="form-control" placeholder="1.5" data-auto-type="4">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <label>Вік автобуса:</label>
                                <br/>
                                <label class="column-span-3"><input type="radio" name="auto_age" value="1" checked data-auto-type="4"> Новий</label>
                                <label class="column-span-4"><input type="radio" name="auto_age" value="3" data-auto-type="4"> До 5 років</label>
                                <label class="column-span-5"><input type="radio" name="auto_age" value="7" data-auto-type="4"> Більше 5 років</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                            <div class="form-group col-lg-12 col-md-12">
                                <span class="btn btn-primary btn-sm pull-right" id="myto_calculation" data-auto-type="4">Розрахувати</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="myto_result_calc"></div>
        </div>

	</div>
</div>


