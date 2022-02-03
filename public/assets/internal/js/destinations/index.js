$(document).ready(function(){
    readdatadestination();
})

var tabledestination = $('#table-destination').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/destinations/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actiondestination'+i.destination_id+'" class="editdestination" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actiondestination'+i.destination_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-pencil hijau editdestination" id="'+i.country_name+'_'+i.destination_id+'"> Edit</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletedestination" id="'+i.country_name+'_'+i.destination_id+'"> Delete</i></a><a class="dropdown-item" href="#"><i class="fa fa-upload biru publishdestination" id="'+i.title+'_'+i.destination_id+'"> '+publish(i.publish)+'</i></a></li></ul></span>';
            }     
        },
        {
            data:'country_name',name:'country_name'
        },
        {
            data:'description',name:'description'
        },
        {
            data:'status',name:'status'
        }
    ]
});

function readdatadestination() {
    tabledestination.ajax.reload();
}

function publish(publish) {
    var text = publish == 1 ? 'cancel publish' : 'publish';
    return text;
}

$(document).on('click','.publishdestination',function(){
    var split = $(this).attr('id').split('_');
    var destination_id = split[1];
    var title = split[0];
    var publish = $(this).html();
    Swal.fire({
        title: 'Are You Sure '+publish+' This?',
        text: 'do you want to '+publish+' '+title+' this destination ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, '+publish+' it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/destinations/publish',
                    method:'GET',
                    data:{
                        destination_id: destination_id,
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
                            readdatadestination();
                        }
                    }
                })
            }
        })
})

$(document).on('submit','#formdestination',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/destinations/create',
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
                readdatadestination();
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


$(document).on('hidden.bs.modal','#createmodal', function (e) {
    $('#formdestination').trigger("reset");
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformdestination').trigger("reset");
})

$(document).on('click','.editdestination',function(){
    var split = $(this).attr('id').split('_');
    var destination_id = split[1];
    $.ajax({
        url:'/api/AIESEC/destinations/edit',
        method:'GET',
        data:{
            destination_id:destination_id
        },
        success:function(data){
            $('#editmodaltitle').html('Edit '+data.data.country_name);
            $('#editdestination_id').val(data.data.destination_id);
            $('#editcountry_name').val(data.data.country_name);
            if(data.data.status == 'recommended'){
                $('#editstatus1').attr('checked',true);
            }else if(data.data.status == 'not recommended'){
                $('#editstatus2').attr('checked',true);
            }
            $('#editmodal').modal('show');
        }
    })
})

$(document).on('submit','#editformdestination',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/destinations/update',
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
                readdatadestination();
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

$(document).on('click','.deletedestination',function(){
    var split = $(this).attr('id').split('_');
    var destination_id = split[1];
    var country_name = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+country_name+' ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/destinations/delete',
                    method:'DELETE',
                    data:{
                        destination_id: destination_id
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
                            readdatadestination();
                        }
                    }
                })
            }
        })
})