<table id="dataTable" class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Назва</th>
      <th>Адреса</th>
      <th>Дії</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($pages)) : ?>
    <?php foreach($pages as $page) : ?>
      <tr>
        <td><?php echo $page['id']; ?></td>
        <td><?php echo $page['title']; ?></td>
        <td><?php echo $page['permalink']; ?></td>
        <td>
          <ul class="actions">
            <li><a href="<?php $this->location('pages/edit/' . $page['id']); ?>"><i class="fa fa-edit"></i></a></li>
            <li><a class="change-status" href="javascript:void(0)" data-id="<?php echo $page['id']; ?>" data-table="pages" data-status="0" data-column="status"><i class="fa fa-trash"></i></a></li>
          </ul>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
  </tbody>
</table>