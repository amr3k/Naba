<div class="modal fade" id="add-post-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add A New Post</h4>

            </div>
            <div class="modal-body">
                <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                    <div id="form-results"></div>
                    <div class="form-group col-sm-12">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    <div id="cke_editor"
                         class="form-group col-sm-12">
                        <label for="editor">Text</label>
                        <textarea name="text" id="editor"></textarea>
                        <script>
//                            if (CKEDITOR.instances.editor) {
//                                CKEDITOR.instances.editor.destroy();
//                            }
                            CKEDITOR.replace('editor');
                        </script>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="tags">Tags (<span style="color: red">Separate with comma</span>)</label>
                        <input type="text" name="tags" class="form-control" id="tags" placeholder="Tags">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="form-control">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="status">Status</label>
                        <select id="status" class="form-control" name="status">
                            <option value="enabled">Enable</option>
                            <option value="disabled" selected="">Disable</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="img">Post image</label>
                        <input type="file" id="img" name="img">
                    </div>
                    <div class="clearfix"></div>
                    <button id="submit-btn" class="btn btn-info submit-btn" style="float: left">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>