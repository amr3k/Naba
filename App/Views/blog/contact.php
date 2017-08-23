<br>
<div id="main-content" class="col-sm-9 col-xs-12">
    <div class="box wow post-box">
        <div class="post-content">
            <h1 class="heading">Contact</h1>
            <p>
                <?php
                echo htmlspecialchars_decode($contact);
                ?>
            </p>
            Contact us at :
            <a href="mailTo:<?php echo $site_email; ?>"><?php echo $site_email; ?></a>
        </div>
    </div>
</div>