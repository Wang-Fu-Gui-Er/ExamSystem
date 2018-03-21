$(function() {
    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $("#visit-form").fadeOut(100);
        $('.wrapper').removeClass('small');
        $('#register-form-link').removeClass('active');
        $('#visit-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $('.wrapper').addClass('small');
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $("#visit-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $('#visit-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#visit-form-link').click(function(e) {
        $("#visit-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $("#register-form").fadeOut(100);
        $('.wrapper').removeClass('small');
        $('#login-form-link').removeClass('active');
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
});