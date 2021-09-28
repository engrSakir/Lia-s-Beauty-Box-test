$(document).ready(function () {
    $(".logout-btn").click(function () {
        Swal.fire({
            title: 'User logout ?',
            text: "Please remember your credintials",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#061a6c',
            cancelButtonColor: '#b8c7c1',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'POST',
                    url: "/logout",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response.type == 'success') {
                            Swal.fire(
                                'Complete !',
                                response.message,
                                response.type
                            )
                            location.replace(response.url);
                        } else {
                            Swal.fire(
                                'Sorry !',
                                response.message,
                                response.type
                            )
                        }
                    },
                    error: function(error) {
                        validation_error(error);
                    },
                })
            }
        })
    });

    //delete btn
    // $('.delete-btn').click(function (event) {
    //     let url = $(this).val();
    //     if (!url) {
    //         Swal.fire(
    //             'Wrong!',
    //             'Empty URL',
    //             'warning'
    //         )
    //     } else {
    //         Swal.fire({
    //             title: 'Are you sure?',
    //             text: "You won't be able to revert this!",
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'Yes, delete it!'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     method: 'DELETE',
    //                     url: url,
    //                     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //                     success: function (data) {
    //                         if (data.type == 'success') {
    //                             Swal.fire(
    //                                 'Deleted!',
    //                                 'Your file has been deleted. ' + data.message,
    //                                 'success'
    //                             )
    //                             if (data.url) {
    //                                 setTimeout(function () {
    //                                     location.replace(data.url);
    //                                 }, 800);//
    //                             } else {
    //                                 setTimeout(function () {
    //                                     location.reload();
    //                                 }, 800);//
    //                             }
    //                         } else {
    //                             if (data.message) {
    //                                 Swal.fire(
    //                                     'Wrong!',
    //                                     data.message,
    //                                     'warning'
    //                                 )
    //                             } else {
    //                                 Swal.fire(
    //                                     'Wrong!',
    //                                     'Something going wrong.',
    //                                     'warning'
    //                                 )
    //                             }
    //                         }
    //                     },
    //                 })
    //             }
    //         })
    //     }
    // });

    // select all check box
    $('.select-all').click(function (event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = true;
        }
    });

    // un select all check box
    $('.un-select-all').click(function (event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = false;
        }
    });


    //Chose image
    $(".image-chose-btn").click(function () {
        $(this).parent().find('.image-importer').click();
    })

    //Display image
    $(".image-importer").change(function (event) {
        if (event.target.files.length > 0) {
            $(this).parent().find('.image-display').attr("src", URL.createObjectURL(event.target.files[0]));
        }
    })

    //Reset image
    $(".image-reset-btn").click(function () {
        $(this).parent().find('.image-display').attr("src", $(this).val());
        $(this).parent().find('.image-importer').val('');
    })

    //Open SMS modal
    $(".global-sms-btn").click(function () {
        $('#sms-modal').modal('show');
    })
    //Send SMS
    $("#sms-modal-submit").click(function () {
        $.ajax({
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/sms",
            data: {
                number: $('#sms-modal-number').val(),
                message: $('#sms-modal-message').val(),
            },
            success: function (response) {
                console.log(response);
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#sms-modal').modal('hide');
            },
            error: function(error) {
                validation_error(error);
            },
        });
    });
});


//show validation error message
function validation_error(error) {
    var errorMessage = '<div class="card bg-danger">\n' +
        '                        <div class="card-body text-center p-5">\n' +
        '                            <span class="text-white">';
    $.each(error.responseJSON.errors, function (key, value) {
        errorMessage += ('' + value + '<br>');
    });
    errorMessage += '</span>\n' +
        '                        </div>\n' +
        '                    </div>';
    Swal.fire({
        html: errorMessage,
    })
}


