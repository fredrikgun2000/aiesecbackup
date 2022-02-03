$(document).ready( function () {
    readdatamember();
} );

var tablemember = $('#table-member').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/members/member-account/recovery/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionmember'+i.member_id+'" class="recoverymember" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionmember'+i.member_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-trash-restore hijau restoremember" id="'+i.email_section+'_'+i.member_id+'"> Recovery</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletepermanentmember" id="'+i.email_section+'_'+i.member_id+'"> Permanent Delete</i></a></li></ul></span>';
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
}

$(document).on('click','.deletepermanentmember',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var member_id = split[1];
        var member_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to permanent delete members?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/member-account/recovery/delete',
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
                            )
                            $('#loading').hide();
                            readdatamember();
                        }
                    }
                })
            }
        })
    
})

$(document).on('click','.restoremember',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var member_id = split[1];
        var member_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Restore This?',
        text: 'do you want to permanent restore members?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/member-account/recovery/restore',
                    method:'GET',
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
                            )
                            $('#loading').hide();
                            readdatamember();
                        }
                    }
                })
            }
        })
    
})