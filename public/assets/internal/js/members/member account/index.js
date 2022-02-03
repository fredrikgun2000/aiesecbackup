$(document).ready(function() {
    readdatamember();
    generatepassword();
})

function generatepassword(){
    var password = Math.random().toString(36).slice(-8);
    $('#password').val(password);
}


var tablemember = $('#table-member').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/members/member-account/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                var operation = '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionmember'+i.member_id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionmember'+i.member_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-pencil hijau editmember" id="'+i.email_section+'_'+i.member_id+'"> Edit</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletemember" id="'+i.member_name+'_'+i.member_id+'"> Delete</i></a><a class="dropdown-item" href="#"><i class="fa fa-upload biru publishmember" id="'+i.title+'_'+i.member_id+'"> '+publish(i.publish)+'</i></a>';
                if(i.full_name == " "){
                    operation += '<a class="dropdown-item" href="#"><i class="fa fa-key kuning infomember" id="'+i.member_id+'"> Regenerate Password</i></a>';
                }
                operation += '</li></ul></span>';
                return operation;
                
            }    
        },
        {
            data:'full_name',name:'full_name'
        },
        {
            data:'email',name:'email'
        },
        {
            data:'role_name',name:'role_name'
        },
        {
            data:'birthdate',name:'birthdate'
        },
        {
            data:'join_period',name:'join_period'
        },
        {
            data:'photo',name:'photo'
        },
        {
            data:'sender_name',name:'sender_name'
        },
    ]
});


function readdatamember() {    
    tablemember.ajax.reload();
    $('#sender_id').val($.session.get('member_id'));
    $('#password').prop('disabled', true);
    optionrole();
}

function publish(publish) {
    var text = publish == 1 ? 'cancel publish' : 'publish';
    return text;
}

$(document).on('click','.publishmember',function(){
    var split = $(this).attr('id').split('_');
    var member_id = split[1];
    var title = split[0];
    var publish = $(this).html();
    Swal.fire({
        title: 'Are You Sure '+publish+' This?',
        text: 'do you want to '+publish+' '+title+' this member ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, '+publish+' it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/member-account/publish',
                    method:'GET',
                    data:{
                        member_id: member_id,
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
                            readdatamember();
                        }
                    }
                })
            }
        })
})

function optionrole(method='selectrole',selected='') {
    $.ajax({
        url:'/api/AIESEC/members/account-role/role/read',
        method:'GET',
        success:function(data){
            $('.optionrole').remove();
            $('#'+method).append('<option class="optionrole" value="">Choose Role</option>');
            $.each(data.data,function(key,item){
                $('#'+method).append('<option class="optionrole" value="'+item.role_id+'">'+item.role_name+'</option>').val(selected);
            })
        }
    })
}

$(document).on('hidden.bs.modal','#createmodal', function (e) {
    $('#formmember').trigger("reset");
    generatepassword();
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformmember').trigger("reset");
    optionrole('selectrole','');
})

$(document).on('click','.infomember',function () {
    var password = Math.random().toString(36).slice(-8);
    Swal.fire({
        title: 'Generate New Password',
        text: 'The New Password Will Be '+password+ '. Are You Want Send To Email?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, Send Email'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('id');
                $.ajax({
                    url:'/api/AIESEC/members/member-account/generatepassword/send',
                    method:'GET',
                    data:{
                        member_id: id,
                        password: password,
                    },
                    beforeSend: function(){
                        $('#loading').show();
                    },
                    success:function(data){
                        if(data.status == false){
                            Swal.fire(
                                'Error!',
                                data.pesan,
                                'error'
                            )
                        }else if(data.status == true){
                            Swal.fire(
                                'Success!',
                                data.pesan,
                                'success'
                            );
                            $('#loading').hide();
                        }
                    }
                })
            }
        })
});

$(document).on('submit','#formmember',function(e){
    e.preventDefault();
    $('#password').prop('disabled', false);
    $.ajax({
        url:'/api/AIESEC/members/member-account/create',
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
            if (data.status == true) {
                readdatamember();
                toastr.success(data.pesan);
            }else{
                toastr.error(data.pesan);
            }
            $('#loading').hide();
        },error:function(xhr){
            var response = JSON.parse(xhr.responseText);
            $('#loading').hide();
            $.each( response.message, function( key, value) {
                toastr.error(value);
            });
        }
    })
    $('#password').prop('disabled', true);
})

$(document).on('click','.editmember',function(){
    var split = $(this).attr('id').split('_');
    var member_id = split[1];
    $.ajax({
        url:'/api/AIESEC/members/member-account/edit',
        method:'GET',
        data:{
            member_id:member_id
        },
        success:function(data){
            optionrole('editselectrole',data.data.role_id);
            $('#editmodaltitle').html('Edit '+data.data.email);
            $('#editmember_id').val(data.data.member_id);
            $('#editjoin_period').val(data.data.join_period);
            $('#editmodal').modal('show');
        },error:function(xhr){
            var response = JSON.parse(xhr.responseText);
            $.each( response.message, function( key, value) {
                toastr.error(value);
            });
        }
    })
})

$(document).on('submit','#editformmember',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/members/member-account/update',
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
            if (data.status == true) {
                readdatamember();
                $('#editmodal2').modal('hide');
                toastr.success(data.pesan);
            }else{
                toastr.error(data.pesan);
            }
            $('#loading').hide();
        },error:function(xhr){
            $('#loading').hide();
            var response = JSON.parse(xhr.responseText);
            $.each( response.message, function( key, value) {
                toastr.error(value);
            });
        }
    })
})

$(document).on('click','.deletemember',function(){
    var split = $(this).attr('id').split('_');
    var member_id = split[1];
    var member_name = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+member_name+' member?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/member-account/delete',
                    method:'DELETE',
                    data:{
                        member_id: member_id
                    },
                    beforeSend: function(){
                        $('#loading').show();
                    },
                    success:function(data){
                        if(data.status == false){
                            Swal.fire(
                                'Error!',
                                data.pesan,
                                'error'
                            )
                        }else if(data.status == true){
                            Swal.fire(
                                'Success!',
                                data.pesan,
                                'success'
                            );
                            $('#loading').hide();
                            readdatamember();
                            optionrole();
                        }
                    }
                })
            }
        })
})