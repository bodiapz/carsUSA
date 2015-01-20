<div class="table-products-wrapper">

    <table class="table table-products hidden-xs">
        <thead>
            <tr>
                <th>№</th>
                <th><?php $this->translate('Зображення'); ?></th>
                <th><?php $this->translate('Назва'); ?></th>
                <th><?php $this->translate('Розміщення'); ?></th>
                <!--<th><?php $this->translate('Статус продажу'); ?></th>-->
                <th>Одометр</th>
                <th><?php $this->translate('Поточна ставка'); ?></th>
                <th><?php $this->translate('До кінця акуціону'); ?></th>
            </tr>
        </thead>

        <tbody>
        <?php $counter = 0; $class = 'even'; if(!empty($cars)) : ?>
            <?php foreach($cars as $key => $car) : if($key == 'pagination') continue; $counter++; ?>
                <?php if(count($car) > 1) : ?>
                    <tr class="<?php echo $class; ?>">
                        <td><?php echo $counter + (((int)$current - 1) * 20); ?></td>
                        <td><a class="link-product" href="<?php $this->location('search/page/' . $car['data']->LotNumber); ?>"><img src="<?php echo $car['image']; ?>" alt="<?php if(!empty($car['fullname'])) echo $car['fullname']; else $this->translate('Не вказано'); ?>"></a></td>
                        <td><a class="link-product-name color" href="<?php $this->location('search/page/' . $car['data']->LotNumber); ?>"><?php if(!empty($car['fullname'])) echo $car['fullname']; else $this->translate('Не вказано'); ?></a></td>
                        <td><?php if(!empty($car['location'])) echo trim($car['location']); else $this->translate('Не вказано'); ?></td>
                        <!--<td><?php if(!empty($car['location'])) echo substr($car['location'], 13); else $this->translate('Не вказано'); ?></td>-->
                        <td><?php if(!empty($car['millage'])) echo $car['millage']; else $this->translate('Не вказано'); ?></td>
                        <td><?php if(!empty($car['data']->DisplayBidAmount)) echo $car['data']->DisplayBidAmount; else $this->translate('Не вказано'); ?></td>
                        <td><?php if(!empty($car['timeLeft']) && trim($car['timeLeft']) != '0D 8H 14min') echo trim($car['timeLeft']); else $this->translate('Не вказано'); ?></td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td colspan="200" class="text-info text-center"><?php $this->translate($this->langVars['Не знайдено результатів по Вашому запиту']); ?></td>
                    </tr>
                <?php endif; ?>
            <?php if($class === 'even') $class = 'odd'; else $class = 'even'; endforeach; ?>

        <?php endif; ?>
        </tbody>
    </table>

    <table class="table table-products hidden-lg hidden-md">
        <thead>
        <tr>
            <th>№</th>
            <th><?php $this->translate('Зображення'); ?></th>
            <th><?php $this->translate('Назва'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php $counter = 0; $class = 'even'; if(!empty($cars)) : ?>
            <?php foreach($cars as $key => $car) : if($key == 1 || $key == 'pagination') continue; $counter++; ?>
                <?php if(count($car) > 1) : ?>
                    <tr class="<?php echo $class; ?>">
                        <td><?php echo $counter + (((int)$current - 1) * 20); ?></td>
                        <td><a class="link-product" href="<?php $this->location('search/page/' . $car['data']->LotNumber); ?>"><?php echo $car['image']; ?></a></td>
                        <td><a class="link-product-name color" href="<?php $this->location('search/page/' . $car['data']->LotNumber); ?>"><?php if(!empty($car[0])) echo $car[0]; else $this->translate('Не вказано'); ?></a></td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td colspan="200" class="text-info text-center"><?php $this->translate($this->langVars['Не знайдено результатів по Вашому запиту']); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if($class === 'even') $class = 'odd'; else $class = 'even'; endforeach; ?>

        <?php endif; ?>
        </tbody>
    </table>

    <?php if(!empty($cars['pagination'])) : $counter = 0;?>
        <nav class="myPaginationBarWrapper">
            <div class="myPaginationBar">

                <?php foreach($cars['pagination'] as $key => $page) : ?>
                    <?php //if(!empty($page)) : ?>

                            <div class="pagination-item pull-left <?php if($key == $current) echo "active"; ?>">
                                <form action="<?php $this->location('search'); ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" value="<?php echo $page; ?>" name="pagination-handler">
                                    <button class="<?php if($key == $current) echo "active"; ?>" type="submit"><?php echo $key; ?></button>
                                </form>
                            </div>

                    <?php //endif; ?>
                <?php endforeach; ?>
                <div class="clearfix"></div>

            </div>
        </nav>
    <?php endif; ?>

</div>


<?php //echo "<pre>";print_r($cars);echo "</pre>"; ?>