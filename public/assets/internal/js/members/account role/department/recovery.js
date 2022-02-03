$(document).ready( function () {
    readdatadepartment();
} );

var tabledepartment = $('#table-department').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/members/account-role/department/recovery/read',
        method:'GET',
    },
    "columns":[
        {
            width:'10', searchable: false, data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable: false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actiondepartment'+i.department_id+'" class="recoverydepartment" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actiondepartment'+i.department_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-trash-restore hijau restoredepartment" id="'+i.department_name+'_'+i.department_id+'"> Recovery</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletepermanentdepartment" id="'+i.department_name+'_'+i.department_id+'"> Permanent Delete</i></a></li></ul></span>';
            }    
        },
        {
            data:'department_name',name:'department_name'
        },
    ]
});


function readdatadepartment() {
    
    tabledepartment.ajax.reload();
}

$(document).on('click','.deletepermanentdepartment',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var department_id = split[1];
        var department_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to permanent delete departments?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/account-role/department/recovery/delete',
                    method:'DELETE',
                    data:{
                        department_id: department_id
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
                            readdatadepartment();
                        }
                    }
                })
            }
        })
    
})

$(document).on('click','.restoredepartment',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var department_id = split[1];
        var department_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Restore This?',
        text: 'do you want to permanent restore departments?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/account-role/department/recovery/restore',
                    method:'GET',
                    data:{
                        department_id: department_id
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
                            readdatadepartment();
                        }
                    }
                })
            }
        })
    
})