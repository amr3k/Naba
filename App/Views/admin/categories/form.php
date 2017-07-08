<div class="modal fade" id="add-category-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action; ?>" class="form-modal form" >
                    <div class="form-group col-sm-6">
                        <label for="cat-name">Category name</label>
                        <input type="text" name="name" class="form-control" id="cat-name" placeholder="Category name">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status" >
                            <option value="enabled">Enable</option>
                            <option value="disabled">Disable</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div id="form-results"></div>
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