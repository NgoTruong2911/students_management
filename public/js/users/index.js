$(".remove").click(function() {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(result => {
        if (result.value) {
            $(this)
                .parent()
                .submit();
        }
    });
});

//  popup ajax update user

const API = `http://localhost:8000/users`;
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$(document).on("click", ".edit-modal", function() {
    var id = $(this).data("user-id");
    $.ajax({
        type: "get",
        url: API + `/${id}/edit`,
        success: function(response) {
            console.log(response);
            $(".modal-content").html(response);
        },
        error: function(e) {
            console.log("err", e);
        }
    });
});

$(document).on("click", ".save-update", function() {
    let form = document.getElementById("update_user");
    let formData = new FormData(form);
    var date = new Date();
    var nowYear = date.getFullYear();
    let id = $('input[name="id"]').val();
    $.ajax({
        type: "POST",
        url: API + `/${id}`,
        data: formData,
        contentType: false,
        enctype: "multipart/form-data",
        cache: false,
        processData: false,
        success: function(data) {
            console.log(data.birthday);
            let row = $(`#user-update-${id} td`);
            $(row[1]).text(data.name);
            $(row[2]).text(data.birthday);
            $(row[3]).text(data.phone_number);
            $(row[4]).text(data.email);
            $(row[5])
                .children()
                .attr("src", "http://localhost:8000/" + data.avatar);
            if (data.gender == 1) {
                $(row[6]).text("Female");
            } else {
                $(row[6]).text("Male");
            }
            $(row[4]).text(data.email);
            $(row[7]).text(nowYear - data.birthday.substr(0, 4));
            if (data.roles) {
                $(row[8]).text(data.roles[0].name);
            }
            $("#exampleModal").modal("toggle");
        },
        error: function printErrorMsg(msg) {
            $(".print-error-msg")
                .find("ul")
                .html("");
            $(".print-error-msg").css("display", "block");
            $.each(msg.responseJSON.errors, function(key, value) {
                $(".print-error-msg")
                    .find("ul")
                    .append("<li>" + value + "</li>");
            });
        }
    });
});

$("#exampleModal").on("hidden.bs.modal", function() {
    $(".print-error-msg").css("display", "none");
});

//  Edit user

$(".subject").click(function() {
    const html = `<div class="form-group">

                          <label for="">${$(this).text()}</label>
                          <input type="number" step="0.01" class="form-control" name="subject_point[${$(
                              this
                          ).val()}][point]">
                      </div>`;
    $(".list-edit-subjects").append(html);
    $(this).hide();
});
$(".remove").click(function() {
    $(this)
        .parent()
        .parent()
        .find(".remove_input")
        .remove();
});

let ref = window.location.href;
    ref = ref.substr(27);
    console.log(ref);
document.getElementById("paginate").onchange = function() {
    window.location = "?paginate=" + this.value + "&page=1" + ref;
    console.log(this.value);
};

