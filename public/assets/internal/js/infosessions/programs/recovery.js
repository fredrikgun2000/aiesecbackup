$(document).ready( function () {
    readdataprogram();
} );

function readdataprogram() {
    $.ajax({
        url:'/api/AIESEC/infosessions/programs/recovery/read',
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
    window.location.href = '/AIESEC/infosessions/programs/recovery/detail/'+id;
})


$(document).on('click','.deletepermanentprogram',function(){
    var id = window.location.pathname;
    if (id != undefined) {
        var split = id.split('/');
        var program_id = split[6];
    }
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to permanent delete programs?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/infosessions/programs/recovery/delete',
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
                            readdataprogram();
                        }
                    }
                })
            }
        })
})

$(document).on('click','.restoreprogram',function(){
    var id = window.location.pathname;
    if (id != undefined) {
        var split = id.split('/');
        var program_id = split[6];
    }
    Swal.fire({
        title: 'Are You Sure Restore This?',
        text: 'do you want to permanent restore programs?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/infosessions/programs/recovery/restore',
                    method:'GET',
                    data:{
                        program_id: program_id
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
                            readdataprogram();
                        }
                    }
                })
            }
        })
    
})