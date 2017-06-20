<div class="modal fade" id="edit-category-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit <i><?php echo $name; ?></i></h4>
        </div>
        <div class="modal-body">
            <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                <div id="form-results"></div>
                <div class="form-group col-sm-6">
                  <label for="cat-name">Category name</label>
                  <input type="text" name="name" class="form-control" id="cat-name" placeholder="Category name" 
                         value="<?php echo $name; ?>">
                </div>
                <div class="form-group col-sm-6">
                  <label for="status">Status : 
                      <?php if ($status === 'disabled') {?>
                      <span style="color: Red">Disabled</span>
                      <?php } ?>
                  </label>
                  <select name="status" class="form-control" id="status" >
                      <option value="enabled" <?php if ($status === 'enabled') {echo 'selected=""';} ?> >Enable</option>
                      <option value="disabled" <?php if ($status === 'disabled') {echo 'selected=""';} ?> >Disable </option>
                  </select>
                </div>
                <button class="btn btn-info submit-btn save">Save</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>