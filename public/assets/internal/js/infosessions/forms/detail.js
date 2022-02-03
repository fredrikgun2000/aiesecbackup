$(document).ready(function(){
    readform();
})

function readform() {
    $('.banner').remove();
    $('.section').remove();
    var id = window.location.pathname.split('/')[5];
    $.ajax({
        url: '/api/AIESEC/infosessions/forms/read',
        method: 'GET',
        data: {
            id: id,
        },
        success: function (data) {
            $.each(data.data,function(k,i){
                form_id = i.form_id;
                var banner = '';
            if(i.banner != null){
                banner += 
                    '<img src="/assets/internal/images/infosession/banner/'+i.banner+'" width="100%" height="200px" class="banner updatesection" id="banner_'+form_id+'">';
            }else{
                banner ='';
            }
            $('#place_section').append(
                '<div class="row banner">'+
                    '<div class="col-12">'+
                        banner+
                    '</div>'+
                '</div>'+
                '<div class="row my-2 section">'+
                    '<div class="col-12 px-5 py-2 ">'+
                  '<div class="row my-2">'+
                      '<div class="col-12">'+
                        '<input type="text" class="title w-100 updatesection" id="title_'+form_id+'" placeholder="Sub Title" value="'+i.title+'">'+
                '</div>'+
                '</div>'+
                  '<div class="row my-3">'+
                    '<div class="col-12">'+
                      '<textarea class="w-100 updatesection" name="" id="description_'+form_id+'" placeholder="Description">'+i.description+'</textarea>'+
                    '</div>'+
                  '</div>'+
                  '<div class="row my-2">'+
                      '<div class="col-12">'+
                      '<i class="fa fa-plus createquestion" id="create_question_'+form_id+'"></i>'+
              '</div>'+
            '</div>'+
                    '<div id="place_question_'+form_id+'">'+
                    '</div>'+
                '</div>'+
              '</div>'
            );
            readquestion(form_id)
            
            })
            publish(data.data[0].publish);
        }
    })
}

function readquestion(id){
    $.ajax({
        url : '/api/AIESEC/infosessions/questions/read',
        method: 'GET',
        data: {
            id: id,
        },
        success: function (data) {
            $.each(data.data,function(k,i){
                question_id = i.question_id;
                $('#place_question_'+id).append(
                '<div class="row mt-5">'+
                    '<div class="col-7">'+
                    '<div class="row">'+
                        '<div class="col-12">'+
                        '<input type="text" class="w-100 text updatequestion" placeholder="Pertanyaan" value="'+i.text+'" id="text_'+id+'_'+question_id+'">'+
                        '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-1 text-center">'+
                    '<i class="fa fa-image image" id="image_'+id+'_'+question_id+'"></i>'+
                    '</div>'+
                    '<div class="col-3">'+
                    '<div class="row">'+
                        '<div class="col-12">'+
                        '<select name="" id="type_'+id+'_'+question_id+'" class="w-100 type updatequestion">'+
                            '<option value="">Choose Option</option>'+
                            '<option value="short">Short Answer</option>'+
                            '<option value="description">Description Answer</option>'+
                            '<option value="radio">Radio Button</option>'+
                            '<option value="checkbox">Check Box</option>'+
                            '<option value="likert">Likert</option>'+
                            '<option value="file">File</option>'+
                        '</select>'+
                        '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-1 text-center">'+
                    '<i class="fa fa-times"></i>'+
                    '</div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col-12 description updatequestion" id="place_description_'+id+'_'+question_id+'">'+
                    '</div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col-12" id="place_answer_'+id+'_'+question_id+'">'+
                    '</div>'+
                '</div>');
                readtypequestion(i.type,id,question_id);
            })
        }
    })

}

function readtypequestion(type,id,question_id) {
    if(type != ''){
        $('#type_'+id+'_'+question_id).val(type);
    }
}

function publish(publish) {
    var text = publish == 1 ? 'cancel publish' : 'publish';
    $('.publishform').html(text);
    checkpublish();
}

function checkpublish() {
    var id = window.location.pathname.split('/')[5];
    $.ajax({
        url: '/api/AIESEC/infosessions/forms/read',
        method: 'GET',
        data: {
            id: id,
        },
        success: function (data) {
            if(data.data[0].publish == 1){
                $('input, textarea').attr('readonly','readonly');
                $('button, select, option, i, input').prop('disabled',true);
                $('.publishform').prop('disabled',false);
                $('.exclamation').show();
            }else{
                $('.exclamation').hide();
            }
        }
    })
}

$(document).on('click', '.publishform', function () {
    var form_id = window.location.pathname.split('/')[5];
    var publish = $('.publishform').html();
    Swal.fire({
        title: 'Are You Sure ' + publish + ' This?',
        text: 'do you want to ' + publish + ' this infosession ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#307EF3',
        cancelButtonColor: '#F85A40',
        confirmButtonText: 'Yes, ' + publish + ' it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/api/AIESEC/infosessions/forms/publish',
                method: 'GET',
                data: {
                    form_id: form_id,
                    publish: publish,
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#loading').hide();
                    if (data.status == false) {
                        toastr.error(data.pesan);
                    } else if (data.status == true) {
                        toastr.success(data.pesan);
                        readform();
                    }
                }
            })
        }
    })
})

$(document).on('change', '.updatesection',function(){
    var array = $(this).attr('id').split('_');
    var value = $(this).val();
    $.ajax({
        url:'/api/AIESEC/infosessions/forms/update',
        method:'POST',
        data:{
            column:array[0],
            form_id:array[1],
            value:value,
        },
        success:function(data){

        }
    }) 
})

$(document).on('change', '.updatequestion',function(){
    var array = $(this).attr('id').split('_');
    var value = $(this).val();
    $.ajax({
        url:'/api/AIESEC/infosessions/questions/update',
        method:'POST',
        data:{
            column:array[0],
            question_id:array[2],
            value:value,
        },
        success:function(data){

        }
    }) 
})

$(document).on('click', '.createsection',function(){
    var form_id = window.location.pathname.split('/')[5];
    $.ajax({
        url:'/api/AIESEC/infosessions/forms/create',
        method:'POST',
        data:{
            section_id : atob(form_id)
        },
        success:function(data){
            readform();
        }
    })
})

$(document).on('click', '.createquestion',function(){
    var form_id = $(this).attr('id').split('_')[2];
    $.ajax({
        url:'/api/AIESEC/infosessions/questions/create',
        method:'POST',
        data:{
            form_id : form_id,
        },
        success:function(data){
            readform();
        }
    })
})