<div class="clearfix"></div>
</div>
<!--/ Content -->
<!-- Footer -->
<footer>
    <div class="copyrights">
        &copy;<?php echo date('Y') . ' <b>' . $title . '</b>'; ?> All Rights Reserved
    </div>
    <div class="social">
        <a href="<?php echo $facebook; ?>" target="_blank" class="facebook">
            <span class="fa fa-facebook"></span>
        </a>
        <a href="<?php echo $twitter; ?>" target="_blank" class="twitter">
            <span class="fa fa-twitter"></span>
        </a>
        <a href="<?php echo $instagram; ?>" target="_blank" class="instagram">
            <span class="fa fa-instagram"></span>
        </a>
        <!--        <a href="#" class="google">
                    <span class="fa fa-google-plus"></span>
                </a>
                <a href="#" class="youtube">
                    <span class="fa fa-youtube"></span>
                </a>
                <a href="#" class="pinterest">
                    <span class="fa fa-pinterest"></span>
                </a>
                <a href="#" class="rss">
                    <span class="fa fa-rss"></span>
                </a>-->
    </div>
</footer>
<!--/ Footer -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo assets('blog/js/jquery-3.1.1.min'); ?>"   crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo assets('blog/js/bootstrap.min.js'); ?>"></script>
<!-- WOW JS -->
<script src="<?php echo assets('blog/js/wow.min.js'); ?>"></script>
<!-- Custom JS -->
<script src="<?php echo assets('blog/js/custom.js'); ?>"></script>
<!-- Google ReCAPTCHA -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    // Navbar items
    var currentUrl = window.location.href;
    var segment = currentUrl.split('/').pop();
    $('#nav-' + segment).addClass('active');
// Deleting item
    $('.delete').on('click', function (e) {
        e.preventDefault();
        btn = $(this);
        c = confirm('Are you sure? This action cannot be undone !');
        if (c === true) {
            $.ajax({
                url: btn.data('target'),
                type: 'POST',
                dataType: 'json',
                success: function (r) {
                    window.location.href = r.redirectHome;
                }
            });
        } else {
            return false;
        }
    });
</script>
</body>
</html>