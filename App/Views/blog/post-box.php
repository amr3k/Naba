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
        <h1 class="heading">
            <a href="<?php echo url('/post/' . $post->id); ?>"><?php echo $post->title; ?></a>
        </h1>
        <div class="date-container">
            <span class="fa fa-calendar"></span>
            <span class="date"><?php echo date('d-m-Y', $post->created) . ' At ' . date('h:i A', $post->created); ?></span>
            <span style="margin-left: 25%">
                <i class="fa fa-fire" style="color: orange;font-size: 1.25em;margin-right: 0px;"></i>
                <span style="color: black; margin-left: 0px"><?php echo $post->views; ?></span>
            </span>
        </div>
        <div class="clearfix"></div>
        <a href="<?php echo url('/post/' . $post->id); ?>" class="image-box">
            <img src="<?php echo assets('uploads/img/posts/' . $post->img); ?>" alt="<?php echo $post->title; ?>" />
        </a>
        <p class="details">
            <?php echo read_more(strip_tags(html_entity_decode($post->text)), 33); ?>
        </p>
        <a href="<?php echo url('/post' . '/' . $post->id); ?>" class="read-more">
            Read More
            <span class="fa fa-long-arrow-right"></span>
        </a>
    </div>

    <div class="post-box-footer">
        <a href="<?php echo url('/author') . '/' . $post->author; ?>" class="user">
            By:
            <span class="main"><?php echo $post->author; ?></span>
        </a>
        <a href="<?php echo url('/category') . '/' . $post->category . '/' . $post->cid; ?>" class="category">
            In:
            <span class="main"><?php echo $post->category; ?></span>
        </a>
        <a href="<?php echo url('/post/' . $post->id) . '#comments'; ?>" class="comments">
            <span class="main"><?php echo $post->total_comments; ?></span>
            Comments
        </a>
    </div>
</div>
<!--/ Post Box -->