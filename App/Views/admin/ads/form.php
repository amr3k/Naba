<div class="modal fade" id="add-ad-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <label for="title">Link</label>
                        <input type="text" name="link" class="form-control" id="link" placeholder="Link">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="start">Start</label>
                        <input type="text" name="start" class="form-control" id="start" placeholder="Start" value="<?php echo $date; ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="end">End</label>
                        <input type="text" name="end" class="form-control" id="end" placeholder="End" value="<?php echo $date; ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="page">Pages</label>
                        <select id="page" name="page" class="form-control">
                            <option value=""></option>
                            <?php foreach ($pages as $page) { ?>
                                <option value="<?php echo $page; ?>"><?php echo $page; ?></option>
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
                    <div class="clearfix"></div>
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