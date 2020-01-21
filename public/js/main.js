$(document).ready(function(){

    $('#login-btn').on('click', function()
    {
        $('#login-modal').addClass('is-active');
    });

    $('.login-cancel-btn').on('click', function()
    {
        $('#login-modal').removeClass('is-active');
    });

});
