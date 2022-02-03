
$(document).ready(function() {
    readdataprofile();
    cropimage();
})

$(document).on('click' , '#eye', function(){
    var eye= $(this).attr('class');
    eyeupdate = eye === "fas fa-eye-slash" ? "fas fa-eye" : "fas fa-eye-slash";
    $(this).attr('class',eyeupdate);

    var password= $('input[name="password"]').attr('type');
    passwordupdate = password === "password" ? "text" : "password";
    $('input[name="password"]').attr('type',passwordupdate);
})

function readdataprofile() {
    var member_id = $.session.get('member_id');
    $.ajax({
        url : '/api/AIESEC/members/profile/read',
        method : 'GET',
        data:{
            member_id : member_id,
        },
        success: function(data){
            if (data.status == true) {
                $('.first_name').val(data.data.first_name);
                $('.last_name').val(data.data.last_name);
                $('.email').val(data.data.email);
                $('.birthdate').val(data.data.birthdate);
                $('.join_period').val(data.data.join_period);
            }else{
                toastr.error(data.pesan);
            }
        }
    })
}


function cropimage() {
    var $modal = $('#modal');
    var image = document.getElementById('sample_image');
    var cropper;
    
    $('#photo').click(function(){
        $('#photo').val('');
        $('.cropphoto').val('');
    })

    $('#photo').change(function(e){
        var files = e.target.files;

        var done = function(url){
            image.src = url;
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
        cropper = new Cropper(image,{
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
            height:400,
        });
        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result;
                $('.cropphoto').val(base64data);
                $('#updatephotoprofile').submit();
                $modal.modal('hide');
            }
        })
    })
}

$(document).on('click','.cropphoto',function(){
    $('#photo').click();
})

$(document).on('submit','#updateprofile',function(e){
    e.preventDefault();
    $('.member_id').val($.session.get('member_id'));
    $.ajax({
        url:'/api/AIESEC/members/profile/update',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            if (data.status == true) {
                toastr.success(data.pesan);
            }else{
                toastr.error(data.pesan);
            }
            readdataprofile();
        },error:function(xhr){
            toastr.error('Make Sure You Fill All Field Correctly.');
        }
    })
})

$(document).on('submit','#updatepasswordprofile',function(e){
    e.preventDefault();
    $('.member_id').val($.session.get('member_id'));
    $.ajax({
        url:'/api/AIESEC/members/passwordprofile/update',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            if (data.status == true) {
                toastr.success(data.pesan);
            }else{
                toastr.error(data.pesan);
            }
            window.location.href = '/AIESEC/login';
        },error:function(xhr){
            toastr.error('Make Sure You Fill All Field Correctly.');
        }
    })
})

$(document).on('submit','#updatephotoprofile',function(e){
    e.preventDefault();
    $('.member_id').val($.session.get('member_id'));
    $.ajax({
        url:'/api/AIESEC/members/photoprofile/update',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            if (data.status == true) {
                toastr.success(data.pesan);
                readdataprofile();
            }else{
                toastr.error(data.pesan);
            }
        },error:function(xhr){
            toastr.error('Make Sure You Fill All Field Correctly.');
        }
    })
})