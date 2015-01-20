
<?php if(!empty($ports)) : ?>
    <?php foreach($ports as $port) : ?>
        <option
            data-single_price="<?php $this->print_s($port['single_price']);?>"
            data-container_price="<?php $this->print_s($port['container_price']);?>"
            data-days_to="<?php $this->print_s($port['days_to']);?>"
            data-days_from="<?php $this->print_s($port['days_from']);?>"><?php $this->print_s($port[$this->prefix . 'name']);?></option>
    <?php endforeach; ?>
<?php else : ?>
    <option><?php $this->translate('Виберіть'); ?></option>
<?php endif;?>
