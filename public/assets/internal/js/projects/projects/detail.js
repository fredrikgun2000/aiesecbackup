$(document).ready(function(){
    readdataprojectdetail();
})

function readdataprojectdetail() {
    var id = window.location.pathname.split('/')[4];
    $.ajax({
        url:'/api/AIESEC/projects/read',
        method:'GET',
        data:{
            id:id,
        },
        success:function(data){
            $.each(data.data,function(k,i){
                var banner='/assets/internal/images/development/imagenotfound.png';
                if(i.banner!=null){
                    var banner = '/assets/internal/images/project/'+i.banner
                }
                $('#banner').css('background-image','url("'+banner+'")');
                $('#typeofproject').text(i.typeofproject);
                $('#title').text(i.title);
                $('#destination').text(i.agency+' - '+i.destination);
                $('#logo_sdgs').attr('src','/assets/internal/images/sdgs/'+i.sdgs+'.png');
                $('#sdgs').text(i.sdgs);
                $('#description').html(i.description);
                var array_wh = i.working_hour.split('|| ');
                $.each(array_wh,function(k,i){
                    $('#working_hour').append('<li>'+i+'</li>');
                });
                readprojectactivities(id);
                $('#accomodation').html(i.accomodation);
                readprojectafees(id);
                var array_benefit = i.benefit.split('|| ');
                $.each(array_benefit,function(k,i){
                    $('#benefit').append('<li>'+i+'</li>');
                });
            })
        }
    })
}

function readprojectactivities(id="kosong") {
    $.ajax({
        url: '/api/AIESEC/projects/activities/read',
        method:'GET',
        data:{
            id:id
        },
        success:function(data){
            $.each(data.data,function(k,i){
                $('#project_activities').append('<div class="row mt-2"><div class="col-12"><small>'+i.time+'</small></div></div><div class="row"><div class="col-12"><h6>'+i.activity_title+'</h6></div></div><div class="row"><div class="col-12"><p>'+i.detail+'</p></div></div>');
            })
        }
    })
}

function readprojectafees(id="kosong") {
    $.ajax({
        url: '/api/AIESEC/projects/fees/read',
        method:'GET',
        data:{
            id:id
        },
        success:function(data){
            $.each(data.data,function(k,i){
                $('#project_activities').append('<div class="row mt-2"><div class="col-8"><div class="row"><div class="col-12"><h6>'+i.fee_title+'<h6></div></div><div class="row"><div class="col-12"><small>'+i.description+'</small></div></div></div><div class="col-4"><h6>'+i.price+'<h6></div></div>');
            })
        }
    })
}
