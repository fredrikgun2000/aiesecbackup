$(document).ready(function(){
    readdataproject();
    cropbanner();
    optiondestination();
})

function readdataproject() {
    $.ajax({
        url:'/api/AIESEC/projects/read',
        method:'GET',
        success:function(data){
            $('.read-project').remove();
            $.each(data.data,function(k,i){
                var banner='/assets/internal/images/development/imagenotfound.png';
                if(i.banner!=null){
                    var banner = '/assets/internal/images/project/'+i.banner
                }
                $('#read-project').append('<div class="col-lg-4 read-project project" id="project_'+btoa(i.project_id)+'"><div class="card mx-auto mt-2" style="width:100%;"><img class="card-img-top" src="'+banner+'" alt="Card image cap"><div class="card-body"><h5 class="card-text">'+i.title+'</h5><small><img src="/assets/internal/images/sdgs/'+i.sdgs+'.png" width="25px" style="border-radius:100%;"> '+i.destination+'</small></div></div></div>');
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
            aspectRatio : 4,
            viewMode : 5,
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
                $('.cropbanner').attr('width','150px');
                $('.cropbanner').attr('src',base64data);
                $('.cropbanner').val(base64data);
                $modal.modal('hide');
            }
        })
    })
}

function optiondestination(method='selectdestination',selected='') {
    $.ajax({
        url:'/api/AIESEC/destinations/read',
        method:'GET',
        success:function(data){
            $('.optiondestination').remove();
            $('#'+method).append('<option class="optiondestination" value="">Choose Destination</option>');
            $.each(data.data,function(key,item){
                $('#'+method).append('<option class="optiondestination" value="'+item.destination_id+'">'+item.country_name+'</option>').val(selected);
            })
        }
    })
}

$(document).on('click','.project',function(){
    var id = $(this).attr('id').split('_')[1];
    window.location.href = '/AIESEC/projects/detail/'+id;
})

$(document).on('click','#add_wh',function () {
    $('#place_wh').append('<input type="text" name="working_hour[]" id="working_hour" class="input place_wh" placeholder="Working Hour">')
})

$(document).on('click','#add_benefit',function () {
    $('#place_benefit').append('<input type="text" name="benefit[]" id="benefit" class="input place_benefit" placeholder="Benefit">');
})

$(document).on('dblclick', '.place_wh', function () {
    $(this).remove();
})

$(document).on('dblclick', '.place_benefit', function () {
    $(this).remove();
})

$(document).on('click','#btn_search',function(){
    var search = $('#input_search').val();
    $.ajax({
        url:'/api/AIESEC/projects/search',
        method:'GET',
        data:{
            search:search
        },
        success:function(data){
            $('.read-project').remove();
            $.each(data.data,function(k,i){
                var banner='/assets/internal/images/development/imagenotfound.png';
                if(i.banner!=null){
                    var banner = '/assets/internal/images/project/'+i.banner
                }
                $('#read-project').append('<div class="col-lg-4 read-project project" id="project_'+btoa(i.project_id)+'"><div class="card mx-auto mt-2" style="width:100%;"><img class="card-img-top" src="'+banner+'" alt="Card image cap"><div class="card-body"><h5 class="card-text">'+i.title+'</h5><small><img src="/assets/internal/images/sdgs/'+i.sdgs+'.png" width="25px" style="border-radius:100%;"> '+i.destination+'</small></div></div></div>');
            })
        }
    })
    
})

$(document).on('click','.cropbanner',function(){
    $('#banner').click();
})

$(document).on('submit','#formproject',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/projects/create',
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
                readdataproject();
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
    $('#formproject').trigger("reset");
    $('.cropbanner').attr('src','/assets/internal/images/development/image.png');
    $('.cropbanner').attr('width','30px');
    optiondestination();
    $('.place_wh').remove();
    $('.place_benefit').remove();
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformproject').trigger("reset");
})

$(document).on('click','.editproject',function(){
    var split = $(this).attr('id').split('_');
    var project_id = split[1];
    $.ajax({
        url:'/api/AIESEC/project/edit',
        method:'GET',
        data:{
            project_id:project_id
        },
        success:function(data){
            $('#editmodaltitle').html('Edit '+data.data.country_name);
            $('#editproject_id').val(data.data.project_id);
            $('#editcountry_name').val(data.data.country_name);
            $('#editmodal').modal('show');
        }
    })
})

$(document).on('submit','#editformproject',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/project/update',
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
                readdataproject();
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

$(document).on('click','.deleteproject',function(){
    var split = $(this).attr('id').split('_');
    var project_id = split[1];
    var country_name = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+country_name+' ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/project/delete',
                    method:'DELETE',
                    data:{
                        project_id: project_id
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
                            readdataproject();
                        }
                    }
                })
            }
        })
})