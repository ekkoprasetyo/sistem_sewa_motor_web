function getNotificationInventoryGroup(url_notification) {
    $("#assign-inventory-group-notification").html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url_notification,
        type : 'POST',
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
                }
                else {
                    // $(document).Toasts('create', {
                    //     class: 'bg-success',
                    //     title: obj.title,
                    //     position: 'bottomRight',
                    //     body: obj.message,
                    //     icon: 'fas fa-envelope fa-lg',
                    //     autohide: true,
                    //     delay: 3000,
                    // });
                    $("#assign-inventory-group-notification").html(data.data);
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
        }
    });
}
