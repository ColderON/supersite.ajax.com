
$(document).ready(function(event) {

    $("#_btnSave").on("click", function (event) {
        CreateNewPerson();
    });

    $(document).delegate('.btn-delete', 'click', function (event) {
        ShowPersonDelete(event.currentTarget.id.substring(12));
        event.cancelBubble = true;
        event.stopPropagation();
    });

    $(document).delegate('.btn-edit', 'click', function (event) {
        ShowPersonUpdate(event.currentTarget.id.substring(10));
        event.cancelBubble = true;
        event.stopPropagation();
    });

    UpdateData();

    $("#_btnDelete").on("click", function () {
        let idPerson = $("#_id_delete").val();

        $.ajax({
            method: 'get',
            url: "/deletePerson.php?id_dP=" + idPerson,

            complete: function (data) {
                console.log(data);
                if (data.status === 200) {
                    toastr.success("Deleted successfully")
                    UpdateData();
                }
                else if (data.status === 400) {
                    toastr.error("Такого пипла id = {" + idPerson + "} в базе нет")
                }
                else {
                    toastr.error("Что-то пошло не так")
                }
            }
        });
    })

    $("#_btnSave_update").on("click", function () {

        let person = {
            id: $("#_id_update").val(),
            firstName: $("#firstName_update").val(),
            lastName: $("#lastName_update").val(),
            email: $("#eMail_update").val(),
            phone: $("#phone_update").val()
        };
        $.ajax({
            method: 'post',
            url: "/editPerson.php",
            data: JSON.stringify(person),
            contentType: "application/json: charset=UTF-8",
            complete: function (data) {
                //debugger;
                if (data.status === 200) {
                    toastr.success("Updatet successfully")
                    UpdateData();
                }
                else {
                    toastr.error("Что-то пошло не так" + data.status)
                }
            }
        });
    });

    $('#imageUploadForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    $("#ImageBrowse").on("change", function() {
        $("#imageUploadForm").submit();
    });

   /* $(document).delegate('.btn-details', 'click', function (event) {

        ShowPersonDetails(event.currentTarget.id.substring(10));
        event.cancelBubble = true;
        event.stopPropagation();
    });

    $(document).delegate('.btn-edit', 'click', function (event) {

        ShowPersonUpdate(event.currentTarget.id.substring(10));
        event.cancelBubble = true;
        event.stopPropagation();
    });*/
});

function OnPeopleStart() {

/*    $("#_btnSave").on("click", function (event) {
        CreateNewPerson();
    });

    $(document).delegate('.btn-details', 'click', function (event) {

        ShowPersonDetails(event.currentTarget.id.substring(10));
        event.cancelBubble = true;
        event.stopPropagation();
    });

    $(document).delegate('.btn-edit', 'click', function (event) {

        ShowPersonUpdate(event.currentTarget.id.substring(10));
        event.cancelBubble = true;
        event.stopPropagation();
    });

    $(document).delegate('.btn-delete', 'click', function (event) {

        ShowPersonDelete(event.currentTarget.id.substring(12));
        event.cancelBubble = true;
        event.stopPropagation();
    });*/

   /* UpdateData();*/

    /*$("#_btnDelete").on("click", function () {
        let idPerson = $("#_id_delete").val();

        $.ajax({
            method: 'delete',
            url: "/api/People/" + idPerson,

            complete: function (data) {

                if (data.status === 200) {
                    toastr.success("Deleted successfully")
                    UpdateData();
                }
                else if (data.status === 400) {
                    toastr.error("Такого пипла id = {" + idPerson + "} в базе нет")
                }
                else {
                    toastr.error("Что-то пошло не так")
                }
            }
        });
    })


    $("#_btnSave_update").on("click", function () {

        let person = {
            id: $("#_id_update").val(),
            firstName: $("#firstName_update").val(),
            lastName: $("#lastName_update").val(),
            email: $("#eMail_update").val(),
            phone: $("#phone_update").val()
        };
        $.ajax({
            method: 'put',
            url: "/api/People",
            data: JSON.stringify(person),
            contentType: "application/json: charset=UTF-8",
            complete: function (data) {
                //debugger;
                if (data.status === 200) {
                    toastr.success("Updatet successfully")
                    UpdateData();
                }
                else {
                    toastr.error("Что-то пошло не так" + data.status)
                }
            }
        });
    });*/
}
function CreateNewPerson() {

    let person = {
        firstName: $("#firstName").val(),
        lastName: $("#lastName").val(),
        email: $("#eMail").val(),
        phone: $("#phone").val(),
    };

    $.ajax({
        method: 'post',
        url: "/insert.php",
        data: JSON.stringify(person),
        contentType: "application/json: charset=UTF-8",
        complete: function (data) {
            //debugger;
            if (data.status === 200) {
                toastr.success("All right!!!")
                UpdateData();
            }
            else {
                toastr.error("Что-то пошло не так" + data.status)
            }
        }
    });
}

function UpdateData() {

    $('#_people>tbody>tr').remove();

    $.ajax({
        method: 'get',
        url: "/list.php",
        success: function (data) {
            data.map(function (p) {
                $('#_people>tbody').append(
                    ['<tr><td>',
                        p.id,
                        '</td><td>',
                        p.firstName,
                        '</td><td>',
                        p.lastName,
                        '</td><td>',
                        '<button type="button" class="btn-details btn btn-primary" id="_btn_data_',
                        p.id,
                        '">Подробно</button></td><td>',
                        '<button type="button" class="btn-edit btn btn-primary" id="_btn_data_',
                        p.id,
                        '">Изменить</button></td><td>',
                        '<button type="button" class="btn-delete btn btn-danger" id="_btn_delete_',
                        p.id,
                        '">Удалить</button></td></tr>'
                    ].join(""));
            });
        }
    });
}

function ShowPersonDelete(idPerson) {

    let myModal = document.getElementById('modalDelete');
    myModal.addEventListener('shown.bs.modal', listener);

    new bootstrap.Modal(myModal, {}).show();
    function listener() {
        $.ajax({
            method: 'get',
            url: "/getPerson.php?id=" + idPerson,
            success: function (data) {
                console.log(data.id);
                $("#_id_delete").val(data.id);
                $("#firstName_delete").val(data.firstName);
                $("#lastName_delete").val(data.lastName);
                $("#eMail_delete").val(data.email);
                $("#phone_delete").val(data.phone);

                myModal.removeEventListener('shown.bs.modal', listener);
            }
        });
    }
}

function ShowPersonUpdate(idPerson) {
    let myModal = document.getElementById('modalUpdate');
    myModal.addEventListener('shown.bs.modal', listener);

    new bootstrap.Modal(myModal, {}).show();

    function listener() {

        $.ajax({
            method: 'get',
            url: "/getPerson.php?id=" + idPerson,
            success: function (data) {
                console.log(data.id);
                $("#_id_update").val(data.id);
                $("#firstName_update").val(data.firstName);
                $("#lastName_update").val(data.lastName);
                $("#eMail_update").val(data.email);
                $("#phone_update").val(data.phone);

                myModal.removeEventListener('shown.bs.modal', listener);
            }
        });
    }
}


/*
function ShowPersonDetails(idPerson) {

    let myModal = document.getElementById('modalDetails');
    myModal.addEventListener('shown.bs.modal', listener);

    new bootstrap.Modal(myModal, {}).show();

    function listener() {

        $.ajax({
            method: 'get',
            url: "/api/People/" + idPerson,
            success: function (data) {

                $("#firstName_details").val(data.firstName);
                $("#lastName_details").val(data.lastName);
                $("#eMail_details").val(data.email);
                $("#phone_details").val(data.phone);

                myModal.removeEventListener('shown.bs.modal', listener);
            }
        });
    }

}

}*/
