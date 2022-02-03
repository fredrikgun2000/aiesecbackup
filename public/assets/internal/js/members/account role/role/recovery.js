$(document).ready( function () {
    readdatarole();
} );

var tablerole = $('#table-role').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/members/account-role/role/recovery/read',
        method:'GET',
    },
    "columns":[
        {
            width:'10', searchable: false, data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable: false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionrole'+i.role_id+'" class="recoveryrole" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionrole'+i.role_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-trash-restore hijau restorerole" id="'+i.role_name+'_'+i.role_id+'"> Recovery</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletepermanentrole" id="'+i.role_name+'_'+i.role_id+'"> Permanent Delete</i></a></li></ul></span>';
            }    
        },
        {
            data:'role_name',name:'role_name'
        },
    ]
});


function readdatarole() {
    tablerole.ajax.reload();
}

$(document).on('click','.deletepermanentrole',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var role_id = split[1];
        var role_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to permanent delete roles?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/account-role/role/recovery/delete',
                    method:'DELETE',
                    data:{
                        role_id: role_id
                    },
                    beforeSend: function(){
                        $('#loading').show();
                    },
                    success:function(data){
                        $('#loading').hide();
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
                            readdatarole();
                        }
                    }
                })
            }
        })
    
})

$(document).on('click','.restorerole',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var role_id = split[1];
        var role_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Restore This?',
        text: 'do you want to permanent restore roles?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/account-role/role/recovery/restore',
                    method:'GET',
                    data:{
                        role_id: role_id
                    },
                    beforeSend: function(){
                        $('#loading').show();
                    },
                    success:function(data){
                        $('#loading').hide();
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
                            readdatarole();
                        }
                    }
                })
            }
        })
    
})