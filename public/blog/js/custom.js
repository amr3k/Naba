$(function () {
    adjustFooter();

    "use strict";
    new WOW().init();

    $(".dropdown").hover(function () {
        $(this).toggleClass('open');
    });
    $('.placeholder').each(function () {
        var input = $(this),
                placeholder = input.attr('placeholder');

        input.attr('data-placeholder', placeholder);
        input.attr('placeholder', '');
        input.val(placeholder);
    }).on('focus', function () {
        var input = $(this),
                placeholder = input.attr('data-placeholder'),
                inputVal = input.val();

        if (inputVal == placeholder) {
            input.val('');
        }
    }).on('focusout', function () {
        var input = $(this),
                placeholder = input.attr('data-placeholder'),
                inputVal = input.val();

        if (inputVal == '') {
            input.val(placeholder);
        }
    });

    // submit form
    $(document).on('click', '.submit-btn', function (e) {
        btn = $(this);

        e.preventDefault();

        form = btn.parents('.form');

        // check if the form inputs values are the same as thier palceholders
        // if so, then we will just make them empty

        form.find('input').each(function () {
            input = $(this);
            placeholder = input.attr('data-placeholder');

            if (!placeholder)
                return false;

            if (input.val() == placeholder) {
                input.val('');
            }
        });

        url = form.attr('action');

        data = new FormData(form[0]);

        formResults = form.find('#form-results');

        $.ajax({
            url: url,
            data: data,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                formResults.removeClass().addClass('alert alert-info').html('Loading...');
            },
            success: function (results) {
                if (results.errors) {
                    formResults.removeClass().addClass('alert alert-danger').html(results.errors);
                } else if (results.success) {
                    formResults.removeClass().addClass('alert alert-success').html(results.success);
                }
                if (results.redirectTo) {
                    setTimeout(function () {
                        window.location.href = results.redirectTo;
                    }, 1000);
                }
            },
            cache: false,
            processData: false,
            contentType: false
        });
    });
});

function adjustFooter() {
    setFixedFooter();
    $(window).on('resize', function () {
        setFixedFooter();
    });
}

function setFixedFooter() {
    var footer = $('footer');

    var body = $('body');

    if (body.height() < $(window).height()) {
        footer.addClass('fixed-footer');
    } else {
        footer.removeClass('fixed-footer');
    }

//Deleting item
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
}
// Changing some facebook meta tags :
var FBappID = document.getElementById('FBappID').content
        , postDesc = document.getElementById('postDesc').innerHTML
        , postImg = document.getElementById('postImg').src;
document.getElementById('metaPostDesc').content = postDesc;
document.getElementById('metaPostImg').content = postImg;
// Facebook Javascript SDK
window.fbAsyncInit = function () {
    FB.init({
        appId: FBappID,
        autoLogAppEvents: true,
        xfbml: true,
        version: 'v2.11'
    });
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=126734348075212";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

