function getURL(){
    var url='https://culture.kimiafarma.co.id/';
    return url;
}

function notify(message, type) {
    $.notify({
        message: message
    }, {
        type: type,
        z_index: 9999,
        allow_dismiss: true,
        label: 'Cancel',
        className: 'btn-xs btn-inverse',
        placement: {
            from: 'top',
            align: 'right'
        },
        delay: 2500,
        animate: {
            enter: 'animated fadeInRight',
            exit: 'animated fadeOutRight'
        },
        offset: {
            x: 20,
            y: 20
        }
    });
};

function kFormatter(num) {
    return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'K' : Math.sign(num)*Math.abs(num)
};

function configParam(url, key, value){
    var url = new URL(url);
    url.searchParams.set(key, value);
    var newUrl = url.href; 
    return newUrl;
}

function ajaxRequest(reqType, data, route) {
    $.ajax({
        url: route,
        type: 'post',
        dataType: 'json',
        data: data,
        success: function (data) {
            // var response = JSON.parse(data);
            if (reqType == 'edit') {
                $.each(data, function (key, value) {
                    var type = document.getElementById(key).type;
                    if(type=="checkbox"){
                        document.getElementById(key).checked = value;
                    }else{
                        $('#' + key).val(value).trigger('change');
                    }
                });
                // console.log(data);
            } if (reqType == 'view') {
                $.each(data, function (key, value) {
                    if (key.includes('link')) {
                        $('#' + key).attr('href', getURL() + value);
                    } else {
                        $('#' + key).text(value);
                    }
                });
            } else {
                if (data.success) {
                    // toastr['success'](data.message);

                    if (reqType != 'notif') {
                        if (data.message == 'reload') {
                            notify('Success', 'success');
                        } else {
                            notify(data.message, 'success');
                        }
                    }

                    setTimeout(function () {
                        if (data.message == 'reload') {
                            if (data.url) {
                                window.location.href = data.url;
                            } else {
                                window.location.reload();
                            }
                        } else {
                            $(".modal").modal('hide');
                            $('.modal').unblock();
                            $("#myTable").DataTable().ajax.reload();
                        }
                    }, 500);
                } else {
                    if (data.status == 419){
                        window.location.reload()
                    }else{
                        $.each(data.errors, function (key, value) {
                            console.log(data);
                            // toastr['error'](value);
                            notify(value, 'danger');
                        });
                        $('.modal').unblock();
                    }
                }
            }
        },
        error: function (data) {
            // toastr['error']('error');
            if (data.status == 419){
                window.location.reload()
            }else{
                notify('error', 'danger');
                $('.modal').unblock();
                if ('{{ env("APP_ENV") }}' == 'production') {
                    setTimeout(function () { window.location.reload() }, 1000);
                }
            }
        }
    });
}

function handleAjaxError( xhr, textStatus, error ) {
    if ( textStatus === 'Unauthorized' ) {
        window.location.reload();
    }
    else {
        alert( 'An error occurred on the server. Please try again in a minute.' );
    }
}

function ajaxDataTable(route, columns, tableId = 'myTable',responsive = true, bLengthChange = true, bInfo = true, ordering = true, bFilter = true) {
    var datas = $('#' + tableId).DataTable({
        order: [],
        autoWidth: true,
        processing: true,
        serverSide: true,
        responsive: {
            details: responsive
        },
        bLengthChange: bLengthChange,
        bInfo: bInfo,
        ordering: ordering,
        bFilter: bFilter,
        ajax: route,
        columns: columns,
        error: handleAjaxError
    });

    $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
        // console.log(message);
    };

    $('#'+ tableId + '_filter input').unbind();
    $('#'+ tableId + '_filter input').bind('keyup', function (e) {
        if (e.keyCode == 13) {
            datas.search(this.value).draw();
        }
    });
}

function ajaxBtnCreate(name) {
    $(document).on('click', '.btn-create', function () {
        $('#' + name.toLowerCase() + '_id').val('');
        var label = "-";
        if (name.includes("_")){
            label = name.replace(/_/g,' ');
        }else{
            label = name;
        }
        $('.modal-title').text('Add ' + label);
        $('form#add' + name).trigger('reset');
    });

    $("form#add" + name).submit(function () {
        event.preventDefault();
    });
}

function ajaxBtnSave(name, route) {
    $(document).on('click', '.btn-save', function () {
        $('.modal').block({
            message: '<img src="/assets/images/loader.svg" style="background:transparent"/>',
            css: { backgroundColor: 'transparent', border: 'none' }
        });

        var data = $('form#add' + name).serialize();
        ajaxRequest('add', data, route);
    });
};

function showLoading(componen = 'modal'){
    $('.'+componen).block({
        message: '<img src="/assets/images/loader.svg" style="background:transparent"/>',
        css: { backgroundColor: 'transparent', border: 'none' }
    });

}

function ajaxBtnEdit(name, route) {
    $(document).on('click', '.btn-edit', function () {
        var id = $(this).attr('edit-id');
        $("form#add" + name).trigger('reset');
        $('#' + name.toLowerCase() + '_id').val(id);
        var label = "-";
        if (name.includes("_")){
            label = name.replace(/_/g,' ');
        }else{
            label = name;
        }
        $('.modal-title').text('Edit ' + label);
        ajaxRequest('edit', 'id=' + id + '&type=edit', route);
    });
}


function swalPopup(id,route){
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff7676",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        $('.modal').block({
            message: '<img src="/assets/images/loader.svg" style="background:transparent"/>',
            css: { backgroundColor: 'transparent', border: 'none' }
        });
        
        ajaxRequest('delete', 'id=' + id + '&type=delete', route);
        swal.close();
    });
}

function ajaxBtnDelete(route) {
    $(document).on('click', '.btn-delete', function () {
        var id = $(this).attr('delete-id');
        swalPopup(id,route);
    });
};

function plyrControl(players) {
    $(document).on('click', '.plyr__control', function () {
        players.forEach(player => {
            player.on('play', function () {
                var others = players.filter(other => other != player)
                others.forEach(function (other) {
                    other.pause();
                })
            });
        });
    });    
}

function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
} 