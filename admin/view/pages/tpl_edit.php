<div class="with-nav-tabs">
    <div class="col-lg-12 col-md-12">
        <ul class="lang-nav pull-right">
            <li class="active btn-tab"><a href="#ua" data-toggle="tab">Українська</a></li>
            <li class="btn-tab"><a href="#ru" data-toggle="tab">Російська</a></li>
        </ul>

        <div class="clearfix"></div>
        <hr class="title-separator"/>
    </div>

    <div class="tab-content">
        <div class="tab-pane fade in active" id="ua">
            <div class="form-content">
                <form action="<?php $this->location('pages/edit/' . $page['id']); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group col-lg-4 col-md-4 col-lg-offset-3 col-md-offset-3">
                        <label>Назва</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($page['title'])) echo $page['title']; ?>">
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-7 col-md-7 col-lg-offset-3 col-md-offset-3">
                        <label>Текст</label>
                        <textarea name="text" class="form-control tinymce"><?php if(!empty($page['text'])) echo $page['text']; ?></textarea>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-4 col-md-4 col-lg-offset-3 col-md-offset-3">
                        <label>Адреса</label>
                        <input type="text" name="permalink" class="form-control" value="<?php if(!empty($page['permalink'])) echo $page['permalink']; ?>">
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-4 col-md-4 col-lg-offset-3 col-md-offset-3">
                        <label><input type="checkbox" name="status" value="1" <?php if($page['status'] == 1) echo 'checked'; ?>> Показувати</label>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-7 col-md-7 col-lg-offset-3 col-md-offset-3">
                        <input type="submit" class="btn btn-primary pull-right" value="Зберегти">
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="ru">
            <div class="form-content">
                <form action="<?php $this->location('pages/edit/' . $page['id']); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group col-lg-4 col-md-4 col-lg-offset-3 col-md-offset-3">
                        <label>Назва</label>
                        <input type="text" name="ru_title" class="form-control" value="<?php if(!empty($page['ru_title'])) echo $page['ru_title']; ?>">
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-7 col-md-7 col-lg-offset-3 col-md-offset-3">
                        <label>Текст</label>
                        <textarea name="ru_text" class="form-control tinymce"><?php if(!empty($page['ru_text'])) echo $page['ru_text']; ?></textarea>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-7 col-md-7 col-lg-offset-3 col-md-offset-3">
                        <input type="submit" class="btn btn-primary pull-right" value="Зберегти">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
