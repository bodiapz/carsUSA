
<div class="col-lg-12 col-md-12">
    <h1 class="page-name size28 h1"><?php $this->print_s($page[$this->prefix . 'title']); ?></h1>
    <div class="page-name-horizontal"></div>
</div>

<div class="clearfix"></div>

<?php if($page['permalink'] == 'contact') : ?>

    <?php include ('view/page/tpl_contact.php'); ?>

    <div class="col-lg-12 col-md-12">
        <p><?php echo $page[$this->prefix . 'text']; ?></p>
    </div>

<?php else : ?>

    <div class="col-lg-12 col-md-12">
        <p><?php echo $page[$this->prefix . 'text']; ?></p>
    </div>

<?php endif; ?>
