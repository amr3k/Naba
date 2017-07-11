<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Posts
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Posts</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box" id="posts">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manage Comments</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Author</th>
                                <th>Post</th>
                                <th>Comment</th>
                                <th>Publish date</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($comments as $comment) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $comment->author; ?></td>
                                    <td>
                                        <?php if ($comment->post_status === 'enabled') {
                                            ?>
                                            <a href="<?php echo url('post') . '/' . $comment->post_id . '#comments'; ?>"
                                               target="_blank">
                                                   <?php echo $comment->title; ?>
                                            </a>
                                        <?php } else {
                                            ?>
                                            <?php echo $comment->title; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo read_more($comment->comment, 6); ?></td>
                                    <td><?php echo date('Y-m-d', $comment->created); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete"
                                                data-target="<?php echo url('/admin') . '/' . $comment->id . '/comments/delete/'; ?>">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            Delete
                                        </button>
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