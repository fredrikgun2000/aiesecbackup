$(document).ready(function(){
    readdataspeaker();
    cropphoto();
    optionprogram();
})

var tablespeaker = $('#table-speaker').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/infosessions/speakers/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionspeaker'+i.speaker_id+'" class="editspeaker" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionspeaker'+i.speaker_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-pencil hijau editspeaker" id="'+i.title+'_'+i.speaker_id+'"> Edit</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletespeaker" id="'+i.title+'_'+i.speaker_id+'"> Delete</i></a><a class="dropdown-item" href="#"><i class="fa fa-upload biru publishspeaker" id="'+i.title+'_'+i.speaker_id+'"> '+publish(i.publish)+'</i></a></li></ul></span>';
            }     
        },
        {
            data:'theme',name:'theme'
        },
        {
            data:'full_name',name:'full_name'
        },
        {
            data:'profession',name:'profession'
        },
        {
            data:'title',name:'title'
        },
        {
            data:'contact',name:'contact'
        },
        {
            data:'description',name:'description'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<a href="/assets/internal/images/infosession/speaker/'+i.photo+'" target="blank">'+i.full_name+'</a>';
            }     
        },
    ]
});

function readdataspeaker() {
    tablespeaker.ajax.reload();
    optionprogram();
}

function cropphoto() {
    var $modal = $('#modalphoto');
    var photo = document.getElementById('sample_photo');
    var cropper;
    
    $('#photo').click(function(){
        $('#photo').val('');
        $('.cropphoto').val('');
    })

    $('#photo').change(function(e){
        var files = e.target.files;

        var done = function(url){
            photo.src = url;
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
        cropper = new Cropper(photo,{
            aspectRatio : 1,
            viewMode : 3,
        });
    }).on('hidden.bs.modal',function(){
        if($('.cropphoto').val() == ''){
            $('#photo').val('');
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
                $('.cropphoto').attr('width','100px');
                $('.cropphoto').attr('src',base64data);
                $('.cropphoto').val(base64data);
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
            $('#'+method).append('<option class="optionprogram" value="">Choose project</option>');
            $.each(data.data,function(key,item){
                $('#'+method).append('<option class="optionprogram" value="'+item.program_id+'">'+item.theme+'</option>').val(selected);
            })
        }
    })
}

function publish(publish) {
    var text = publish == 1 ? 'cancel publish' : 'publish';
    return text;
}


function editcropphoto() {
    var $modal = $('#editmodalphoto');
    var photo = document.getElementById('editsample_photo');
    var cropper;
    
    $('#editphoto').click(function(){
        $('#editphoto').val('');
        $('.editcropphoto').val('');
    })

    $('#editphoto').change(function(e){
        var files = e.target.files;

        var done = function(url){
            photo.src = url;
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
        cropper = new Cropper(photo,{
            aspectRatio : 1,
            viewMode : 3,
        });
    }).on('hidden.bs.modal',function(){
        if($('.editcropphoto').val() == ''){
            $('#editphoto').val('');
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
                $('.editcropphoto').attr('width','100px');
                $('.editcropphoto').attr('src',base64data);
                $('.editcropphoto').val(base64data);
                $modal.modal('hide');
            }
        })
    })
}

$(document).on('click','#add_profession',function () {
    $('#place_profession').append('<input type="text" name="profession[]" id="profession" class="input place_profession" placeholder="profession">');
})

$(document).on('click','#add_title',function () {
    $('#place_title').append('<input type="text" name="title[]" id="title" class="input place_title" placeholder="title">');
})

$(document).on('click','#add_contact',function () {
    $('#place_contact').append('<input type="text" name="contact[]" id="contact" class="input place_contact" placeholder="contact">');
})

$(document).on('dblclick', '.place_profession', function () {
    $(this).remove();
})

$(document).on('dblclick', '.place_title', function () {
    $(this).remove();
})

$(document).on('dblclick', '.place_contact', function () {
    $(this).remove();
})

$(document).on('click','#editadd_profession',function () {
    $('#editplace_profession').append('<input type="text" name="profession[]" id="editprofession" class="input place_profession" placeholder="profession">');
})

$(document).on('click','#editadd_title',function () {
    $('#editplace_title').append('<input type="text" name="title[]" id="edittitle" class="input place_title" placeholder="title">');
})

$(document).on('click','#editadd_contact',function () {
    $('#editplace_contact').append('<input type="text" name="contact[]" id="editcontact" class="input place_contact" placeholder="contact">');
})

$(document).on('dblclick', '.editplace_profession', function () {
    $(this).remove();
})

$(document).on('dblclick', '.editplace_title', function () {
    $(this).remove();
})

$(document).on('dblclick', '.editplace_contact', function () {
    $(this).remove();
})

$(document).on('click','.publishspeaker',function(){
    var split = $(this).attr('id').split('_');
    var speaker_id = split[1];
    var title = split[0];
    var publish = $(this).html();
    Swal.fire({
        title: 'Are You Sure '+publish+' This?',
        text: 'do you want to '+publish+' '+title+' this speaker ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, '+publish+' it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/infosessions/speakers/publish',
                    method:'GET',
                    data:{
                        speaker_id: speaker_id,
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
                            readdataspeaker();
                        }
                    }
                })
            }
        })
})

$(document).on('click','.cropphoto',function(){
    $('#photo').click();
})

$(document).on('click','.editcropphoto',function(){
    $('#editphoto').click();
})

$(document).on('submit','#formspeaker',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/infosessions/speakers/create',
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
                readdataspeaker();
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
    $('#formspeaker').trigger("reset");
    $('.place_profession').remove();
    $('.place_title').remove();
    $('.place_contact').remove();
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformspeaker').trigger("reset");
    $('.place_profession').remove();
    $('.place_title').remove();
    $('.place_contact').remove();
})

$(document).on('click','.editspeaker',function(){
    var split = $(this).attr('id').split('_');
    var speaker_id = split[1];
    $.ajax({
        url:'/api/AIESEC/infosessions/speakers/edit',
        method:'GET',
        data:{
            speaker_id:speaker_id
        },
        success:function(data){
            optionprogram('editselectprogram',data.data.program_id);
            $('#editmodaltitle').html('Edit '+data.data.full_name);
            $('#editspeaker_id').val(data.data.speaker_id);
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
            $('.editcropphoto').attr('src','/assets/internal/images/infosession/speaker/'+data.data.photo);
            $('#edithiddenphoto').val(data.data.photo);
            editcropphoto();
            $('#editmodal').modal('show');
        }
    })
})

$(document).on('submit','#editformspeaker',function(e){
    e.preventDefault();
    if($('#editphoto').val() != ''){
        $('#edithiddenphoto').val('');
    }
    $.ajax({
        url:'/api/AIESEC/infosessions/speakers/update',
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
                readdataspeaker();
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

$(document).on('click','.deletespeaker',function(){
    var split = $(this).attr('id').split('_');
    var speaker_id = split[1];
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
                    url:'/api/AIESEC/infosessions/speakers/delete',
                    method:'DELETE',
                    data:{
                        speaker_id: speaker_id
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
                            readdataspeaker();
                        }
                    }
                })
            }
        })
})