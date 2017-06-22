<div class="modal fade" id="edit-ug-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit <i><?php echo $name; ?></i></h4>
        </div>
        <div class="modal-body">
            <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                <div id="form-results"></div>
                <div class="form-group col-sm-12">
                  <label for="ug-name">Users-group name</label>
                  <input type="text" name="name" class="form-control" id="ug-name" placeholder="Users-group name" 
                         value="<?php echo $name; ?>">
                </div>
                <div class="form-group col-sm-12">
                    <label for="pages">Permissions</label>
                    <select id="pages" name="pages[]" class="form-control" multiple="">
                        <?php foreach ($pages as $page){ ?>
                        <option value="<?php echo $page; ?>" <?php if (in_array($page, $selected)){echo 'selected=""'; } ?> ><?php echo $page; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <br>
                <button class="btn btn-info submit-btn save">Save</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>