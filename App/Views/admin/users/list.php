<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box" id="users-list">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manage your Users</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Group</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Join date</th>
                                <th>Action</th>
                            </tr>
                            <!--Now we gotta get our hands dirty-->
                            <?php
                            $i = 1;
                            foreach ($users as $user) {
                                $id   = $user->id;
                                $ugid = $user->ugid;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $user->name; ?></td>
                                    <td><?php echo $user->group; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo ucfirst($user->status); ?></td>
                                    <td><?php echo date('Y-m-d', $user->created); ?></td>
                                    <td>
                                        <?php if ($ugid === '1' && $admin_id !== '1' && $admin_id !== $id) { ?>
                                            <button type="button" class="btn btn-info disabled" disabled="disabled">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Edit</button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-info edit-form"
                                                    data-modal-target="#edit-user-form"
                                                    data-target="<?php echo url('/admin/users/edit/') . '/' . $id; ?>" >
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Edit</button>
                                        <?php }if ($id === "1") { ?>
                                            <button type="button" class="btn btn-danger disabled" disabled="disabled"
                                                    >
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                Delete</button>
                                            <?php
                                        } else {
                                            if ($ugid === '1' && $admin_id !== '1') {
                                                ?>
                                                <button type="button" class="btn btn-danger disabled" disabled="disabled"
                                                        >
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    Delete</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-danger delete"
                                                        data-target="<?php echo url('/admin/users/delete/') . '/' . $id; ?>"
                                                        >
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    Delete</button>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->