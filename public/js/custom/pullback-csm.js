$("#btn-pullback-csm").on("click", function (event) {
    event.preventDefault();

    var url  = $(this).attr('url');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url,
        type : 'PATCH',
        data : $("#form-approval-csm").serialize(),
        beforeSend : function () {
            // add overlay
            $("#overlay-approval-csm").removeAttr("hidden");
        },
        success : function(data) {
            setTimeout(function(){
                // Button loading reset
                var obj = jQuery.parseJSON(JSON.stringify(data));

                if (obj.status == 'error' || obj.status == 'errors') {
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: obj.title,
                        position: 'bottomRight',
                        body: obj.message,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 10000,
                    });
                    $("#overlay-approval-csm").attr("hidden",true);
                }
                else if (obj.status == 'auth') {
                    $(document).Toasts('create', {
                        class: 'bg-warning',
                        title: obj.title,
                        position: 'bottomRight',
                        body: obj.message,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 10000,
                    });
                    $("#overlay-approval-csm").attr("hidden",true);
                    $('#modal-approval-csm').modal('hide');
                } else if (obj.status == 'info') {
                    $(document).Toasts('create', {
                        class: 'bg-info',
                        title: obj.title,
                        position: 'bottomRight',
                        body: obj.message,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 10000,
                    });
                    $("#overlay-approval-csm").attr("hidden",true);
                    $('#modal-approval-csm').modal('hide');
                } else {
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: obj.title,
                        position: 'bottomRight',
                        body: obj.message,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 10000,
                    });
                    $("#overlay-approval-csm").attr("hidden",true);
                    $('#modal-approval-csm').modal('hide');
                    var data_tables = $('.data-tables').DataTable();
                    data_tables
                        .draw();
                }
            }, 500);
        },
        error: function(xhr) {
            var xhr = JSON.parse(xhr.responseText);
            var html = '';
            for (var key in xhr.errors)
            {
                html += '<li>'+ xhr.errors[key][0] + '</li>'
            }
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: xhr.message,
                position: 'bottomRight',
                body: html,
                icon: 'fas fa-envelope fa-lg',
                autohide: true,
                delay: 10000,
            });
            $("#overlay-approval-csm").attr("hidden",true);
        }
    });
});

$("#modal-approval-csm").on("hidden.bs.modal", function (event) {
    event.preventDefault();
    $("#form-approval-csm-js").html('');
    console.log('Clear content in modal ..')
});
