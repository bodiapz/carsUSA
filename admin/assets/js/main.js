jQuery(document).ready(function() {

	// initialization dataTables
    $('#dataTable').dataTable();

    // initialization tinymce
	tinymce.init({
        selector:   ".tinymce",
        theme:      "modern",
        plugins :   'lists hr code textcolor advlist table autolink link image lists charmap print preview filemanager emoticons',
        toolbar: "hr | code | bullist | numlist | forecolor | backcolor | fontselect |  fontsizeselect | alignleft aligncenter alignright justifycenter| indent outdent | undo redo | styleselect | bold italic underline| link image",
        tools: "inserttable emoticons",
        image_advtab: true,
        content_css: '/Mike/machinery/assets/css/docs.css',
        height : 300,
        mode : "textareas"
    });

	$(document).on('click', '.change-status', function(event){
        var $this  = $(this);
        var table  = $this.attr('data-table');
        var id     = $this.attr('data-id');
        var status = $this.attr('data-status');
        var column = $this.attr('data-column');

        if(status == 0){
            if (confirm('Справді видалити?')) {
                $.ajax({
                    url: basePath + 'ajax/change_status',
                    async: true, type: 'POST', dataType: 'html',
                    data: {table : table, id : id, status : status, column : column},
                    'success' : function(data)
                    {
                        //window.location.reload();
                    }
                });
            }
        }
        else{
            $.ajax({
                url: basePath + 'ajax/change_status',
                async: true, type: 'POST', dataType: 'html',
                data: {table : table, id : id, status : status, column : column},
                'success' : function(data)
                {
                    //window.location.reload();
                }
            });
        }

    });


    uploadPhoto('slides/');

    $('.fileupload-trigger').on('click', function(){
        $('#fileupload').click();
    });

    var adding = false;
    $(document).keyup(function(e) {
        if(adding == true)
            if (e.keyCode == 27) { window.location.reload();}   // esc
    });

    /*SLIDER EDITOR FUNCTIONS*/
    $(document).on('click', '.slider-editor-add-label', function(event){
        $('.slider-editor-add-label').hide();
        adding = true;
        $('body').append('<div class="slider-editor-add-1"></div>');
    });

    $(document).on('click', '.slider-editor-save-label', function(event){
        saveLabel(slideId, startFrom, moveTo, $('.slider-editor-add-3').val(), $('[name="duration"]').val(), $('[name="class"]').val());
    });

    $(document).on('click', '.delete-slide', function(event){
        event.preventDefault();

        if (confirm('Справді видалити?')) {
            deleteSlide(parseInt($(this).attr('data-id')));
            $(this).parent().slideUp();
        }
    });

    $(document).on('click', '.delete-label', function(event){
        event.preventDefault();

        if (confirm('Справді видалити?')) {
            deleteLabel(parseInt($(this).attr('data-id')));
            $(this).parent().parent().parent().parent().parent().slideUp();
        }
    });

    $(document).on('click', '.edit-label', function(event){
        event.preventDefault();

        if (confirm('Справді видалити?')) {
            deleteLabel(parseInt($(this).attr('data-id')));
            $(this).parent().parent().parent().parent().parent().slideUp();
        }
    });


    var startFrom = 0;
    var moveTo = 0;

    $(document).on('mousemove', 'body', function( event ) {
		if($('.slide-image').length > 0){
			var imageHeight = $('.slide-image').height();
			var imageWidth = $('.slide-image').width();
			var sliderPosition = $('.slide-image').offset();
			var posotionX = event.pageX - sliderPosition.left;
			var posotionY = event.pageY - sliderPosition.top;
			var percX = posotionX / imageWidth * 100;
			var percY = posotionY / imageHeight * 100;

			if($( ".slider-editor-add-1").length > 0 ) {
				$(".slider-editor-add-1").css({'background': '#fff', 'top': event.clientY, 'left': event.clientX + 20});
				$(".slider-editor-add-1").text('Стартова позиція | ' + Math.round(percX) + ';' + Math.round(percY) + '');
			}

			if($( ".slider-editor-add-2").length > 0) {
				$(".slider-editor-add-2").css({'background': '#fff', 'top': event.clientY, 'left': event.clientX + 20});
				$(".slider-editor-add-2").text('Фінішна позиція | ' + Math.round(percX) + ';' + Math.round(percY) + '');
			}
		}
    });



    $(document).on('click', 'body', function(){
        if($(".slider-editor-add-1").length > 0 && $('.slider-editor-add-label').length == 0) {
            startFrom = $( ".slider-editor-add-1").text();
            console.log(startFrom);
            $(".slider-editor-add-1").remove();
            $('body').append('<div class="slider-editor-add-2"></div>');
            return false;
        }

        if($(".slider-editor-add-2").length > 0 && startFrom != 0) {
            moveTo = $( ".slider-editor-add-2").text();
            console.log(moveTo);
            $(".slider-editor-add-2").remove();
            $('.slider-settings').append('<div class="form-group col-lg-3"><input class="slider-editor-add-3" placeholder="Текст" id="form-control"></div><div class="form-group col-lg-3"><input type="number" min="0" value="1" name="duration" class="form-control"></div><div class="form-group col-lg-3"><input type="text" min="0" value="small" name="class" class="form-control"></div><div class="form-group col-lg-3"><button class="slider-editor-save-label btn btn-primary col-lg-12">Зберегти</button></div>');
            return false;
        }

        if($(".slider-editor-add-1").length > 0)
            $('.slider-editor-add-label').remove();
    });

});




/**Upload photo*/
function uploadPhoto(addPath) {
    //alert();
    'use strict';
    var path =  '/files/' + addPath + '/';
    var url = basePath + 'files/index.php';

    $('#fileupload').fileupload({
        url: url, dataType: 'json',
        formData: [{ name: 'custom_dir', value: path}],
        add: function (e, data) {
            //alert();
            var goUpload = true;

            var uploadFile = data.files[0];
            if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(uploadFile.name)) { //TEST FOR SUPPORTED FORMATS
                alert(uploadFile.name + ' has wrong format');			//ALERT WRONG FORMAT
                goUpload = false;
            }
            if (uploadFile.size > 5000000) { 							// FILE SIZE
                alert(uploadFile.name + ' must be lower then 5 mb');	// ALERT IF OVERSIZED
                goUpload = false;
            }
            if (goUpload == true) {                                     //IF ALL OK TRUNSFER FILE
                data.submit();
            }
        },
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                setSlideImage(file.name);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.progress-bar').css('width', progress + '%');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
};

function setSlideImage(fileName){
    $.ajax({
        url: basePath + 'ajax/addSlide',
        async: true, type: 'POST', dataType: 'html',
        data: {fileName : fileName},
        'success' : function(data)
        {
            $('.slider-container .row .col-lg-12').append(data);
        }
    });
}

function saveLabel(slideId, startFrom, moveTo, labelText, duration, $class){
    $.ajax({
        url: basePath + 'ajax/addLabel',
        async: true, type: 'POST', dataType: 'html',
        data: {slideId : slideId, startFrom : startFrom, moveTo : moveTo, labelText : labelText, duration : duration, class : $class},
        'success' : function(data)
        {
            $('.slider-settings').html('');
            $('.slide-labels').append(data);
        }
    });
}

function deleteLabel(labelId){
    $.ajax({
        url: basePath + 'ajax/deleteLabel',
        async: true, type: 'POST', dataType: 'html',
        data: {labelId : labelId},
        'success' : function(data)
        {
            $('.slider-settings').append(data);
        }
    });
}

function deleteSlide(slideId){

    $.ajax({
        url: basePath + 'ajax/deleteSlide',
        async: true, type: 'POST', dataType: 'html',
        data: {slideId : slideId},
        'success' : function(data)
        {
            $('body').append(data);
        }
    });
}