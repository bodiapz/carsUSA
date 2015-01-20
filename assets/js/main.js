jQuery(document).ready(function() {
    /*ACTIVE LINKS*/
    var url = document.location.href;
    $.each($("a"),function(){if(this.href == url){ $(this).addClass('active'); };});

    $('#hot-deals').carousel({interval: 5000,pause: false,cycle: true});

    // open dropdown lang
    $(document).on('click', '.dropdown-lang-inner li a, .dropdown-lang-inner span', function() {
        $('.dropdown-lang').slideDown('fast');
        $(this).addClass('lang-opened');
    });

    // close dropdown lang
    $(document).on('click', '.lang-opened, .dropdown-lang-inner span.lang-opened', function() {
        $('.dropdown-lang').slideUp('fast');
        $(this).removeClass('lang-opened');
    });


    //PORTS LOADING
    $(document).on('change', '[name="countries"]', function() {
        country = $(this).val();
        
        $.ajax({
            url: basePath + 'ajax/getPorts',
            type: 'POST',dataType: 'html', data: {country : country}
        })
        .done(function(data) {
            $('[name="ports"]').html(data);
                CalcDelivery();
        })


    });

    $(document).on('change', '[name="ports"]', function() {
        CalcDelivery();
    });


    $(document).on('change', '[name="categories"]', function() {
        categories = $(this).val();
        
        $.ajax({
            url: basePath + 'ajax/getBrands',
            type: 'POST',
            dataType: 'json',
            data: {categories : categories}
        })
        .done(function(data) {
            $('[name="brands"]').html('');
            $('[name="brands"]').append('<option value="">Будь-яка</option>');
            $.each(data, function(key,value){
                console.log(key + ' - ' + value);
                $('[name="brands"]').append('<option data-key="' + key + '">' + value + '</option>');
            })
        })
    });

    $(document).on('change', '[name="brands"]', function() {
        brands = $(this).children(':selected').attr('data-key');
        
        $.ajax({
            url: basePath + 'ajax/getModels', type: 'POST', dataType: 'json',
            data: {brands : brands}
        })
        .done(function(data) {
            $('[name="models"]').html('').append('<option value="">Будь-яка</option>');
            $.each(data, function(key,value){
                $('[name="models"]').append('<option data-key="' + key + '">' + value + '</option>');
            })
        })
    });




    //FAVORITES
    $(document).on('click', '.add-to-fav', function() {
        if(carId > 0) {
            $.ajax({
                url: basePath + 'ajax/addToFav', type: 'POST', dataType: 'html',
                data: {carId: carId}
            })
            .done(function (data) {
                $('.favorites').html(data);
            })
        }
    });

    $(document).on('click', '.del-from-fav', function() {
        if(carId > 0) {
            $.ajax({
                url: basePath + 'ajax/delFromFav', type: 'POST', dataType: 'html',
                data: {carId: carId}
            })
            .done(function (data) {
                $('.favorites').html(data);
            })
        }
    });

    // select port on click map
    $(document).on('click', '[data-value], .cities', function() {
        data_value = $(this).attr('data-value');
        $('[name="port"]').children('[value="' + data_value + '"]').attr('selected','selected');

        CalcDelivery();
    });

    $(document).on('click', '.getItemPrice', function() {
        data_price = $(this).attr('data-price');
        $('[name="port"]').children('[value="' + data_price + '"]').attr('selected','selected');

        CalcDelivery();
    });

    $(document).on('change', '[name="year_from"]', function() {
        year_from = parseInt($(this).children(':selected').val());
        year_to = parseInt($('[name="year_to"]').val());

        if(year_from != NaN && year_to != NaN && year_to < year_from)
            $('[name="year_to"]').children('[value="' + year_from + '"]').attr('selected','selected');
    });

    // get the price in the area
    var foo = $(document).on('click', '[data-price]', function(foo) {
        data_price = $(this).attr('data-price');
    });

    // calculator of quantity auto
    $(document).on('change', '[name="quantity_auto"]', function() {
        CalcDelivery();
    });

    // open chat
    $(document).on('click', '.chat-open', function() {
        $('.online-chat-wrapper').animate({'left': '0'}, 'slow');
        $(this).addClass('chat-opened').removeClass('chat-open');
    });

    // close chat
    $(document).on('click', '.chat-opened', function() {
        $('.online-chat-wrapper').animate({'left': '-261'}, 'slow');
        $(this).removeClass('chat-opened').addClass('chat-open');
    });

    $(document).on('click','#myto_calculation',function(){

        var auto_type   = $(this).attr('data-auto-type');

        var price   = parseInt($('#auto_price[data-auto-type="' + auto_type + '"]').val());
        var volume  = parseFloat($('#auto_obem[data-auto-type="' + auto_type + '"]').val().replace(',','.'));
        var petrol  = parseInt($('[name=auto_petrol]:checked[data-auto-type="' + auto_type + '"]').val() );
        var age     = parseInt($('[name=auto_age]:checked[data-auto-type="' + auto_type + '"]').val() );

        if (isNaN(price) || isNaN(volume))
        {
            alert('Error');
            return false;
        }


        if(auto_type == 1) // legkovi auto
        {
            //console.log(volume);
            //console.log(age);
            //console.log(petrol);

            if (petrol==1)              /////////////////////////  ACTSIZ  BENZIN    ///////////////////////
            {

                if (volume<=1.0 && age<2) //////////////////////////    Об єм   менше 1.0 куб.см.
                {
                    var aktsyz = volume*0.05;
                }
                else if(volume<=1.0 && age>2 && age<5)
                {
                    var aktsyz = volume*1;
                }
                else if (volume<=1.0 && age>5)
                {
                    var aktsyz = volume*1.25;
                }
                ///////////////////////////////////  Об єм  1.0  1.5

                else if (volume>1.0 && volume<=1.5 && age<2)
                {
                    var aktsyz = volume*0.03;
                }
                else if(volume>1.0 && volume<=1.5 && age>2 && age<5)
                {
                    var aktsyz = volume*1.25;
                }
                else if (volume>1.0 && volume<=1.5 && age>5)
                {
                    var aktsyz = volume*1.5;
                }                                  /////////////////////////////////////  Об єм 1.5  2.2

                else if (volume>1.5 && volume<=2.2 && age<2)
                {
                    var aktsyz = volume*0.12;
                }
                else if(volume>1.5 && volume<=2.2 && age>2 && age<5)
                {
                    var aktsyz = volume*1.5;
                }
                else if (volume>1.5 && volume<=2.2 && age>5)
                {
                    var aktsyz = volume*2;
                    //////////////////////////////// Об єм 2.2  3.0
                }

                else if (volume>2.2 && volume<=3.0 && age<2)
                {
                    var aktsyz = volume*0.12;
                }
                else if(volume>2.2 && volume<=3.0 && age>2 && age<5)
                {
                    var aktsyz = volume*2;
                }
                else if (volume>2.2 && volume<=3.0 && age>5)
                {
                    var aktsyz = volume*3;
                    /////////////////////////////////////////////////////   Об єм 3.0 & <
                }

                else if (volume>3.0 && age<2)
                {
                    var aktsyz = volume*0.12;
                }
                else if(volume>3.0 && age>2 && age<5)
                {
                    var aktsyz = volume*2;
                }
                else if (volume>3.0 && age>5)
                {
                    var aktsyz = volume*3;
                }
                else
                {
                    var aktsyz = 0;
                }
            }

            /////////////  //////////////    ACTSIZ DIESEL  ////////////////////////////

            if (petrol==2)
            {
                if (volume<=1.0 && age<2) //////////////////////////    Об єм   менше 1.0 куб.см.
                {
                    var aktsyz = volume*0.05;
                }
                else if(volume<=1.0 && age>2 && age<5)
                {
                    var aktsyz = volume*1;
                }
                else if (volume<=1.0 && age>5)
                {
                    var aktsyz = volume*1.25;
                }
                ///////////////////////////////////   Об єм 1.0  1.5

                else if (volume>1.0 && volume<=1.5 && age<2)
                {
                    var aktsyz = volume*0.03;
                }
                else if(volume>1.0 && volume<=1.5 && age>2 && age<5)
                {
                    var aktsyz = volume*1.25;
                }
                else if (volume>1.0 && volume<=1.5 && age>5)
                {
                    var aktsyz = volume*1.5;
                }                                  ///////////////////////////////////// Об єм  1.5  2.5


                else if (volume>1.5 && volume<=2.5 && age<2)
                {
                    var aktsyz = volume*0.15;
                }
                else if(volume>1.5 && volume<=2.5 && age>2 && age<5)
                {
                    var aktsyz = volume*1.75;
                }
                else if (volume>1.5 && volume<=2.5 && age>5)
                {
                    var aktsyz = volume*2;

                    ////////////////////////////////   Об єм 2.5 & <
                }


                else if (volume>2.5 && age<2)
                {
                    var aktsyz = volume*1;
                }
                else if(volume>2.5 &&  age>2 && age<5)
                {
                    var aktsyz = volume*2.5;
                }
                else if (volume>2.5 && age>5)
                {
                    var aktsyz = volume*3.25;
                }
                else
                {
                    var aktsyz = 0;
                }
            }

            var vvizneMyto = price*0.1;
            aktsyz=aktsyz*1000;
            var pdv = Math.round((price+vvizneMyto+aktsyz)*0.2);


            //console.log(aktsyz);

            var fullPrice = parseInt(price)+parseInt(vvizneMyto)+parseInt(aktsyz)+parseInt(pdv);

            $('#myto_result_calc').html("<h3><b>Вартість розмитненого авто</b> : <span class='text-primary'>" + " $" + fullPrice+"</span></h3>"+"<b>Ввізне мито \(10\%\) :</b> "+vvizneMyto+" $"+"<br />" + "<b>Акциз :</b> "+aktsyz+ " $"+"<br />" + "<b>ПДВ \(20\%\) :</b> "+pdv+" $");
        }

        if(auto_type == 2) // motocykly
        {
            var myto_3 = price*0.1;
            var aktsyz_3 = volume*1000*0.2;
            var pdV =(price+myto_3+aktsyz_3)*0.2;
            var pdv_3 = parseInt( pdV.toFixed(2));

            var fullPrice = price + myto_3 + aktsyz_3 + pdv_3;

            $('#myto_result_calc').html("<h3><b>Вартість розмитненого мотоцикла</b> : <span class='text-primary'>" + " $" + fullPrice+"</span></h3>"+"<b>Ввізне мито \(10\%\) :</b> "+myto_3+" $"+"<br />" + "<b>Акциз :</b> "+aktsyz_3+ " $"+"<br />" + "<b>ПДВ \(20\%\) :</b> "+pdv_3+" $");
        }

        if(auto_type == 3) // vantazivki
        {
            var myto =Math.round(price*0.1);
            var pdv =(price+myto)*0.2;
            var fullPrice = price+myto+pdv;

            $('#myto_result_calc').html("<h3><b>Вартість розмитненого авто</b> : <span class='text-primary'>" + " $" + fullPrice+"</span></h3>"+"<b>Ввізне мито \(10\%\) :</b> "+myto+" $"+"<br />" + "<b>ПДВ \(20\%\) :</b> "+pdv+" $");
        }

        if(auto_type == 4) // autobusy
        {
            var myto_2 = Math.round(price*0.1);
            var pdv_2 =(price+myto_2)*0.2;

            var fullPrice = price+myto_2+pdv_2;
            $('#myto_result_calc').html("<h3><b>Вартість розмитненого автобуса</b> : <span class='text-primary'>" + " $" + fullPrice+"</span></h3>"+"<b>Ввізне мито \(10\%\) :</b> "+myto_2+" $"+"<br />" + "<b>ПДВ \(20\%\) :</b> "+pdv_2+" $");
        }
    });

    $(document).on('click','#search_car',function(event){
        event.preventDefault();

        var $year   = null,
            $marka  = null,
            $model  = null;

        var $keyword    = $('[name="input-search"]').val().trim();

        if($keyword != '' && $keyword != null)
        {
            var reg = / +/
            $keyword = $keyword.replace(/[ \t]{2,}/g, ' ');

            reg = / (\d+){4,4}/

            var years = reg.exec($keyword);
            if(years != null)
            {
                $year = years[0].trim();
                $keyword = $keyword.replace($year,'');
            }

            var $words = $keyword.split(' ');

            if($words[0] != null)
            {
                $marka = $words[0];

                if($words[1] != null)
                {
                    $model = $words[1];
                }
            }
            else
            {
                $marka = $keyword
            }

            //console.log($marka);
            //console.log($model);
            //console.log($year);
            $html = "<div style='display: none'><form id='search_form' action='" + basePath + "search' method='post' enctype='multipart/form-data'>" +
            "<input type='text' name='categories' value='1'>" +
            "<input type='text' name='brands' value='" + $marka + "'>";
            if($model != null)
            {
                $html = $html + "<input type='text' name='models' value='" + $model + "'>";
            }

            $html = $html + "<input type='text' name='year_from' value='" + $year + "'>" +
            "<input type='text' name='year_to' value='" + $year + "'>" +
            "</form>" +
            "</div>";

            $(this).append($html);
            $('#search_form').submit();
        }
    })

    $(document).on('click','#customsCalculatorTab li a', function () {
        $('#myto_result_calc').html('');
    });

    $(document).on('click', '.slide-down', function(event) {
        event.preventDefault();
        $('.dropdownmenu-user').slideDown('fast');
        $(this).addClass('slide-up').removeClass('slide-down');
    });

    $(document).on('click', '.slide-up', function(event) {
        event.preventDefault();
        $('.dropdownmenu-user').slideUp('fast');
        $(this).addClass('slide-down').removeClass('slide-up');
    });






    $(document).on('submit', '#registration', function() {
            if($('.red-tooltip').length > 0) return false;
            $(this).submit();
    });




    $(document).on('change', '[name="port"]', function() {CalcDelivery();});

    // ask price
    $(document).on('click', '#ask_price:not(.active)', function(){
        var $this = $(this);
        var $cars_lotid     = $this.attr('data-lotid');
        var $cars_name      = $this.attr('data-fullname');
        var $user_cars_id   = $this.attr('data-id');

        $.ajax({
                url: basePath + 'ajax/ask_price', type:"POST", dataType:"html",
                data:{lotId: $cars_lotid, fullname: $cars_name, user_cars_id: $user_cars_id}
            })
            .done(function(data){
                $this.addClass('active');
                $this.text('Перевірте повідомлення');
                $('#messages').html(data);
            })
    });

    if($('.gallery a').length > 0)
    {
        $('.gallery a').fancybox({
            padding : 0,
            openEffect  : 'elastic'
        })
    };



    // calculation of delivery
    function CalcDelivery()
    {
        var price = $('[name="port"] option:selected').attr('data-price');
        var count = $('[name="quantity_auto"]').val();

        days_to = $('[name="ports"] option:selected').attr('data-days_to');
        days_from = $('[name="ports"] option:selected').attr('data-days_from');
        single_price = $('[name="ports"] option:selected').attr('data-single_price');
        container_price = $('[name="ports"] option:selected').attr('data-container_price');




        $('.counted_price').append('<img src="' + basePath + 'assets/images/loading.gif">');
        setTimeout(function() {
            $('.counted_price img').remove();
            $('.counted_price span').html('$' + (price)*(count));

            if(count <= 2)
                $('.counted_shipment_price span').html('$' + (single_price)*(count));
            else{
                var containers = Math.floor((count) / 3)
                var single = count - containers * 3;
                $('.counted_shipment_price span').html('$' + (container_price * containers + single_price * single) );
            }

            $('.days_to').html(days_to);
            $('.days_from').html(days_from);
        }, 500);

    }
});

