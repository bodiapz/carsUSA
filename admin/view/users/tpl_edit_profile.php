<div>
    <?php if(!empty($errors)) : ?>
        <div class="regostration-final-error">
            <?php foreach($errors as $error) : ?>
                <span class="text-danger font-size16"><?php echo $error; ?></span><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="create-view">

    <form method="post" action="<?php echo $this->basePath . 'user/edit_profile/' . $user_id; ?>">

        <div class="choose-your-look">
            <span class="choose-your-look-title">Choose your looks</span>
            <div class="choose-your-look-row">
                <?php if(!empty($looks['hair'])) : ?>
                    <?php foreach($looks['hair'] as $key => $look) : ?>
                        <input type="submit" name="hair" value="<?php echo $look['info'];?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="choose-your-look-row">
                <?php if(!empty($looks['face'])) : ?>
                    <?php foreach($looks['face'] as $key => $look) : ?>
                        <input type="submit" name="face" value="<?php echo $look['info'];?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="choose-your-look-row">
                <?php if(!empty($looks['shirt'])) : ?>
                    <?php foreach($looks['shirt'] as $key => $look) : ?>
                        <input type="submit" name="shirt" value="<?php echo $look['info'];?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="choose-your-look-row">
                <?php if(!empty($looks['pants'])) : ?>
                    <?php foreach($looks['pants'] as $key => $look) : ?>
                        <input type="submit" name="pants" value="<?php echo $look['info'];?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="choose-your-look-row-last">
                <?php if(!empty($looks['footwear'])) : ?>
                    <?php foreach($looks['footwear'] as $key => $look) : ?>
                        <input type="submit" name="footwear" value="<?php echo $look['info'];?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="choose-your-color">
            <span class="choose-your-look-title">Choose color:</span>
            <div class="choose-your-color-row">
                <?php if(!empty($colors)) : $counter = 0;?>
                    <?php foreach($colors as $color) : $counter++;?>
                        <input type="submit" name="color-<?php echo $colorFor;?>" value="<?php echo $color['color'];?>">
                        <?php if($counter > 3) : echo'<br>';$counter = 0;endif;?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="curent-view">
            <span class="choose-your-look-title">Current Look</span>
            <br>

            <span>Hair: <?php echo $currentLook['hair']['info'];?></span>
            <span>Color: <?php echo $currentLook['hair']['color'];?></span>
            <br>
            <span>Face: <?php echo $currentLook['face']['info'];?></span>
            <span>Color: <?php echo $currentLook['face']['color'];?></span>
            <br>
            <span>Shirt: <?php echo $currentLook['shirt']['info'];?></span>
            <span>Color: <?php echo $currentLook['shirt']['color'];?></span>
            <br>
            <span>Pants: <?php echo $currentLook['pants']['info'];?></span>
            <span>Color: <?php echo $currentLook['pants']['color'];?></span>
            <br>
            <span>Footwear: <?php echo $currentLook['footwear']['info'];?></span>
            <span>Color: <?php echo $currentLook['footwear']['color'];?></span>
            <br>
        </div>
    </form>

</div>