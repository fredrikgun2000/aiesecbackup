$(document).ready(function(){
    $('#link-success-login').hide();
    check_status_login();
})

function check_status_login() {
    $('#link-success-login').hide();
    var session_login = $.session.get('login');
    var session_firstname = $.session.get('first_name');
    if(session_login != 'true'){
      window.location.href = '/AIESEC/login';
    }else if(session_firstname =='null'){
      window.location.href = '/AIESEC/profile/completeprofile';
    }else{
        success_status_login();
    }
}

function success_status_login() {
    $('#link-success-login').show();
    $('#link-login').remove();
    $('#profile-full-name').html('<b>'+$.session.get('last_name')+' '+$.session.get('first_name')+'</b>');
}

$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
  }
  var $subMenu = $(this).next('.dropdown-menu');
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass('show');
  });


  return false;
});

$(document).on('click','#logout',function(){
    $.session.clear();
    window.location.reload();
})