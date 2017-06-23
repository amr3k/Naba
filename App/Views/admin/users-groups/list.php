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
                  <h3 class="box-title">Manage your Users Groups</h3>
                  <button class="btn btn-danger pull-right popup" type="button" 
                          data-modal-target="#add-ug-form" 
                          data-target="<?php echo url('/admin/users-groups/add'); ?>">
                      Add New Users group</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Users group name</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $i  =   1;
                        foreach ($ugs as $ug){
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $ug->name; ?></td>
                        <td>
                            <button type="button" class="btn btn-info edit-form" 
                                    data-modal-target="#edit-ug-form"
                                    data-target="<?php echo url('/admin/users-groups/edit/') . '/' . $ug->id; ?>" >
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Edit</button>
                        <?php if ($ug->id === "1"){ ?>
                            <button type="button" class="btn btn-danger disabled" disabled="disabled"
                                    >
                                <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                Delete</button>
                            <?php }else { ?>
                                <button type="button" class="btn btn-danger delete" 
                                    data-target="<?php echo url('/admin/users-groups/delete/') . '/' . $ug->id; ?>"
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