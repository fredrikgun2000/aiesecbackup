$(document).on('click' , '#eye', function(){
    var eye= $(this).attr('class');
    eyeupdate = eye === "fas fa-eye-slash" ? "fas fa-eye" : "fas fa-eye-slash";
    $(this).attr('class',eyeupdate);

    var password= $('input[name="password"]').attr('type');
    passwordupdate = password === "password" ? "text" : "password";
    $('input[name="password"]').attr('type',passwordupdate);
})

$(document).on('submit','#validasilogin',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/login/validasi',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            if (data.status == true) {
                toastr.success(data.pesan);
                $.session.set('login',data.status);
                $.session.set('member_id',data.data.member_id);
                $.session.set('first_name',data.data.first_name);
                $.session.set('last_name',data.data.last_name);
                $.session.set('email',data.data.email);
                $.session.set('role',data.data.role);
                $.session.set('join_period',data.data.join_period);
                $.session.set('photo',data.data.photo);
                if($.session.get('first_name') != 'null'){
                    window.location.href = '/AIESEC';
                }else{
                    window.location.href = '/AIESEC/profile/completeprofile';
                }
            }else{
                toastr.error(data.pesan);
            }
        }
    })
})