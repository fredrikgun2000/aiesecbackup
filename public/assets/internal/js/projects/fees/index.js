$(document).ready(function() {
    readdatafees();
})

var tablefees = $('#table-fees').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/projects/fees/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                var operation = '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionfees'+i.fee_id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionfees'+i.fee_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-pencil hijau editfee" id="'+i.fee_title+'_'+i.fee_id+'"> Edit</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletefees" id="'+i.fee_title+'_'+i.fee_id+'"> Delete</i></a></li></ul></span>';
                return operation;
                
            }    
        },
        {
            data:'project_title',name:'project_title'
        },
        {
            data:'fee_title',name:'fee_title'
        },
        {
            data:'description',name:'description'
        },
        {
            data:'price',name:'price'
        },
    ]
});


function readdatafees() {    
    tablefees.ajax.reload();
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
    $('#formfee').trigger("reset");
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformfee').trigger("reset");
    optionproject('selectproject','');
})

$(document).on('submit','#formfee',function(e){
    e.preventDefault();
    $('#password').prop('disabled', false);
    $.ajax({
        url:'/api/AIESEC/projects/fees/create',
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
                readdatafees();
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

$(document).on('click','.editfee',function(){
    var split = $(this).attr('id').split('_');
    var fee_id = split[1];
    $.ajax({
        url:'/api/AIESEC/projects/fees/edit',
        method:'GET',
        data:{
            fee_id:fee_id
        },
        success:function(data){
            optionproject('editselectproject',data.data.project_id);
            $('#editmodaltitle').html('Edit '+data.data.title);
            $('#editfee_id').val(data.data.fee_id);
            $('#edittitle').val(data.data.title);
            $('#editdescription').val(data.data.description);
            $('#editprice').val(data.data.price);
            $('#editmodal').modal('show');
        },error:function(xhr){
            var response = JSON.parse(xhr.responseText);
            $.each( response.message, function( key, value) {
                toastr.error(value);
            });
        }
    })
})

$(document).on('submit','#editformfee',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/projects/fees/update',
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
                readdatafees();
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

$(document).on('click','.deletefees',function(){
    var split = $(this).attr('id').split('_');
    var fee_id = split[1];
    var fees_name = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+fees_name+' fees?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/projects/fees/delete',
                    method:'DELETE',
                    data:{
                        fee_id: fee_id
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
                            readdatafees();
                            optionproject();
                        }
                    }
                })
            }
        })
})