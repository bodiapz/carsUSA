<?php include ('view/layout/tpl_head.php'); ?>

    <body>
        
        <?php include ('view/layout/tpl_header.php'); ?>
        
        <?php if(isset($this->main)) : ?>
            <div class="container main-container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                        <?php include_once('view/widgets/sidebar.php'); ?>
                    </div>

                    <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12 border-left-separator">
                        <?php echo $render['content']; ?>
                    </div>
                </div>
            </div>

        <?php else : ?>

            <div class="container main-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <?php include_once('view/widgets/top_content.php'); ?>

                        <?php echo $render['content']; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            
        <?php endif; ?>

        <?php include ('view/layout/tpl_footer.php'); ?>

        <?php include ('view/widgets/chat.php'); ?>

        <?php include ('view/widgets/registration.php'); ?>

        <?php include ('view/widgets/login.php'); ?>

        <script type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/jquery.js"></script>
        <script type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/bootstrap.js"></script>

        <?php $this->printJs(); ?>

        <script async="" type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/main.js"></script>
        <script async="" type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/chat.js"></script>


        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();

				$(document).on('keyup', '[name="phone"]', function() {
					var $this = $(this);
					var $text = $this.val();

					if(    $text.match(/[0][5][0][0-9]{7}$/)
						|| $text.match(/[0][6][3][0-9]{7}$/)
						|| $text.match(/[0][6][6][0-9]{7}$/)
						|| $text.match(/[0][6][7][0-9]{7}$/)
						|| $text.match(/[0][6][8][0-9]{7}$/)
						|| $text.match(/[0][7][3][0-9]{7}$/)
						|| $text.match(/[0][9][1][0-9]{7}$/)
						|| $text.match(/[0][9][2][0-9]{7}$/)
						|| $text.match(/[0][9][3][0-9]{7}$/)
						|| $text.match(/[0][9][4][0-9]{7}$/)
						|| $text.match(/[0][9][5][0-9]{7}$/)
						|| $text.match(/[0][9][6][0-9]{7}$/)
						|| $text.match(/[0][9][7][0-9]{7}$/)
						|| $text.match(/[0][9][8][0-9]{7}$/)
						|| $text.match(/[0][9][9][0-9]{7}$/)
					)
					{
						$('[name="phone"]').tooltip('hide');
						$this.removeClass('red-tooltip');
					}
					else{
						$('[name="phone"]').attr('data-original-title', '<?php $this->translate('Вкажіть правильний телефон в форматі'); ?> 0501234567').tooltip({placement: 'right',trigger: 'manual'}).tooltip('show');
						$this.addClass('red-tooltip');
					}
				});


            })
        </script>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-58418905-1', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>