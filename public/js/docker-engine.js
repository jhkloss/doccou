$(document).ready(function(){

    let taskID = $('#taskID').data('taskid');

    $('#create-image-btn').on('click', function()
    {
        $.ajax('/docker/image/build',{
            method: 'POST',
            data: {
                taskID:taskID,
            },
        });
    });

    $('#create-container-btn').on('click', function()
    {
        $.ajax('/docker/container/create',{
            method: 'POST',
            data: {
                taskID:taskID,
            },
        });
    });
});
