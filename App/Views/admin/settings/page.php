<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box" id="settings">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <h3>Manage settings (<span style="color: red">Use with caution</span>)</h3>
                        <form action="<?php echo $action; ?>" class="form" method="POST">
                            <div class="form-group col-sm-6">
                                <label for="name">Site name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Site name"
                                       value="<?php echo $site->name; ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="email">Site email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Site email"
                                       value="<?php echo $site->email; ?>">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="status">Site status</label><span>(Doesn't have an effect)</span>
                                <select id="status" class="form-control" name="status">
                                    <option value="on"
                                    <?php
                                    if ($site->status == 'on') {
                                        echo 'selected =""';
                                    }
                                    ?>
                                            >
                                        On</option>
                                    <option value="off"
                                    <?php
                                    if ($site->status == 'off') {
                                        echo 'selected =""';
                                    }
                                    ?>
                                            >Off</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-9">
                                <label for="msg">In case status is OFF, Choose an appropriate message that will be visible to visitors</label>
                                <input type="text" id="msg" name="msg" class="form-control" value="<?php echo $site->msg; ?>">
                            </div>
                            <div class="clearfix"></div>
                            <div id="form-results"></div>
                            <div class="clearfix"></div>
                            <button id="submit-btn" class="btn btn-info submit-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->