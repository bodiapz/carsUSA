<h3 class="text-center">Редагування цін</h3>

<div class="offset-top-bottom-25"></div>

<?php if(!empty($zones)) : ?>
    <?php foreach($zones as $price) : ?>

        <form class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4 offset-top25px form-user-edit" action="<?php $this->location . 'pages/tariff_map/' . $price['id']; ?>" method="post">

            <div class="form-group">
                <label><?php echo $price['name']; ?></label>
                <input type="number" name="price" class="form-control" value="<?php if(!empty($price['price'])) echo $price['price']; ?>"/>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary pull-right" value="Зберегти"/>
                <div class="clearfix"></div>
            </div>

            <input type="hidden" name="id" value="<?php $this->print_s($price['id']); ?>">
        </form>

    <?php endforeach; ?>
<?php endif; ?>