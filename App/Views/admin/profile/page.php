<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
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
                        <h3 class="text-center" style="">Manage your profile</h3>
                        <br>
                        <image src="<?php echo $img; ?>" class="img-circle img-bordered"
                               style="width: 100px; height: 100px; margin-left: 46%" alt="<?php echo $user->name . '\'s photo'; ?>">
                        <br><br>
                        <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                            <div id="form-results"></div>
                            <div class="form-group col-sm-6">
                                <label for="username">Username</label>
                                <input type="text" name="name" class="form-control" id="username" placeholder="Username" value="<?php echo $user->name; ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control"
                                       name="email" placeholder="someone@example.com"
                                       value="<?php echo $user->email; ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="img">Change profile photo</label>
                                <input type="file" id="img" name="img">
                            </div>
                            <div class="clearfix"></div>
                            <button id="submit-btn" class="btn btn-info submit-btn">Submit</button>
                            <br><br>
                            <div style="border-bottom: 1px solid #000;"></div>
                            <br>
                            <h3 class="text-center">Change password</h3>
                            <br>
                            <div class="form-group col-sm-9">
                                <label for="old-pass">Old Password</label>
                                <input type="password" id="old-pass" class="form-control" name="old_pass" placeholder="Old Password">
                            </div>
                            <div class="form-group col-sm-9">
                                <label for="pass">New Password</label>
                                <input type="password" id="pass" class="form-control" name="pass" placeholder="Choose a password">
                            </div>
                            <div class="form-group col-sm-9">
                                <label for="re-pass">Confirm New Password</label>
                                <input type="password" id="re-pass" class="form-control" name="re-pass" placeholder="Re-Type password">
                            </div>
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