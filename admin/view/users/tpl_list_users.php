
<table id="dataTable" class="table list-users">
    <thead>
    <tr>
        <th>#</th>
        <th>Email</th>
        <th>Статус</th>
        <th>Перевірений</th>
        <th>Дата реєстрації</th>
        <th>Дії</th>
    </tr>
    </thead>
    <tbody>
        <?php if(!empty($users)) : ?>
            <?php foreach($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><a href="mailto:<?php echo $user['email']; ?>" class="decoration"><i class="fa fa-envelope-o"></i> <?php echo $user['email']; ?></a></td>

                    <td><?php if($user['status'] == '1') : echo 'Активний'; else : echo 'Не активний';endif; ?></td>
                    <td><?php if($user['verify'] == 0) echo "Не перевірений"; else echo "Перевірений"; ?></td>
                    <td><?php $this->setDateFormat($user['created_at']); ?></td>
                    <td><!--
                        <ul class="actions">
                            <li><a href="<?php echo $this->basePath . 'user/edit/' . $user['id']; ?>" class="" title="Edit"><i class="fa fa-edit text-warning"></i></a></li>
                            <li><a href="<?php if($user['status'] == 1) : echo $this->basePath . 'user/suspend/' . $user['id'] . '/list_users'; else : echo $this->basePath . 'user/unsuspend/' . $user['id'] . '/list_users';endif; ?>" class="" title="<?php if($user['status'] == 1) : echo 'Заблокувати'; else : echo 'Розблокувати'; endif;?>"><i class="fa fa-trash-o text-danger"></i></a></li>
                            <li><a href="<?php echo $this->basePath . 'user/change_password/' . $user['id']; ?>" class="" title="Змінити пароль"><i class="fa fa-lock text-success"></i></a></li>
                            <li><a href="<?php echo $this->basePath . 'user/edit_profile/' . $user['id']; ?>" class="" title="Редагувати профіль"><i class="fa fa-user text-primary"></i></a></li>
                        </ul>-->
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php //echo "<pre>";print_r($users);echo "</pre>"; ?>