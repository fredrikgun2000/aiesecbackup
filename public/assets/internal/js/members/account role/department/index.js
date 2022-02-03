$(document).ready( function () {
    readdatadepartment();
} );

var tabledepartment = $('#table-department').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/members/account-role/department/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actiondepartment'+i.department_id+'" class="editdepartment" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actiondepartment'+i.department_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-pencil hijau editdepartment" id="'+i.department_name+'_'+i.department_id+'"> Edit</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletedepartment" id="'+i.department_name+'_'+i.department_id+'"> Delete</i></a></li></ul></span>';
            }    
        },
        {
            data:'department_name',name:'department_name'
        },
    ]
});


function readdatadepartment() {
    tabledepartment.ajax.reload();
    optiondepartment();
}

$(document).on('hidden.bs.modal','#createmodal', function (e) {
    $('#formdepartment').trigger("reset");
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformdepartment').trigger("reset");
})

$(document).on('submit','#formdepartment',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/members/account-role/department/create',
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
                readdatadepartment();
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

$(document).on('click','.editdepartment',function(){
    var split = $(this).attr('id').split('_');
    var department_id = split[1];
    $.ajax({
        url:'/api/AIESEC/members/account-role/department/edit',
        method:'GET',
        data:{
            department_id:department_id
        },
        success:function(data){
            $('#editmodaltitle').html('Edit '+data.data.department_name);
            $('#editdepartment_id').val(data.data.department_id);
            $('#editdepartment_name').val(data.data.department_name);
            $('#editmodal').modal('show');
        }
    })
})

$(document).on('submit','#editformdepartment',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/members/account-role/department/update',
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
                readdatadepartment();
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

$(document).on('click','.deletedepartment',function(){
    var split = $(this).attr('id').split('_');
    var department_id = split[1];
    var department_name = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+department_name+' department?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/members/account-role/department/delete',
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
                            toastr.error(data.pesan);
                        }else if(data.status == true){
                            toastr.success(data.pesan);
                            readdatadepartment();
                        }
                    }
                })
            }
        })
})