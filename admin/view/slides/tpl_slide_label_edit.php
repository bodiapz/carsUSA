<div class="slider-label-" data-id="<?php echo $data['id']; ?>" data-text="<?php echo $data['text']; ?>" data-start_from="<?php echo $data['start_from']; ?>" data-move_to="<?php echo $data['move_to']; ?>" data-duration="<?php echo $data['duration']; ?>" data-class="<?php echo $data['class']; ?>">
    <table width="100%">
        <tr>
            <td width="17%"><span class="color-blue">Координати:</span> <span class="coords"><?php echo $data['start_from'] . ' | ' . $data['move_to']; ?></span></td>
            <td width="10%"><span class="color-blue">Тривалість:</span> <span class="duration"><?php echo $data['duration']; ?></span></td>
            <td width="60%"><span class="text"><?php echo $data['text']; ?></span></td>
            <td width="10%"><span class="text"><?php echo $data['class']; ?></span></td>
            <td width="3%"><i class="fa fa-edit edit-label" title="Редагувати"  data-id="<?php echo $data['id']; ?>"></i>&nbsp;<i class="fa fa-trash delete-label" title="Видалити" data-id="<?php echo $data['id']; ?>"></i></td>
        </tr>
    </table>
</div>