function acceptAssignInventoryGroupModal(id,url_assign_inventory_group) {
    $("#form-assign-inventory-group-js").html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url_assign_inventory_group,
        type : 'POST',
        data : {
            id: id,
        },
        beforeSend : function () {
            // add overlay
            $("#overlay-assign-inventory-group").removeAttr("hidden");
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
                    $("#overlay-assign-inventory-group").attr("hidden",true);
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
                    $("#overlay-assign-inventory-group").attr("hidden",true);
                    $('#modal-assign-inventory-group').modal('hide');
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
                    $("#overlay-assign-inventory-group").attr("hidden",true);
                    $('#modal-assign-inventory-group').modal('hide');
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
                    $("#overlay-assign-inventory-group").attr("hidden",true);
                    $("#form-assign-inventory-group-js").html(data.data);
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
            $("#overlay-assign-inventory-group").attr("hidden",true);
        }
    });
    $('#modal-assign-inventory-group').modal({backdrop: 'static', keyboard: false});
}

$("#form-assign-inventory-group").on("submit", function (event) {
    event.preventDefault();

    var url  = $("#form-assign-inventory-group").attr('action');
    var url_get_notification  = $("#form-assign-inventory-group").attr('notification');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url,
        type : 'PATCH',
        data : $("#form-assign-inventory-group").serialize(),
        beforeSend : function () {
            // add overlay
            $("#overlay-assign-inventory-group").removeAttr("hidden");
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
                    $("#overlay-assign-inventory-group").attr("hidden",true);
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
                    $("#overlay-assign-inventory-group").attr("hidden",true);
                    $('#modal-assign-inventory-group').modal('hide');
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
                    $("#overlay-assign-inventory-group").attr("hidden",true);
                    $('#modal-assign-inventory-group').modal('hide');
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
                    $("#overlay-assign-inventory-group").attr("hidden",true);
                    $('#modal-assign-inventory-group').modal('hide');
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
            $("#overlay-assign-inventory-group").attr("hidden",true);
        }
    });
    getNotificationInventoryGroup(url_get_notification);
});

$("#modal-assign-inventory-group").on("hidden.bs.modal", function (event) {
    event.preventDefault();
    $("#form-assign-inventory-group-js").html('');
    console.log('Clear content in modal ..')
});
