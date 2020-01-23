$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#login-btn').on('click', function()
    {
        $('#login-modal').addClass('is-active');
    });

    $('.login-cancel-btn').on('click', function()
    {
        $('#login-modal').removeClass('is-active');
    });

    $('#create-task-btn').on('click', function()
    {
       let courseID = $(this).data('courseid');
       AddTask(courseID);
    });

});

function AddTask(courseID)
{
    $.ajax({
        method: 'POST',
        url: '/task/add',
        data: { 'courseID': courseID},
        success: function(response) {PrependTaskBox(response)}
    });
}

function PrependTaskBox(response)
{
    if(response !== 'false')
    {
        let item = $(response);
        $('.task-list').append(item);
        $(item).effect( 'slide');
    }
}
