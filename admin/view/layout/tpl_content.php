    <?php include ('view/layout/tpl_head.php'); ?>

    <body>

        <?php if(empty($_SESSION['user'])) : ?>

            <div class="col-lg-3 col-md-3 col-lg-offset-4 col-md-offset-4 col-xs-12 col-sm-12">
                <?php echo $render['content']; ?>
            </div>

        <?php else : ?>

            <?php include('view/layout/tpl_header.php'); ?>

            <div class="container main-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <?php echo $render['content']; ?>
                    </div>
                </div>
            </div>

            <?php //include_once ('view/layout/tpl_footer.php'); ?>
            <input id="fileupload" class="hidden" type="file" name="files[]" multiple="">

        <?php endif; ?>


        <script type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/jquery.js"></script>
        <script type="text/javascript"  src="<?php echo $this->basePath . '/'; ?>assets/js/vendor/jquery.ui.widget.js"></script>
        <script type="text/javascript"  src="<?php echo $this->basePath . '/'; ?>assets/js/jquery.iframe-transport.js"></script>
        <script type="text/javascript"  src="<?php echo $this->basePath . '/'; ?>assets/js/jquery.fileupload.js"></script>
        <script type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/bootstrap.js"></script>
        <script type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/dataTables.js"></script>
        <script type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/tinymce/tinymce.min.js"></script>

        <script type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/main.js"></script>
        <script type="text/javascript"  src="<?php echo $this->basePath; ?>assets/js/chat.js"></script>
        <?php if($this->slider) : ?><script type="text/javascript" src="<?php $this->location('assets/js/slider.js'); ?>" ></script><?php endif;?>
    </body>
</html>