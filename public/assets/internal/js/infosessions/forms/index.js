$(document).ready(function(){
    readdataform();
    cropbanner();
    optionprogram();
    optionsection();
})

function readdataform() {
    $.ajax({
        url:'/api/AIESEC/infosessions/forms/read',
        method:'GET',
        success:function(data){
            $('.read-form').remove();
            $.each(data.data,function(k,i){
                var banner='/assets/internal/images/development/imagenotfound.png';
                if(i.banner!=null){
                    var banner = '/assets/internal/images/infosession/banner/'+i.banner
                }
                $('#read-form').append('<div class="col-lg-4 read-form form" id="form_'+btoa(i.form_id)+'"><div class="card mx-auto mt-2"><img class="card-img-top" src="'+banner+'" alt="Card image cap" width=""><div class="card-body"><h5 class="card-text">'+i.title+'</h5><small>'+i.type+'</small></div></div></div>');
                optionprogram();
            })
        }
    })
}

function cropbanner() {
    var $modal = $('#modalbanner');
    var banner = document.getElementById('sample_banner');
    var cropper;
    
    $('#banner').click(function(){
        $('#banner').val('');
        $('.cropbanner').val('');
    })

    $('#banner').change(function(e){
        var files = e.target.files;

        var done = function(url){
            banner.src = url;
            $modal.modal('show');
        }

        if(files && files.length > 0){
            reader = new FileReader();
            reader.onload = function(event){
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $modal.on('shown.bs.modal',function(){
        cropper = new Cropper(banner,{
            aspectRatio : 3,
            viewMode : 4,
        });
    }).on('hidden.bs.modal',function(){
        if($('.cropbanner').val() == ''){
            $('#banner').val('');
        }
        cropper.destroy();
        cropper = null;
    })

    $('#crop').click(function(){
        canvas = cropper.getCroppedCanvas({
            width:400,
            height:300,
        });
        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result;
                $('.cropbanner').attr('width','100px');
                $('.cropbanner').attr('src',base64data);
                $('.cropbanner').val(base64data);
                $modal.modal('hide');
            }
        })
    })
}


function optionprogram(method='selectprogram',selected='') {
    $.ajax({
        url:'/api/AIESEC/infosessions/programs/read',
        method:'GET',
        success:function(data){
            $('.optionprogram').remove();
            $('#'+method).append('<option class="optionprogram" value="">Choose Program</option>');
            $.each(data.data,function(key,item){
                $('#'+method).append('<option class="optionprogram" value="'+item.program_id+'">'+item.theme+'</option>').val(selected);
            })
        }
    })
}

function optionsection(method='selectsection',selected='') {
    $.ajax({
        url:'/api/AIESEC/infosessions/forms/read',
        method:'GET',
        success:function(data){
            $('.optionsection').remove();
            $('#'+method).append('<option class="optionsection" value="">Choose Section</option>');
            $.each(data.data,function(key,item){
                $('#'+method).append('<option class="optionsection" value="'+item.form_id+'">'+item.title+'</option>').val(selected);
            })
        }
    })
}


function publish(publish) {
    var text = publish == 1 ? 'cancel publish' : 'publish';
    return text;
}


function editcropbanner() {
    var $modal = $('#editmodalbanner');
    var banner = document.getElementById('editsample_banner');
    var cropper;
    
    $('#editbanner').click(function(){
        $('#editbanner').val('');
        $('.editcropbanner').val('');
    })

    $('#editbanner').change(function(e){
        var files = e.target.files;

        var done = function(url){
            banner.src = url;
            $modal.modal('show');
        }

        if(files && files.length > 0){
            reader = new FileReader();
            reader.onload = function(event){
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $modal.on('shown.bs.modal',function(){
        cropper = new Cropper(banner,{
            aspectRatio : 3,
            viewMode : 4,
        });
    }).on('hidden.bs.modal',function(){
        if($('.editcropbanner').val() == ''){
            $('#editbanner').val('');
        }
        cropper.destroy();
        cropper = null;
    })

    $('#editcrop').click(function(){
        canvas = cropper.getCroppedCanvas({
            width:400,
            height:300,
        });
        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result;
                $('.editcropbanner').attr('width','100px');
                $('.editcropbanner').attr('src',base64data);
                $('.editcropbanner').val(base64data);
                $modal.modal('hide');
            }
        })
    })
}

$(document).on('click','.form',function(){
    var id = $(this).attr('id').split('_')[1];
    window.location.href = '/AIESEC/infosessions/forms/detail/'+id;
})

$(document).on('click','.publishform',function(){
    var split = $(this).attr('id').split('_');
    var form_id = split[1];
    var title = split[0];
    var publish = $(this).html();
    Swal.fire({
        title: 'Are You Sure '+publish+' This?',
        text: 'do you want to '+publish+' '+title+' this form ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#edit307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, '+publish+' it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/infosessions/forms/publish',
                    method:'GET',
                    data:{
                        form_id: form_id,
                        publish: publish,
                    },
                    beforeSend: function(){
                        $('#loading').show();
                    },
                    success:function(data){
                        $('#loading').hide();
                        if(data.status == false){
                            toastr.error(data.pesan);
                        }else if(data.status == true){
                            toastr.success(data.pesan);
                            readdataform();
                        }
                    }
                })
            }
        })
})

$(document).on('click','.cropbanner',function(){
    $('#banner').click();
})

$(document).on('click','.editcropbanner',function(){
    $('#editbanner').click();
})

$(document).on('submit','#formform',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/infosessions/forms/create',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(){
            $('#createmodal').modal('hide');
            $('#loading').show();
        },
        success:function(data){
            $('#loading').hide();
            if (data.status == true) {
                readdataform();
                $('#createmodal').modal('hide');
                toastr.success(data.pesan);
            }else{
                toastr.error(data.pesan);
            }
        },
        error:function(xhr){
            $('#loading').hide();
            var response = JSON.parse(xhr.responseText);
            $.each( response.message, function( key, value) {
                toastr.error(value);
            });
        }
    })
})

$(document).on('hidden.bs.modal','#createmodal', function (e) {
    $('#formform').trigger("reset");
    $('.cropbanner').attr('src','/assets/internal/images/development/image.png');
    $('.place_profession').remove();
    $('.place_title').remove();
    $('.place_contact').remove();
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformform').trigger("reset");
    $('.place_profession').remove();
    $('.place_title').remove();
    $('.place_contact').remove();
})

$(document).on('click','.editform',function(){
    var split = $(this).attr('id').split('_');
    var form_id = split[1];
    $.ajax({
        url:'/api/AIESEC/infosessions/forms/edit',
        method:'GET',
        data:{
            form_id:form_id
        },
        success:function(data){
            optionprogram('editselectprogram',data.data.program_id);
            $('#editmodaltitle').html('Edit '+data.data.full_name);
            $('#editform_id').val(data.data.form_id);
            $('#editfull_name').val(data.data.full_name);
            
            var profession = data.data.profession.split('|| ');
            $.each(profession,function(k,i){
                $('#editplace_profession').append('<input type="text" name="profession[]" id="editprofession" class="input place_profession" value="'+i+'">');
            });

            var title = data.data.title.split('|| ');
            $.each(title,function(k,i){
                $('#editplace_title').append('<input type="text" name="title[]" id="edittitle" class="input place_title" value="'+i+'">');
            });

            var contact = data.data.contact.split('|| ');
            $.each(contact,function(k,i){
                $('#editplace_contact').append('<input type="text" name="contact[]" id="editcontact" class="input place_contact" value="'+i+'">');
            });

            $('#editdescription').val(data.data.description);
            $('.editcropbanner').attr('src','/assets/internal/images/infosession/form/'+data.data.banner);
            $('#edithiddenbanner').val(data.data.banner);
            editcropbanner();
            $('#editmodal').modal('show');
        }
    })
})

$(document).on('submit','#editformform',function(e){
    e.preventDefault();
    if($('#editbanner').val() != ''){
        $('#edithiddenbanner').val('');
    }
    $.ajax({
        url:'/api/AIESEC/infosessions/forms/update',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(){
            $('#editmodal').modal('hide');
            $('#loading').show();
        },
        success:function(data){
            $('#loading').hide();
            if (data.status == true) {
                readdataform();
                $('#editmodal').modal('hide');
                toastr.success(data.pesan);
            }else{
                toastr.error(data.pesan);
            }
        },error:function(xhr){
            $('#loading').hide();
            var response = JSON.parse(xhr.responseText);
            $.each( response.message, function( key, value) {
                toastr.error(value);
            });
        }
    })
})

$(document).on('click','.deleteform',function(){
    var split = $(this).attr('id').split('_');
    var form_id = split[1];
    var title = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+title+' ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/infosessions/forms/delete',
                    method:'DELETE',
                    data:{
                        form_id: form_id
                    },
                    beforeSend: function(){
                        $('#loading').show();
                    },
                    success:function(data){
                        $('#loading').hide();
                        if(data.status == false){
                            toastr.error(data.pesan);
                        }else if(data.status == true){
                            toastr.success(data.pesan);
                            readdataform();
                        }
                    }
                })
            }
        })
})