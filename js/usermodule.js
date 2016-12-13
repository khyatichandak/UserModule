$(document).ready(function () {
    show_user();
    show_history();
    $("#alert_success").hide();
    $("#alert_fail").hide();

    $('#user_table').on('show.bs.collapse', function () {
        $('.usertable-fade').attr('src', "img/arrow_up.png");
    });
    $('#user_table').on('hide.bs.collapse', function () {
        $('.usertable-fade').attr('src', "img/arrow_down.png");
    });
    $('#user_history').on('show.bs.collapse', function () {
        $('.userhistory-fade').attr('src', "img/arrow_up.png");
    });
    $('#user_history').on('hide.bs.collapse', function () {
        $('.userhistory-fade').attr('src', "img/arrow_down.png");
    });

    $(document).on('click', '#save_data', function () {
        if (validateData() === true) {
            createOrUpdate();
        }
    });
    $(document).on('click', '#btn_trash', function () {
        var id = $(this).data("id");
        var action = 'trash';
        restoreOrTrash(id, action);
    });

    $(document).on('click', '#btn_restore', function () {
        var id = $(this).data("id");
        var action = 'restore';
        restoreOrTrash(id, action);
    });

    $(document).on('click', '#btn_delete', function () {
        $("#alertToDelete").modal("show");
    });

    $(document).on('click', '#yesToDelete', function () {
        deleteTable($('#btn_delete').data("id"));
    });


    $('#username').typeahead({
        limit: 10,
        source: function (query, process) {
            $.ajax({
                url: 'operation.php',
                type: 'POST',
                dataType: 'JSON',
                data: {query: query, action: 'typeHead'},
                success: function (data) {
                    process(data);
                    console.log(data);
                }
            });
        }
    });
});

var show_user = function () {
    $.ajax({
        url: 'operation.php',
        method: 'POST',
        data: {action: 'selectUser'},
        success: function (data) {
            $("#user_table").html(data);
        }
    });
};

var show_history = function () {
    $.ajax({
        url: 'operation.php',
        method: 'POST',
        data: {action: 'selectHistory'},
        success: function (data) {
            $("#user_history").html(data);
        }
    });
};

var validateData = function () {
    var userName = $("#username").val();
    var contact = $("#contact").val();
    var email = $("#email").val();
    if (!$.trim(userName) || !$.trim(contact) || !$.trim(email)) {
        $("#alert_fail").html("Enter all details please");
        $("#alert_fail").fadeIn().delay(2000).fadeOut();
        return false;
    }
    else if ($.isNumeric(contact) === false) {
        $("#alert_fail").html("Contact number must be number");
        $("#alert_fail").fadeIn().delay(2000).fadeOut();
        $("#contact").focus();
        return false;
    }
    else if ((contact.length) !== 10) {
        $("#alert_fail").html("Contact number must be of 10 digits");
        $("#alert_fail").fadeIn().delay(2000).fadeOut();
        $("#contact").focus();
        return false;
    }
    else if (isEmail(email) === false) {
        $("#alert_fail").html("Enter valid Email Id");
        $("#alert_fail").fadeIn().delay(2000).fadeOut();
        $("#email").focus();
        return false;
    }
    else {
        return true;
    }
};

var isEmail = function (email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
};

var createOrUpdate = function () {
    var userName = $("#username").val();
    var contact = $("#contact").val();
    var email = $("#email").val();
    $.ajax({
        url: 'operation.php',
        method: 'POST',
        data: {username: userName, contact: contact, email: email, action: 'createOrUpdate'},
        success: function (data) {
            $("#alert_success").html(data);
            $("#alert_success").fadeIn().delay(2000).fadeOut();
            show_user();
            show_history();
        }
    });
};

var restoreOrTrash = function (id, action) {
    $.ajax({
        url: 'operation.php',
        method: 'POST',
        data: {id: id, action: action},
        success: function () {
            show_history();
            show_user();
        }
    });
};

var deleteTable = function (id) {
    $.ajax({
        url: 'operation.php',
        method: 'POST',
        data: {id: id, action: 'delete'},
        success: function () {
            $("#alertToDelete").modal("hide");
            $("#alertDeleteSuccess").removeClass("hidden");
            $("#alertDeleteSuccess").html("Data deleted Successfully");
            $("#alertDeleteSuccess").fadeIn().delay(2000).fadeOut();
            show_history();
        }
    });
};