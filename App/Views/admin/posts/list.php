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
                        <h3 class="box-title">Manage your Posts</h3>
                        <a href="<?php echo url('/admin/posts/add'); ?>" class="btn btn-success pull-right popup">
                            Add A New Post</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Publish date</th>
                                <th>Comments</th>
                                <th>Views</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($posts as $post) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <?php if ($post->status === 'enabled' && $post->category_status === 'enabled') { ?>
                                            <a href="<?php echo url('/post') . '/' . $post->id; ?>" target="_blank"><?php echo $post->title; ?></a>
                                            <?php
                                        } else {
                                            ?>
                                            <?php echo $post->title; ?>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($post->category_status === 'enabled') { ?>
                                            <a href="<?php echo url('/category') . '/' . $post->category . '/' . $post->cid; ?>" target="_blank"><?php echo $post->category; ?></a>
                                        <?php } else { ?>
                                            <?php echo $post->category; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($post->author_status === 'enabled') { ?>
                                            <a href="<?php echo url('/author') . '/' . $post->author; ?>" target="_blank"><?php echo $post->author; ?></a>
                                        <?php } else { ?>
                                            <?php echo $post->author; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="<?php echo $post->status === 'disabled' ? 'color:red' : NULL; ?>"><?php echo ucfirst($post->status); ?></td>
                                    <td><?php echo date('Y-m-d', $post->created); ?></td>
                                    <td><?php if ($post->total_comments > 0 && $post->author_status === 'enabled' && $post->status === 'enabled' && $post->category_status === 'enabled') { ?>
                                            <a href="<?php echo url('/post') . '/' . $post->id . '#comments'; ?>"
                                               class="btn btn-default"
                                               target="_blank">
                                                <?php echo $post->total_comments; ?></a>
                                        <?php } else { ?>
                                            <span class="btn btn-default disabled"><?php echo $post->total_comments; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $post->views; ?></td>
                                    <td>
                                        <a href="<?php echo url('/admin/posts/edit/') . '/' . $post->id; ?>"
                                           class="btn btn-info edit-form">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            Edit</a>
                                        <button type="button" class="btn btn-danger delete"
                                                data-target="<?php echo url('/admin/posts/delete/') . '/' . $post->id; ?>"
                                                >
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            Delete</button>
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