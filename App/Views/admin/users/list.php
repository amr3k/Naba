  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('/');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
                  <button class="btn btn-danger pull-right popup" type="button" 
                          data-modal-target="#add-user-form" 
                          data-target="<?php echo url('/admin/users/add'); ?>">
                      Add A New User</button>
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
                    <?php
                    $i  =   1;
                        foreach ($users as $user){
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->group; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo ucfirst($user->status); ?></td>
                        <td><?php echo date('Y-m-d', $user->created); ?></td>
                        <td>
                            <button type="button" class="btn btn-info edit-form" 
                                    data-modal-target="#edit-user-form"
                                    data-target="<?php echo url('/admin/users/edit/') . '/' . $user->id; ?>" >
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Edit</button>
                        <?php if ($user->id === "1"){ ?>
                            <button type="button" class="btn btn-danger disabled" disabled="disabled"
                                    >
                                <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                Delete</button>
                            <?php }else { ?>
                                <button type="button" class="btn btn-danger delete" 
                                    data-target="<?php echo url('/admin/users/delete/') . '/' . $user->id; ?>"
                                    >
                                <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                Delete</button>
                                <?php }?>
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
                  <!-- <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
          </div>
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->