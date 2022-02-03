$(document).ready(function () {
    readdataprogramdetail();
})

function readdataprogramdetail() {
    $('.array_faculty').remove();
    $('.array_datetime').remove();
    var id = window.location.pathname.split('/')[5];
    $.ajax({
        url: '/api/AIESEC/infosessions/programs/read',
        method: 'GET',
        data: {
            id: id,
        },
        success: function (data) {
            $.each(data.data, function (k, i) {
                publish(i.publish);
                var poster = '/assets/internal/images/development/imagenotfound.png';
                if (i.poster != null) {
                    var poster = '/assets/internal/images/infosession/poster/' + i.poster
                }
                $('#poster').attr('src', poster);
                var array_datetime = i.datetime.split('T');
                $('#datetime').append('<b class="array_datetime">Date : <small> ' + array_datetime[0] + '</small></b><b class="array_datetime"> Time : <small> ' + array_datetime[1] + '</small></b>');
                $('#theme').text(i.theme);
                $('#logo_sdgs').attr('src', '/assets/internal/images/sdgs/' + i.sdgs + '.png');
                $('#sdgs').text(i.sdgs);
                $('#description').html(i.description);
                var array_faculty = i.faculty.split('|| ');
                $.each(array_faculty, function (k, i) {
                    $('#faculty').append('<li class="array_faculty">' + i + '</li>');
                });
                $('#link_meet').html(i.link_meet);
                $('#link_content').html(i.link_content);
                readspeaker(id);
            })
        }
    })
}

function readspeaker(id = "kosong") {
    $.ajax({
        url: '/api/AIESEC/infosessions/speakers/read',
        method: 'GET',
        data: {
            id: id
        },
        success: function (data) {
            $.each(data.data, function (k, i) {
                $('#speaker').append('<div class="row mt-2"><div class="col-12"><div class="row"><div class="col-lg-2"><img src="/assets/internal/images/infosession/speaker/'+i.photo+'" alt="" width="100%;"></div ><div class="col-lg-10"><div class="row"><div class="col-12"><h4>'+i.full_name+'</h4></div></div><div class="row"><div class="col-12">profession: <div>'+readrepeat(i.profession)+'</div>Title:<div>'+readrepeat(i.title)+'</div>Contact<div>'+readrepeat(i.contact)+'</div></div></div><div class="row"><div class="col-12"><p>'+i.description+'</p></div></div></div></div></div ></div >');
            })
        }
    })
}

function readrepeat(val) {
    var returns = '';
    if(val != ''){
        var val_array = val.split('|| ');
        $.each(val_array,function(k,i){
            returns += '<li>'+i+'</li>';
        });
    }else{
        returns += '-';
    }
    return returns;
}

function publish(publish) {
    var text = publish == 1 ? 'cancel publish' : 'publish';
    $('.publishprogram').html(text);
}

$(document).on('click', '.publishprogram', function () {
    var program_id = window.location.pathname.split('/')[5];
    var publish = $('.publishprogram').html();
    Swal.fire({
        title: 'Are You Sure ' + publish + ' This?',
        text: 'do you want to ' + publish + ' this infosession ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, ' + publish + ' it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/api/AIESEC/infosessions/programs/publish',
                method: 'GET',
                data: {
                    program_id: program_id,
                    publish: publish,
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#loading').hide();
                    if (data.status == false) {
                        toastr.error(data.pesan);
                    } else if (data.status == true) {
                        toastr.success(data.pesan);
                        readdataprogramdetail();
                    }
                }
            })
        }
    })
})

$(document).on('click', '.editprogram', function () {
    var id = window.location.pathname.split('/')[5];
    $.ajax({
        url: '/api/AIESEC/infosessions/programs/read',
        method: 'GET',
        data: {
            id: id,
        },
        success: function (data) {
            $.each(data.data, function (k, i) {
                var poster = '/assets/internal/images/development/imagenotfound.png';
                if (i.poster != null) {
                    var poster = '/assets/internal/images/infosession/poster/' + i.poster
                }
                $('#previewposter').attr('src', poster);
                $('#edithiddenposter').val(i.poster);
                $('#editdatetime').val(i.datetime);
                $('#edittheme').val(i.theme);
                $('#editprogram_id').val(id);
                $('#editsdgs').val(i.sdgs);
                $('#editdescription').text(i.description);
                var array_faculty = i.faculty.split('|| ');
                $.each(array_faculty, function (k, i) {
                    $('input[value="' + i + '"]').prop('checked', true);
                });
                $('#editlink_meet').val(i.link_meet);
                $('#editlink_content').val(i.link_content);

            })
        }
    })
    $('#editmodal').modal('show');
})

$(document).on('click', '#previewposter', function () {
    $('#editposter').click();
})

$(document).on('submit', '#editformprogram', function (e) {
    e.preventDefault();
    if ($('#editposter').val() != '') {
        $('#edithiddenposter').val('');
    }
    $.ajax({
        url: '/api/AIESEC/infosessions/programs/update',
        method: 'POST',
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#editmodal').modal('hide');
            $('#loading').show();
        },
        success: function (data) {
            $('#loading').hide();
            if (data.status == true) {
                $('#editmodal').modal('hide');
                toastr.success(data.pesan);
                readdataprogramdetail();
            } else {
                toastr.error(data.pesan);
            }
        }, error: function (xhr) {
            $('#loading').hide();
            var response = JSON.parse(xhr.responseText);
            $.each(response.message, function (key, value) {
                toastr.error(value);
            });
        }
    })
})


$(document).on('click', '.deleteprogram', function () {
    var program_id = window.location.pathname.split('/')[5];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete this infosession ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/api/AIESEC/infosessions/programs/delete',
                method: 'DELETE',
                data: {
                    program_id: program_id
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#loading').hide();
                    if (data.status == false) {
                        toastr.error(data.pesan);
                    } else if (data.status == true) {
                        toastr.success(data.pesan);
                        window.location.href = '/AIESEC/infosessions/programs';
                    }
                }
            })
        }
    })
})