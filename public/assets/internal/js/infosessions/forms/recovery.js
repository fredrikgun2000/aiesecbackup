$(document).ready( function () {
    readdataspeaker();
} );

var tablespeaker = $('#table-speaker').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/infosessions/speakers/recovery/read',
        method:'GET',
    },
    "columns":[
        {
            searchable:false, width:'10', data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionbooklet'+i.speaker_id+'" class="recoveryspeaker" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionspeaker'+i.speaker_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-trash-restore hijau restorespeaker" id="'+i.full_name+'_'+i.speaker_id+'"> Recovery</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletepermanentspeaker" id="'+i.full_name+'_'+i.speaker_id+'"> Permanent Delete</i></a></li></ul></span>';
             
            }     
        },
        {
            data:'theme',name:'theme'
        },
        {
            data:'full_name',name:'full_name'
        },
        {
            data:'profession',name:'profession'
        },
        {
            data:'title',name:'title'
        },
        {
            data:'contact',name:'contact'
        },
        {
            data:'description',name:'description'
        },
        {
            width:'10', orderable:false, searchable:false, render : function(data, type, i) {
                return '<a href="/assets/internal/images/infosession/speaker/'+i.photo+'" target="blank">'+i.full_name+'</a>';
            }     
        },
    ]
});


function readdataspeaker() {
    
    tablespeaker.ajax.reload();
}

$(document).on('click','.deletepermanentspeaker',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var speaker_id = split[1];
        var full_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to permanent delete speakers?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/infosessions/speakers/recovery/delete',
                    method:'DELETE',
                    data:{
                        speaker_id: speaker_id
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
                            readdataspeaker();
                        }
                    }
                })
            }
        })
})

$(document).on('click','.restorespeaker',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var speaker_id = split[1];
        var full_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Restore This?',
        text: 'do you want to permanent restore speakers?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/infosessions/speakers/recovery/restore',
                    method:'GET',
                    data:{
                        speaker_id: speaker_id
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
                            readdataspeaker();
                        }
                    }
                })
            }
        })
    
})