<div class="modal fade" id="edit-ad-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit <i><?php echo substr($link, 0, 20); ?></i></h4>
                <image src='<?php echo $img; ?>' style="height: 50px; width: 50px; border-radius: 100%" alt=''>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                    <div id="form-results"></div>
                    <div class="form-group col-sm-12">
                        <label for="link">Link</label>
                        <input type="text" name="link" class="form-control" id="link" placeholder="Link" value="<?php echo $link; ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="start">Start</label>
                        <input type="text" name="start" class="form-control" id="start" placeholder="Start" value="<?php echo $start; ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="end">End</label>
                        <input type="text" name="end" class="form-control" id="end" placeholder="End" value="<?php echo $end; ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="page">Pages</label>
                        <select id="page" name="page" class="form-control">
                            <option value=""></option>
                            <?php foreach ($pages as $page) { ?>
                                <option value="<?php echo $page; ?>" <?php
                                if ($page == $adPage) {
                                    echo 'selected=""';
                                }
                                ?>>
                                    <?php echo $page; ?></option>
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