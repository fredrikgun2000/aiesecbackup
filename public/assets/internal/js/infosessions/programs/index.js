$(document).ready(function(){
    readdataprogram();
})


function readdataprogram() {
    $.ajax({
        url:'/api/AIESEC/infosessions/programs/read',
        method:'GET',
        success:function(data){
            $('.read-program').remove();
            $.each(data.data,function(k,i){
                var poster='/assets/internal/images/development/imagenotfound.png';
                if(i.poster!=null){
                    var poster = '/assets/internal/images/infosession/poster/'+i.poster
                }
                $('#read-program').append('<div class="col-lg-4 read-program program" id="program_'+btoa(i.program_id)+'"><div class="card mx-auto mt-2"><img class="card-img-top" src="'+poster+'" alt="Card image cap" width="" height="280px"><div class="card-body"><h5 class="card-text">'+i.theme+'</h5><small><img src="/assets/internal/images/sdgs/'+i.sdgs+'.png" width="25px" style="border-radius:100%;"> '+i.datetime+'</small></div></div></div>');
            })
        }
    })
}


$(document).on('click','.program',function(){
    var id = $(this).attr('id').split('_')[1];
    window.location.href = '/AIESEC/infosessions/programs/detail/'+id;
})

$(document).on('submit','#formprogram',function(e){
    e.preventDefault();
    $.ajax({
        url:'/api/AIESEC/infosessions/programs/create',
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
                readdataprogram();
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
    $('#formprogram').trigger("reset");
})

$(document).on('hidden.bs.modal','#editmodal', function (e) {
    $('#editformprogram').trigger("reset");
})

$(document).on('click','.deleteprogram',function(){
    var split = $(this).attr('id').split('_');
    var program_id = split[1];
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
                    url:'/api/AIESEC/infosessions/programs/delete',
                    method:'DELETE',
                    data:{
                        program_id: program_id
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
                            readdataprogram();
                        }
                    }
                })
            }
        })
})