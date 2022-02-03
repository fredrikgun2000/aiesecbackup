$(document).ready( function () {
    readdatabooklet();
} );

var tablebooklet = $('#table-booklet').DataTable({
    "processing": true,
    "ajax":{
        url: '/api/AIESEC/booklets/recovery/read',
        method:'GET',
    },
    "columns":[
        {
            width:'10', searchable: false, data:'no', name:'no'
        },
        {
            width:'10', orderable:false, searchable: false, render : function(data, type, i) {
                return '<span class="dropdown mx-2" style="list-style-type:none;"><a class="dropdown-toggle" id="actionbooklet'+i.booklet_id+'" class="recoverybooklet" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog biru"></i></a><ul class="dropdown-menu" aria-labelledby="actionbooklet'+i.booklet_id+'"><li class="dropdown-submenu"><a class="dropdown-item" href="#"><i class="fa fa-trash-restore hijau restorebooklet" id="'+i.country_name+'_'+i.booklet_id+'"> Recovery</i></a><a class="dropdown-item" href="#"><i class="fa fa-trash merah deletepermanentbooklet" id="'+i.country_name+'_'+i.booklet_id+'"> Permanent Delete</i></a></li></ul></span>';
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

$(document).on('click','.deletepermanentbooklet',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var booklet_id = split[1];
        var country_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Delete This?',
        text: 'do you want to permanent delete booklets?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/booklets/recovery/delete',
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
                            readdatabooklet();
                        }
                    }
                })
            }
        })
})

$(document).on('click','.restorebooklet',function(){
    id = $(this).attr('id');
    if (id != undefined) {
        var split = id.split('_');
        var booklet_id = split[1];
        var country_name = split[0];
    }
    Swal.fire({
        title: 'Are You Sure Restore This?',
        text: 'do you want to permanent restore booklets?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/api/AIESEC/booklets/recovery/restore',
                    method:'GET',
                    data:{
                        booklet_id: booklet_id
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
                            readdatabooklet();
                        }
                    }
                })
            }
        })
    
})