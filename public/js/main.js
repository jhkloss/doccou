$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#login-btn').on('click', function () {
        $('#login-modal').addClass('is-active');
    });

    $('.login-cancel-btn').on('click', function () {
        $('#login-modal').removeClass('is-active');
    });

    $('#create-task-btn').on('click', function () {
        let courseID = $(this).data('courseid');
        AddTask(courseID);
    });

    // Handle Member Actions /////

    $('body').on('click' ,'.delete-member' , function () {
        let userID = $(this).data('userid');
        let courseID = $('#course-id').data('courseid');
        DeleteMember(userID, courseID);
    });

    $('#add-member-btn').on('click', function () {
        let field = $('#add-member');
        let ajaxData = field.select2('data');
        let courseID = $('#course-id').data('courseid');

        AddMembers(ajaxData, courseID);

        field.val(null).trigger("change");
    });

    $('#add-member').select2({
        ajax: {
            method: 'POST',
            url: '/getusers',
            dataType: 'json',
            data: function (params) {
                return {
                    search: params.term,
                    courseID: $('#course-id').data('courseid'),
                }
            },
        }, width: '100%', multiple: true,
    });
});

function AddTask(courseID)
{
    $.ajax({
        method: 'POST', url: '/task/add', data: {'courseID': courseID}, success: function (response) {
            AppendTaskBox(response)
        }
    });
}

function AppendTaskBox(response)
{
    if (response !== 'false')
    {
        let item = $(response);
        $('.task-list').append(item);
        $(item).effect('slide');
    }
}

function DeleteMember(userID, courseID)
{
    $.ajax({
        method: 'POST', url: '/courses/' + courseID + '/member/remove', data: {'userID': userID}, success: function () {
            $('button[data-userid=' + userID + '] ').parent().effect('explode', function () {
                $(this).remove();
            });
        }
    });
}

function AddMembers(users, courseID)
{
    $.ajax({
        method: 'POST', url: '/courses/' + courseID + '/member/add', data: {'users': JSON.stringify(users)}, success: function (response) {
            $('.member-list').append(response)
        }
    });
}
