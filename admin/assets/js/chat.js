jQuery(document).ready(function(){

    setInterval(function(){addNewChats()},2000);
    setInterval(function(){refreshChat()},3000);

    var $first = true;

    $(document).on('click','.chat-close',function(){

        //console.log('qqqq');
        var $this = $(this);
        var $token = $(this).parent('.support-chat').attr('data-token');
        $.ajax({
            url: basePath + 'ajax/closeChat',
            dataType: 'html', type: 'POST',
            data: {token: $token},
            'success': function(data){
                $this.parent('.support-chat').remove();
            }
        })

    })

    $(document).on('keypress','[name="chat-message"]',function(e){
        if(e.keyCode == 13)
        {
            var $token      = $(this).parent('.support-chat').attr('data-token');
            var $message    = $(this).val();
            $(this).val('');

            $.ajax({
                url: basePath + 'ajax/sendMessage',
                async: "true", dataType: "html", type: "POST",
                data: {token: $token, message: $message},
                'success': function(data){
                    //console.log($token);
                    refreshOneChat($token);
                }
            })
        }

    })

    function addNewChats()
    {
        var $tokens = [];
        var $token  = "";

        $('.support-chat').each(function(){
            $token = $(this).attr('data-token');
            $tokens.push($token);
        })

        $.ajax({
            url: basePath + 'ajax/getNewChatTokens',
            async: "true", dataType: "json", type: "POST",
            data:{tokens: $tokens},
            'success': function(data){
                //console.log(data);
                $.each(data, function(key, val){
                    $.ajax({
                        url: basePath + 'ajax/getNewChat',
                        async: "true", dataType: "html", type: "POST",
                        data:{token: val.token},
                        'success': function(data){
                            $('.all-chat-wrapper').append(data);
                            $('[data-token="' + val.token + '"]').find('.chat-wrapper').scrollTop(99999);
                        }
                    })
                })
            }
        })
    }


    function refreshChat()
    {
        $('.support-chat').each(function(){
            var $token          = "";
            $token          = $(this).attr('data-token');

            if($first)
            {
                $(this).find('.chat-wrapper').scrollTop(99999);
            }
            refreshOneChat($token);
        })

        $first = false;
    }

    function refreshOneChat($token)
    {
        var $main_obj = $('[data-token="' + $token + '"]');

        var $last_id        = 0;
        var $old_last_id    = 0;

        $old_last_id    = $main_obj.attr('data-last-id');

        $.ajax({
            url: basePath + 'ajax/refreshChat',
            async: "true", dataType: "html", type: "POST",
            data:{token: $token},
            'success': function(data){
                var $obj = $('<div />').html(data);
                $main_obj.find('.chat-message').html($obj.find('.chat-message').html());
                $last_id = $obj.find('.support-chat').attr('data-last-id');
                $main_obj.attr('data-last-id',$last_id);

                $.ajax({
                    url: basePath + 'ajax/checkNewMessage',
                    async: "true", dataType: "html", type: "POST",
                    data: {token: $token, id_from: $old_last_id, id_into: $last_id},
                    'success': function(data){
                        if(data == '1')
                        {
                        //console.log($main_obj.find('div.chat-message'));
                            $main_obj.find('div.chat-wrapper').scrollTop(99999);
                        }
                    }
                })
            }
        })
    }
})