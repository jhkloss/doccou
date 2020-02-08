$(document).ready(function(){

    let taskID = $('#taskID').data('taskid');

    $('#create-image-btn').on('click', function()
    {
        $.ajax('/docker/image/build',{
            method: 'POST',
            data: {
                taskID:taskID,
            },
            beforeSend(jqXHR, settings)
            {
                Processing('#create-image-btn');
            },
            complete: function(){ StopProcessing('#create-image-btn'); },
            success: function(response)
            {
                ShowMessage(response);
                $('#create-container-btn').removeAttr('disabled');
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
            beforeSend(jqXHR, settings)
            {
                Processing('#create-container-btn');
            },
            complete: function(){ StopProcessing('#create-container-btn'); },
            success: function(response){ ShowMessage(response); },
        });
    });

    $('#start-container-btn').on('click', function()
    {
        $.ajax('/docker/container/start',{
            method: 'POST',
            data: {
                taskID:taskID,
            },
            beforeSend(jqXHR, settings)
            {
                Processing('#start-container-btn');
            },
            complete: function(){ StopProcessing('#start-container-btn'); },
            success: function(response){ ShowMessage(response); },
        });
    });

    $('#stop-container-btn').on('click', function()
    {
        $.ajax('/docker/container/stop',{
            method: 'POST',
            data: {
                taskID:taskID,
            },
            beforeSend(jqXHR, settings)
            {
                Processing('#stop-container-btn');
            },
            complete: function(){ StopProcessing('#stop-container-btn'); },
            success: function(response){ ShowMessage(response); },
        });
    });

});

function Processing(selector)
{
    $(selector).addClass('is-loading');
}

function StopProcessing(selector)
{
    $(selector).removeClass('is-loading');
}
