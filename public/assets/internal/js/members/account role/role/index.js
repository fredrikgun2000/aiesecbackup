$(document).ready( function () {
    readdatarole();
} );

var tablerole = $('#table-role').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/members/account-role/role/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionrole'+i.role_id+'" class="editrole" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionrole'+i.role_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-pencil hijau editrole" id="'+i.role_name+'_'+i.role_id+'"> Edit</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deleterole" id="'+i.role_name+'_'+i.role_id+'"> Delete</i></a></li></ul></span>';
            }    
        },
        {
            data:'role_name',name:'role_name'
        },
        {
            data:'position',name:'position'
        },
        {
            data:'department_name',name:'depatment_name'
        },
    ]
});


function readdatarole() {    
    tablerole.ajax.reload();
}

function optiondepartment(method='selectdepartment',selected='') {
    $.ajax({
        url:'/api/AIESEC/members/account-role/department/read',
        method:'GET',
        success:function(data){
            $('.optiondepartment').remove();
            $('#'+method).append('<option class="optiondepartment" value="">Choose Department</option>');
            $.each(data.data,function(key,item){
                $('#'+method).append('<option class="optiondepartment" value="'+item.department_id+'">'+item.department_name+'</option>').val(selected);
            })
        }
    })
}

$(document).on('hidden.bs.modal','#createmodal2', function (e) {
    $('#formrole').trigger("reset");
})

$(document).on('hidden.bs.modal','#editmodal2', function (e) {
    $('#editformrole').trigger("reset");
    optiondepartment('selectdepartment','');
})

$(document).on('submit','#formrole',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/members/account-role/role/create',
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
                readdatarole();
                $('#createmodal2').modal('hide');
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

$(document).on('click','.editrole',function(){
    var split = $(this).attr('id').split('_');
    var role_id = split[1];
    $.ajax({
        url:'/api/AIESEC/members/account-role/role/edit',
        method:'GET',
        data:{
            role_id:role_id
        },
        success:function(data){
            optiondepartment('editselectdepartment',data.data.department_id);
            $('#editmodal2title').html('Edit '+data.data.role_name);
            $('#editrole_id').val(data.data.role_id);
            $('#editrole_name').val(data.data.role_name);
            $('#editposition').val(data.data.position);
            $('#editmodal2').modal('show');
        },error:function(xhr){
            var response = JSON.parse(xhr.responseText);
            $.each( response.message, function( key, value) {
                toastr.error(value);
            });
        }
    })
})

$(document).on('submit','#editform2role',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/members/account-role/role/update',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(){
            $('#editmodal2').modal('hide');
            $('#loading').show();
        },
        success:function(data){
            $('#loading').hide();
            if (data.status == true) {
                readdatarole();
                $('#editmodal2').modal('hide');
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

$(document).on('click','.deleterole',function(){
    var split = $(this).attr('id').split('_');
    var role_id = split[1];
    var role_name = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+role_name+' role?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/account-role/role/delete',
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
                            toastr.error(data.pesan);
                        }else if(data.status == true){
                            toastr.success(data.pesan);
                            readdatarole();
                            optiondepartment();
                        }
                    }
                })
            }
        })
})