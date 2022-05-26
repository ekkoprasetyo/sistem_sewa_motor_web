function detailItemCSEOSModal(url_detail_item_cs) {
    $("#form-detail-item-cs-eos-js").html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url_detail_item_cs,
        type : 'POST',
        beforeSend : function () {
            // add overlay
            $("#overlay-detail-item-cs-eos").removeAttr("hidden");
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
                    $("#overlay-detail-item-cs-eos").attr("hidden",true);
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
                    $("#overlay-detail-item-cs-eos").attr("hidden",true);
                    $('#modal-detail-item-cs-eos').modal('hide');
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
                    $("#overlay-detail-item-cs-eos").attr("hidden",true);
                    $("#form-detail-item-cs-eos-js").html(data.data);
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
            $("#overlay-detail-item-cs-eos").attr("hidden",true);
            $('#modal-detail-item-cs-eos').modal('hide');
        }
    });
    $('#modal-detail-item-cs-eos').modal('show');
}

$("#modal-detail-item-cs-eos").on("hidden.bs.modal", function (event) {
    event.preventDefault();
    $("#form-detail-item-cs-eos-js").html('');
    console.log('Clear content in modal ..')
});
