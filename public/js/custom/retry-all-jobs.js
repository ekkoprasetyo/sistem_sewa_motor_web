function retryalljobsModal() {
    $("#form-retry-all-jobs-js").html('');
    $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Failed Job',
        position: 'bottomRight',
        body: 'Retry All Job',
        icon: 'fas fa-envelope fa-lg',
        autohide: true,
        delay: 3000,
    });
    $("#overlay-retry-all-jobs").attr("hidden",true);
    $('#modal-retry-all-jobs').modal({backdrop: 'static', keyboard: false});
}

$("#form-retry-all-jobs").on("submit", function (event) {
    event.preventDefault();

    var url  = $("#form-retry-all-jobs").attr('action');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url,
        type : 'POST',
        data : $("#form-retry-all-jobs").serialize(),
        beforeSend : function () {
            // retry-all-jobs overlay
            $("#overlay-retry-all-jobs").removeAttr("hidden");
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
                    $("#overlay-retry-all-jobs").attr("hidden",true);
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
                    $("#overlay-retry-all-jobs").attr("hidden",true);
                    $('#modal-retry-all-jobs').modal('hide');
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
                    $("#overlay-retry-all-jobs").attr("hidden",true);
                    $('#modal-retry-all-jobs').modal('hide');
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
                    $("#overlay-retry-all-jobs").attr("hidden",true);
                    $('#modal-retry-all-jobs').modal('hide');
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
            $("#overlay-retry-all-jobs").attr("hidden",true);
        }
    });
});

$("#modal-retry-all-jobs").on("hidden.bs.modal", function (event) {
    event.preventDefault();
    $("#form-retry-all-jobs-js").html('');
    console.log('Clear content in modal ..')
});
