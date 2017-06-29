<div class="modal fade" id="edit-post-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit <i><?php echo substr($title, 0, 20); ?></i></h4>
                <image src='<?php echo $img; ?>' style="height: 50px; width: 50px; border-radius: 100%" alt=''>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                    <div id="form-results"></div>
                    <div class="form-group col-sm-6">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="<?php echo $title; ?>">
                    </div>
                    <div id="cke_editor"
                         class="form-group col-sm-12">
                        <label for="editor">Text</label>
                        <textarea name="text" id="editor"><?php echo $text; ?></textarea>
                        <script>
//                            if (CKEDITOR.instances.editor) {
//                                CKEDITOR.instances.editor.destroy();
//                            }
                            CKEDITOR.replace('editor');
                        </script>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="tags">Tags (<span style="color: red">Separate with comma</span>)</label>
                        <input type="text" name="tags" class="form-control" id="tags" placeholder="Tags" value="<?php echo $tags; ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="form-control">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->id; ?>" <?php
                                if ($category->name == $cat) {
                                    echo 'selected';
                                }
                                ?>><?php echo $category->name; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="status">Status</label>
                        <?php
                        if ($status == 'disabled') {
                            ?>
                            <span style="color:red">Disabled</span>
                            <?php
                        }
                        ?>
                        <select id="status" class="form-control" name="status">
                            <option value="enabled" <?php
                            if ($status == 'enabled') {
                                echo 'selected=""';
                            }
                            ?>>Enable</option>
                            <option value="disabled"  <?php
                            if ($status == 'disabled') {
                                echo 'selected=""';
                            }
                            ?>>Disable</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="img">Profile photo</label>
                        <input type="file" id="img" name="img">
                    </div>
                    <div class="clearfix"></div>
                    <button id="submit-btn" class="btn btn-info submit-btn">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>