<!DOCTYPE html>

<html>

<head>
  <title>Hello!</title>
</head>

<body>

<form action="<?php echo url('/admin/submit'); ?>">
    <label for="">Email</label>
    <input type="text" name="email" />
    <br>
    <label for="">Password</label>
    <input type="password" name="password" />
    <br>
    <label for="">Confirm Password</label>
    <input type="password" name="confirm_password" />
    <br>
    <label for="">Full Name</label>
    <input type="text" name="fullname" />

    <br>
    <input type="file" name="image" />

    <br>
    <button>Send</button>
</form>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

<script>
    $('form').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);

        var sentData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: sentData,
            dataType: 'json',
            success: function (r) {
                $('body').append(r.name);
            },
            cache: false,
            processData: false,
            contentType: false,
        });

    });
</script>


</body>
</html>