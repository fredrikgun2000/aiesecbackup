$(document).ready( function () {
    readdatadestination();
} );

var tabledestination = $('#table-destination').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/destination/recovery/read',
        method:'GET',
    },
    "columns":[
        {
            width:'10', searchable: false, data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable: false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actiondestination'+i.destination_id+'" class="recoverydestination" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actiondestination'+i.destination_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-trash-restore hijau restoredestination" id="'+i.country_name+'_'+i.destination_id+'"> Recovery</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletepermanentdestination" id="'+i.country_name+'_'+i.destination_id+'"> Permanent Delete</i></a></li></ul></span>';
            }    
        },
        {
            data:'country_name',name:'country_name'
        },
        {
            data:'description',name:'description'
        },
    ]
});


function readdatadestination() {
    
    tabledestination.ajax.reload();
}

$(document).on('click','.deletepermanentdestination',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var destination_id = split[1];
        var country_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to permanent delete destinations?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/destination/recovery/delete',
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
                            readdatadestination();
                        }
                    }
                })
            }
        })
})

$(document).on('click','.restoredestination',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var destination_id = split[1];
        var country_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Restore This?',
        text: 'do you want to permanent restore destinations?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/destination/recovery/restore',
                    method:'GET',
                    data:{
                        destination_id: destination_id
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
                            readdatadestination();
                        }
                    }
                })
            }
        })
    
})