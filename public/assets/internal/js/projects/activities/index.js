$(document).ready(function() {
    readdataactivities();
})

var tableactivities = $('#table-activities').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/projects/activities/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                var operation = '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionactivities'+i.activity_id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionactivities'+i.activity_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-pencil hijau editactivity" id="'+i.activity_title+'_'+i.activity_id+'"> Edit</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deleteactivities" id="'+i.activity_title+'_'+i.activity_id+'"> Delete</i></a></li></ul></span>';
                return operation;
                
            }    
        },
        {
            data:'project_title',name:'project_title'
        },
        {
            data:'activity_title',name:'activity_title'
        },
        {
            data:'time',name:'time'
        },
        {
            data:'detail',name:'detail'
        },
    ]
});


function readdataactivities() {    
    tableactivities.ajax.reload();
    optionproject();
}

function optionproject(method='selectproject',selected='') {
    $.ajax({
        url:'/api/AIESEC/projects/read',
        method:'GET',
        success:function(data){
            $('.optionproject').remove();
            $('#'+method).append('<option class="optionproject" value="">Choose project</option>');
            $.each(data.data,function(key,item){
                $('#'+method).append('<option class="optionproject" value="'+item.project_id+'">'+item.title+'</option>').val(selected);
            })
        }
    })
}

$(document).on('hidden.bs.modal','#createmodal', function (e) {
    $('#formactivity').trigger("reset");
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformactivity').trigger("reset");
    optionproject('selectproject','');
})

$(document).on('submit','#formactivity',function(e){
    e.preventDefault();
    $('#password').prop('disabled', false);
    $.ajax({
        url:'/api/AIESEC/projects/activities/create',
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
                readdataactivities();
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

$(document).on('click','.editactivity',function(){
    var split = $(this).attr('id').split('_');
    var activity_id = split[1];
    $.ajax({
        url:'/api/AIESEC/projects/activities/edit',
        method:'GET',
        data:{
            activity_id:activity_id
        },
        success:function(data){
            optionproject('editselectproject',data.data.project_id);
            $('#editmodaltitle').html('Edit '+data.data.title);
            $('#editactivity_id').val(data.data.activity_id);
            $('#edittitle').val(data.data.title);
            $('#edittime').val(data.data.time);
            $('#editdetail').val(data.data.detail);
            $('#editmodal').modal('show');
        },error:function(xhr){
            var response = JSON.parse(xhr.responseText);
            $.each( response.message, function( key, value) {
                toastr.error(value);
            });
        }
    })
})

$(document).on('submit','#editformactivity',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/projects/activities/update',
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
                readdataactivities();
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

$(document).on('click','.deleteactivities',function(){
    var split = $(this).attr('id').split('_');
    var activity_id = split[1];
    var activities_name = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+activities_name+' activities?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/projects/activities/delete',
                    method:'DELETE',
                    data:{
                        activity_id: activity_id
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
                            readdataactivities();
                            optionproject();
                        }
                    }
                })
            }
        })
})