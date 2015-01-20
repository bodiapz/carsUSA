jQuery(document).ready(function(){

    var $scrollDown = false;
    var refresh_timer;

    /**MY fancy box*/
    $(document).on('click', '.fancy-open', function(event){
        event.preventDefault();
        var $curr = $(this);
        var link = $curr.attr('href');
        $(link).addClass('fancy-popup').wrapAll('<div class="fancy-container">').append('<div class="fancy-close"></div>');

        generateToken();

        refresh_timer = setInterval(function(){refresh()},3000);
    });

    $(document).on('click', '.fancy-close', function(event){
        var $curr = $(this).closest('.fancy-popup').attr('id');
        console.log($curr);
        $('#' + $curr).removeClass('fancy-popup').unwrap();

        clearInterval(refresh_timer);
    });


    $(document).on('keypress', '[name="chat-message"]', function(e) {
        //alert();
        if(e.which == 13) {
            sendMessage($(this).val());
            $(this).val('');
        }
    });

    function sendMessage(message){
        $.ajax({
            url: basePath + 'ajax/chat_send_message',
            async: true, type: 'POST', dataType: 'html',
            data: {message : message},
            'success' : function(data)
            {
                $scrollDown = true;
                refresh();
            },
            'error' : function(){alert();}
        })
    }

    function generateToken()
    {
        $.ajax({
            url: basePath + 'ajax/generateToken',
            async: true, type: 'POST', dataType: 'html',
            data: {},
            'success' : function(data)
            {
                $scrollDown = true;
                refresh();
            },
            'error' : function(){alert();}
        })
    }

    function refresh()
    {
        var $id_from = 0;
        var $id_into = 0;

        if($('#last_id').length > 0)
        {
            $id_from = $('#last_id').val();
        }

        $.ajax({
            url: basePath + 'ajax/chat_refresh',
            async: true, type: 'POST', dataType: 'html',
            'success' : function(data)
            {
                $('.chat-wrapper').html(data);

                if($scrollDown)
                {
                    $('.chat-wrapper').scrollTop(99999);
                }
                else
                {
                    if($('#last_id').length > 0)
                    {
                        $id_into = $('#last_id').val();
                    }

                    refreshAdminsMessage($id_from, $id_into);
                }
            },
            'error' : function(){console.log('err');}
        })
    }

    function refreshAdminsMessage($id_from, $id_into)
    {
        $.ajax({
            url: basePath + 'ajax/chat_isAdmin_refresh',
            async: true, type: 'POST', dataType: 'html',
            data: {id_from: $id_from, id_into: $id_into},
            'success' : function(data)
            {
                console.log(data);

                if(data == '1')
                {
                    $('.chat-wrapper').scrollTop(99999);
                }
            },
            'error' : function(){console.log('err');}
        })
    }
})