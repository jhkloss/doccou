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

    $('.delete-member').on('click', function()
    {
        let userID = $(this).data('userid');
        let courseID = $('#course-id').data('courseid');
        DeleteMember(userID, courseID);
    });
});

function AddTask(courseID)
{
    $.ajax({
        method: 'POST',
        url: '/task/add',
        data: { 'courseID': courseID},
        success: function(response) {AppendTaskBox(response)}
    });
}

function AppendTaskBox(response)
{
    if(response !== 'false')
    {
        let item = $(response);
        $('.task-list').append(item);
        $(item).effect( 'slide');
    }
}

function DeleteMember(userID, courseID)
{
    $.ajax({
       method: 'POST',
       url: '/courses/' + courseID + '/member/remove',
       data: { 'userID': userID},
        success: function() { $('button[data-userid=' + userID + '] ').parent().effect('explode'); }
    });
}
