<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <a href="<?php echo url('admin/login'); ?>">Login</a>
        <a href="<?php echo url('admin/categories'); ?>">Categories</a>
        <a href="<?php echo url('admin/logout'); ?>">Logout</a>
        <form action="<?php echo url('/admin/submit/'); ?>">
            <table>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input type="text" id="email" name="email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Name</label>
                    </td>
                    <td>
                        <input type="text" id="name" name="name">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="pass">Password</label>
                    </td>
                    <td>
                        <input type="password" id="pass" name="pass">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="re-pass">Confirm Password</label>
                    </td>
                    <td>
                        <input type="password" id="re-pass" name="re-pass">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="img">
                    </td>
                    <td>
                        <button>Submit</button>
                    </td>
                </tr>
            </table>
        </form>
        <script 
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            accesskey=""crossorigin="anonymous">
        </script>
        <script>
            $('form').on('submit', function (e) {
                e.preventDefault();
                var form = $(this);
                var sentData = new FormData(form[0]);
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: sentData,
                    dataType: 'json',
                    success: function(r){
                        $('body').append(r.name);
                    },
                    cache: false,
                    processData: false,
                    contentType: false
                });
            });
        </script>
    </body>
</html>










