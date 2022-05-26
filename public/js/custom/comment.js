function sendComment(id,url_comment) {
    var comment = $("#comment-item").val();
    $("#form-comment-js").html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url_comment,
        data: {
            id: id,
            txt_comment: comment
        },
        type : 'PATCH',
        beforeSend : function () {
            // comment overlay
            $("#overlay-comment").removeAttr("hidden");
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
                    $("#overlay-comment").attr("hidden",true);
                }
                else {
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: obj.title,
                        position: 'bottomRight',
                        body: obj.message,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 3000,
                    });
                    $("#overlay-comment").attr("hidden",true);
                    $("#comment-item").val('');
                    getComment(id,url_comment);
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
            $("#overlay-comment").attr("hidden",true);
        }
    });
}