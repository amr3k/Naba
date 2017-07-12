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
                        <h3 class="col-xs-12">Edit <?php echo $title; ?></h3>
                        <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-sm-12">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Title" maxlength="30" value="<?php echo $title; ?>">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="editor">Text</label>
                                <textarea name="text" class="textarea form-control" id="editor" style="resize: vertical"><?php echo $text; ?></textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="tags">Tags (<span style="color: red">Separate with comma</span>)</label>
                                <input type="text" name="tags" class="form-control" id="tags" placeholder="Tags" value="<?php echo $tags; ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="category">Category</label>
                                <select id="category" name="category" class="form-control">
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category->id; ?>" <?php
                                        if ($category->name == $cat) {
                                            echo 'selected';
                                        }
                                        ?>><?php echo $category->name; ?>
                                        </option>
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
                                <label for="img">Post image</label>
                                <img src="<?php echo $img; ?>" style="max-height: 200px;max-width: 200px; display: block" alt="<?php echo $title; ?>" />
                                <br>
                                <input type="file" id="img" name="img">
                            </div>
                            <div class="clearfix"></div>
                            <div id="form-results"></div>
                            <div class="clearfix"></div>
                            <div class="col-sm-4">
                                <button class="btn btn-info save">Submit</button>
                            </div>
                            <input type="hidden" name="referer" value="<?php echo $referer; ?>" >
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->