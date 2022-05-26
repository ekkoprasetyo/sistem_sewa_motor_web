function addModal(url_add) {
    $("#form-add-js").html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url_add,
        type : 'POST',
        beforeSend : function () {
            // add overlay
            $("#overlay-add").removeAttr("hidden");
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
                        delay: 3000,
                    });
                    $("#overlay-add").attr("hidden",true);
                }
                else if (obj.status == 'auth') {
                    $(document).Toasts('create', {
                        class: 'bg-warning',
                        title: obj.title,
                        position: 'bottomRight',
                        body: obj.message,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 3000,
                    });
                    $("#overlay-add").attr("hidden",true);
                    $('#modal-add').modal('hide');
                }
                else if (obj.status == 'info') {
                    $(document).Toasts('create', {
                        class: 'bg-info',
                        title: obj.title,
                        position: 'bottomRight',
                        body: obj.message,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 10000,
                    });
                    $("#overlay-add").attr("hidden",true);
                    $('#modal-add').modal('hide');
                } else {
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: obj.title,
                        position: 'bottomRight',
                        body: obj.message,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 3000,
                    });
                    $("#overlay-add").attr("hidden",true);
                    $("#form-add-js").html(data.data);
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
            $("#overlay-add").attr("hidden",true);
            $('#modal-add').modal('hide');
        }
    });
    $('#modal-add').modal({backdrop: 'static', keyboard: false});
}

$("#form-add").on("submit", function (event) {
    event.preventDefault();

    var url  = $("#form-add").attr('action');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url,
        type : 'POST',
        data : $("#form-add").serialize(),
        beforeSend : function () {
            // add overlay
            $("#overlay-add").removeAttr("hidden");
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
                    $("#overlay-add").attr("hidden",true);
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
                    $("#overlay-add").attr("hidden",true);
                    $('#modal-add').modal('hide');
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
                    $("#overlay-add").attr("hidden",true);
                    $('#modal-add').modal('hide');
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
                    $("#overlay-add").attr("hidden",true);
                    $('#modal-add').modal('hide');
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
            $("#overlay-add").attr("hidden",true);
        }
    });
});

$("#modal-add").on("hidden.bs.modal", function (event) {
    event.preventDefault();
    $("#form-add-js").html('');
    console.log('Clear content in modal ..')
});
