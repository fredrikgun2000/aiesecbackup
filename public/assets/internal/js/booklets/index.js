$(document).ready(function(){
    readdatabooklet();
})

var tablebooklet = $('#table-booklet').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/booklets/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionbooklet'+i.booklet_id+'" class="editbooklet" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionbooklet'+i.booklet_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-pencil hijau editbooklet" id="'+i.title+'_'+i.booklet_id+'"> Edit</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletebooklet" id="'+i.title+'_'+i.booklet_id+'"> Delete</i></a><a class="dropdown-item" href="#"><i class="fa fa-upload biru publishbooklet" id="'+i.title+'_'+i.booklet_id+'"> '+publish(i.publish)+'</i></a></li></ul></span>';
            }     
        },
        {
            data:'title',name:'title'
        },
        {
            data:'description',name:'description'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<a href="/assets/internal/files/booklet/'+i.file+'" target="blank">'+i.title+'</a>';
            }     
        },
    ]
});

function readdatabooklet() {
    tablebooklet.ajax.reload();
}

function publish(publish) {
    var text = publish == 1 ? 'cancel publish' : 'publish';
    return text;
}

$(document).on('click','.publishbooklet',function(){
    var split = $(this).attr('id').split('_');
    var booklet_id = split[1];
    var title = split[0];
    var publish = $(this).html();
    Swal.fire({
        title: 'Are You Sure '+publish+' This?',
        text: 'do you want to '+publish+' '+title+' this booklet ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, '+publish+' it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/booklets/publish',
                    method:'GET',
                    data:{
                        booklet_id: booklet_id,
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
                            readdatabooklet();
                        }
                    }
                })
            }
        })
})

$(document).on('submit','#formbooklet',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/booklets/create',
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
                readdatabooklet();
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
    $('#formbooklet').trigger("reset");
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformbooklet').trigger("reset");
})

$(document).on('click','.editbooklet',function(){
    var split = $(this).attr('id').split('_');
    var booklet_id = split[1];
    $.ajax({
        url:'/api/AIESEC/booklets/edit',
        method:'GET',
        data:{
            booklet_id:booklet_id
        },
        success:function(data){
            $('#editmodaltitle').html('Edit '+data.data.title);
            $('#editbooklet_id').val(data.data.booklet_id);
            $('#edittitle').val(data.data.title);
            $('#editdescription').val(data.data.description);
            $('#edithiddenfile').val(data.data.file);
            $('#editmodal').modal('show');
        }
    })
})

$(document).on('submit','#editformbooklet',function(e){
    e.preventDefault();
    if($('#editfile').val() != ''){
        $('#edithiddenfile').val('');
    }
    $.ajax({
        url:'/api/AIESEC/booklets/update',
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
                readdatabooklet();
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

$(document).on('click','.deletebooklet',function(){
    var split = $(this).attr('id').split('_');
    var booklet_id = split[1];
    var title = split[0];
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to delete '+title+' ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/booklets/delete',
                    method:'DELETE',
                    data:{
                        booklet_id: booklet_id
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
                            readdatabooklet();
                        }
                    }
                })
            }
        })
})