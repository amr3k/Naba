<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2016 <a href="../http://www.aymanelash.com">Ayman Elash</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo assets('admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo assets('admin/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo assets('admin/plugins/morris/morris.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo assets('admin/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo assets('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?php echo assets('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo assets('admin/plugins/knob/jquery.knob.js'); ?>"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo assets('admin/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- datepicker -->
<script src="<?php echo assets('admin/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo assets('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo assets('admin/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo assets('admin/plugins/fastclick/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo assets('admin/dist/js/app.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo assets('admin/dist/js/pages/dashboard.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo assets('admin/dist/js/demo.js'); ?>"></script>
<script>
    // Displaying a form to add a new category
    $('.popup').on('click', function () {
        btn =   $(this);
        url =   btn.data('target');
        modalTarget =   btn.data('modal-target');
        if ($(modalTarget).length > 0){
            $(modalTarget).modal('show');
        }else {
            $.ajax({
                url : url,
                type : 'POST',
                success : function (html) {
                    $('body').append(html);
                    $(modalTarget).modal('show');
                }
            });
        }
    });
    
    // Displaying a form to edit an existing category
    $('.edit-ug').on('click', function () {
    btn =   $(this);
    url =   btn.data('target');
    modalTarget =   btn.data('modal-target');
    if ($(modalTarget).length > 0){
        $(modalTarget).remove();
        $(modalTarget).modal('show');
    }
    $.ajax({
        url : url,
        type : 'POST',
        success : function (html) {
            $('body').append(html);
            $(modalTarget).modal('show');
        }
    });
    });
    
    // Adding a new category
    $(document).on('click', '#submit-btn', function (e) {
        btn     =   $(this);
        e.preventDefault();
        form    =   btn.parents('.form');
        url = form.attr('action');
        data    =   new FormData(form[0]);
        formResults =   form.find('#form-results');
        $.ajax({
            url:    url,
            data:   data,
            type:   'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.cancel').hide();
                formResults.removeClass().addClass('alert alert-info').html('Please wait');
            },
            success: function (r) {
                $('.cancel').show();
                if (r.errors){
                    formResults.removeClass().addClass('alert alert-danger').html(r.errors);
                } else if (r.success){
                    formResults.removeClass().addClass('alert alert-success').html(r.success);
                }
                if (r.redirect){
                    window.location.href    =   r.redirect;
                }
            },
            cache: false,
            processData: false,
            contentType: false
        });
    });
    
    // Editing an existing category
    $(document).on('click', '.save', function (e) {
        btn     =   $(this);
        e.preventDefault();
        form    =   btn.parents('.form');
        url = form.attr('action');
        data    =   new FormData(form[0]);
        formResults =   form.find('#form-results');
        $.ajax({
            url:    url,
            data:   data,
            type:   'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.cancel').hide();
                formResults.removeClass().addClass('alert alert-info').html('Please wait');
            },
            success: function (r) {
                $('.cancel').show();
                if (r.errors){
                    formResults.removeClass().addClass('alert alert-danger').html(r.errors);
                } else if (r.success){
                    formResults.removeClass().addClass('alert alert-success').html(r.success);
                }
                if (r.redirect){
                    window.location.href    =   r.redirect;
                }
            },
            cache: false,
            processData: false,
            contentType: false
        });
    });
    // Deleting
    $('.delete').on('click', function(e){
        e.preventDefault();
        btn = $(this);
        c = confirm('Are you sure?');
        if (c === true){
            $.ajax({
                url: btn.data('target'),
                type: 'POST',
                dataType: 'json',
                beforeSend: function(){
                    
                },
                success: function(r){
                    window.location.href    =   r.redirect;
                }
            });
        }else{
            return false;
        }
    });
</script>
</body>
</html>
