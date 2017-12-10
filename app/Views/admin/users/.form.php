<div class="modal fade" id="add-user-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add A New User</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                    <div id="form-results"></div>
                    <div class="form-group col-sm-6">
                        <label for="username">Username</label>
                        <input type="text" name="name" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="someone@example.com">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" class="form-control" name="pass" placeholder="Choose a password">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="re-pass">Confirm Password</label>
                        <input type="password" id="re-pass" class="form-control" name="re-pass" placeholder="Re-Type password">
                    </div>
                    <?php if ($admin === '1') { ?>
                        <div class="form-group col-sm-6">
                            <label for="group">Group</label>
                            <select id="group" name="ugid" class="form-control">
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="form-group col-sm-6">
                        <label for="status">Status</label>
                        <select id="status" class="form-control" name="status">
                            <option value="enabled">Enable</option>
                            <option value="disabled" selected="">Disable</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-6">
                        <label for="img">Profile photo</label>
                        <input type="file" id="img" name="img">
                    </div>
                    <div class="clearfix"></div>
                    <button id="submit-btn" class="btn btn-info submit-btn">Submit</button>
                    <input type="hidden" name="code" value="<?php echo $code; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>