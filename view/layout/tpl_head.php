<!DOCTYPE html>
<html>
    <head>
        <title><?php $this->print_s($this->configData['config']['title']); ?> :: <?php if(!empty($this->meta['title'])) echo $this->meta['title']; else echo 'Доставка автомобілів з США'; ?></title>

        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description"    content="<?php if(!empty($this->meta['description'])) echo $this->meta['description']; else $this->print_s($this->configData['config']['description']); ?>"/>
        <meta name="keywords"       content="<?php if(!empty($this->meta['keywords'])) echo $this->meta['keywords']; else $this->print_s($this->configData['config']['keywords']); ?>"/>

        <link rel="icon" type="image/png" href="/favicon.ico">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->basePath; ?>assets/css/bootstrap.css">

        <?php $this->printCss(); ?>
        <script>
            var basePath = '<?php echo $this->basePath; ?>';
        </script>

    </head>