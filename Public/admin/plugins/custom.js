/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Sidebar links
var currentUrl = window.location.href;
var segment = currentUrl.split('/').pop();
$('#sidebar-' + segment).addClass('active');

// Date picker
$(document).find('.date').datepicker();

// Displaying a form to add a new item
$('.popup').on('click', function () {
    btn = $(this);
    url = btn.data('target');
    modalTarget = btn.data('modal-target');
    if ($(modalTarget).length > 0) {
        $(modalTarget).remove();
        $(modalTarget).modal('show');
    }
    $.ajax({
        url: url,
        type: 'POST',
        success: function (html) {
            $('body').append(html);
            $(modalTarget).modal('show');
        }
    });
});

// Displaying a form to edit an existing item
$('.edit-form').on('click', function () {
    btn = $(this);
    url = btn.data('target');
    modalTarget = btn.data('modal-target');
    if ($(modalTarget).length > 0) {
        $(modalTarget).remove();
        $(modalTarget).modal('show');
    }
    $.ajax({
        url: url,
        type: 'POST',
        success: function (html) {
            $('body').append(html);
            $(modalTarget).modal('show');
        }
    });
});

// Adding a new item
$(document).on('click', '#submit-btn', function (e) {
    btn = $(this);
    e.preventDefault();
    form = btn.parents('.form');
    url = form.attr('action');
    data = new FormData(form[0]);
    formResults = form.find('#form-results');
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            $('.cancel').hide();
            formResults.removeClass().addClass('alert alert-info').html('Please wait');
        },
        success: function (r) {
            $('.cancel').show();
            if (r.errors) {
                formResults.removeClass().addClass('alert alert-danger').html(r.errors);
            } else if (r.success) {
                formResults.removeClass().addClass('alert alert-success').html(r.success);
            }
            if (r.redirect) {
                window.location.href = r.redirect;
            }
        },
        cache: false,
        processData: false,
        contentType: false
    });
});

// Editing an existing item
$(document).on('click', '.save', function (e) {
    btn = $(this);
    e.preventDefault();
    form = btn.parents('.form');
    url = form.attr('action');
    data = new FormData(form[0]);
    formResults = form.find('#form-results');
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            $('.cancel').hide();
            formResults.removeClass().addClass('alert alert-info').html('Please wait');
        },
        success: function (r) {
            $('.cancel').show();
            if (r.errors) {
                formResults.removeClass().addClass('alert alert-danger').html(r.errors);
            } else if (r.success) {
                formResults.removeClass().addClass('alert alert-success').html(r.success);
            }
            if (r.redirect) {
                window.location.href = r.redirect;
            }
        },
        cache: false,
        processData: false,
        contentType: false
    });
});
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
                window.location.href = r.redirect;
            }
        });
    } else {
        return false;
    }
});
// Showing site status message box when setting it to OFF
$('#status').change(function () {
    $('#status_msg').slideToggle(250);
});
