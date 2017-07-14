<!-- Breadcrumb -->
<ul class="breadcrumb box">
    <li>
        <a href="<?php echo url('/'); ?>">Home</a>
    </li>
    <li>
        <a href="<?php echo url('/category/' . seo($post->category) . '/' . $post->cid); ?>"><?php echo $post->category; ?></a>
    </li>
    <li class="active"><?php echo $post->title; ?></li>
</ul>
<!-- /Breadcrumb -->
<!-- Main Content -->
<div class="col-sm-9 col-xs-12" id="main-content">
    <!-- Post Page -->
    <div id="post-page">
        <!-- Post Box -->
        <div class="box post-box wow fadeIn" data-wow-duration="3s">
            <div class="post-content">
                <div class="social-icons pull-right">
                    <a href="#" class="facebook">
                        <span class="fa fa-facebook"></span>
                    </a>
                    <a href="#" class="twitter">
                        <span class="fa fa-twitter"></span>
                    </a>
                    <a href="#" class="google">
                        <span class="fa fa-google-plus"></span>
                    </a>
                </div>
                <h1 class="heading"><a href="<?php echo url('/post/' . $post->id); ?>"><?php echo $post->title; ?></a></h1>
                <div class="date-container">
                    <span class="fa fa-calendar"></span>
                    <span class="date"><?php echo date('d-m-Y', $post->created) . ' At ' . date('h:i A', $post->created); ?></span>
                    <span style="margin-left: 25%">
                        <i class="fa fa-fire" style="color: orange;font-size: 1.25em;margin-right: 0px;"></i>
                        <span style="color: black; margin-left: 0px"><?php echo $post->views; ?></span>
                    </span>
                </div>
                <?php if ($ugid === '1') { ?>
                    Actions
                    <a href="<?php echo url('/admin/posts/edit/') . '/' . $post->id; ?>"
                       class="btn btn-info edit-form">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Edit</a>
                    <button type="button" class="btn btn-danger delete"
                            data-target="<?php echo url('/admin/posts/delete/') . '/' . $post->id; ?>"
                            >
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        Delete</button>
                <?php } ?>
                <div class="clearfix"></div>
                <div class="image-box">
                    <img src="<?php echo assets('uploads/img/posts/' . $post->img); ?>" alt="<?php echo $post->title; ?>" />
                </div>
                <p class="details">
                    <?php echo htmlspecialchars_decode($post->text, ENT_QUOTES); ?>
                </p>
                <!-- Tags -->
                <div class="tags">
                    <h3 class="tag-title">Read more about:</h3>
                    <?php
                    $tags = explode(',', $post->tags);
                    foreach ($tags as $tag) {
                        ?>
                        <a class="tag" href="<?php echo url('/tag') . '/' . trim($tag); ?>"><?php echo trim($tag); ?></a>
                        <?php
                    }
                    ?>
                </div>
                <!-- / Tags -->
            </div>
            <div id="post-author">
                <div class="author-image">
                    <a href="<?php echo url('author') . '/' . $post->name; ?>">
                        <img src="<?php echo assets('uploads/img/avatar/' . $post->userImage); ?>" alt="<?php echo $post->userImage . '\'s photo'; ?>" />
                    </a>
                </div>
                <div>
                    <h3 class="name"><?php echo $post->name; ?></h3>
                    <p class="author-detials"><?php echo $post->bio; ?></p>
                </div>
            </div>
        </div>
        <!--/ Post Box -->
        <!-- Comments -->
        <div id="comments" class="box">
            <!-- Total Comments -->
            <div id="total-comments">
                <span><?php echo count($post->comments); ?></span> Comments
            </div>
            <!--/ Total Comments -->
            <?php foreach ($post->comments AS $comment) { ?>
                <div class="comment">
                    <div class="author-image">
                        <a href="<?php echo url('author') . '/' . $post->name; ?>">
                            <img src="<?php echo assets('uploads/img/avatar/' . $comment->userImage); ?> " alt="" />
                        </a>
                    </div>
                    <div class="comment-container">
                        <?php if ($ugid === '1') { ?>
                            <button type="button" class="btn btn-danger delete" style="float: right"
                                    data-target="<?php echo url('/admin/') . '/' . $comment->id . '/comments/delete'; ?>"
                                    >
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Delete
                            </button>
                        <?php } ?>
                        <div class="author-name">
                            <?php echo $comment->name; ?>
                        </div>
                        <div class="comment-date">
                            <?php echo date('d-m-Y', $comment->created) . ' At ' . date('h:i A', $comment->created); ?>
                        </div>
                        <div class="comment-text">
                            <?php echo $comment->comment; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!--/ Comments -->
        <!-- Comment Form -->
        <form action="<?php echo url('/post/' . $post->id . '/add-comment'); ?>" method="post" id="comment-form" class="box">
            <h3 class="heading">Post Comment</h3>
            <?php if ($user) { ?>
                <textarea name="comment" id="comment" class="input" placeholder="Post Your Comment" cols="30" rows="5" required="required"></textarea>
            <?php } else { ?>
                <textarea class="input" placeholder="Please Login to comment on this" cols="30" rows="5" required="required" disabled=""></textarea>
            <?php } ?>
            <button class="comment-button">Submit</button>
        </form>
        <!--/ Comment Form -->
    </div>
    <!--/ Post Page  -->
</div>
<!--/ Main Content -->