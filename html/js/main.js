
function userLoggedInCallback(info)
{
  $('#nameSettings').val(info['name']);
  $('#phoneSettings').val(info['telephone']);
  if (info['is_person'])
    $('#personRadioSettings').prop("checked", true);
  else
    $('#companyRadioSettings').prop("checked", true);

  M.updateTextFields();
}


$(document).ready(function()
{
    $('.sidenav').sidenav();
    $('.modal').modal();

    $('.fa-sign-in-alt').click(function()
    {
        $('#loginModal').modal('open');
    });

    $('.fa-user-plus').click(function()
    {
        $('#registerModal').modal('open');
    });

    $('.sideItemContainer').click(function()
    {
        $(".sidenav-overlay").click();
    });

    $('#recents').click(function()
    {
        alert("Recents clicked.");
    });

    $('#badges').click(function()
    {
        alert("Badges clicked.");
    });

    $('#vouchers').click(function()
    {
        alert("Vouchers clicked.");
    });

    $('#restaurants').click(function()
    {
        alert("restaurants clicked.");
    });

    $('#loginBtn').click(function()
    {
        $.post('login.php', { email: $('#emailLogin').val(), pass: $('#passwordLogin').val() }, function() {
                document.location = '';
        }).fail(function(req) {
            M.toast({ html: req.responseText });
        });
    });

    $('#logoutBtn').click(function()
    {
        $.post('logout.php', {}, function() {
                document.location = '';
        }).fail(function(req) {
            M.toast({ html: req.responseText });
        });
    });

    $('#registerBtn').click(function()
    {
        $.post('register.php', {
            email: $('#emailRegister').val(),
            pass: $('#passwordRegister').val(),
            name: $('#nameRegister').val(),
            tel: $('#phoneRegister').val(),
            is_person: $('#personRadioRegister:checked').length }, function(data) {
                document.location = '';
        }).fail(function(req) {
            M.toast({ html: req.responseText });
        });
    });

    $('#settingsBtn').click(function()
    {
        $.post('settings.php', {
            pass: $('#passwordSettings').val(),
            name: $('#nameSettings').val(),
            tel: $('#phoneSettings').val(),
            is_person: $('#personRadioSettings:checked').length }, function(data) {
                document.location = '';
        }).fail(function(req) {
            M.toast({ html: req.responseText });
        });
    });


    $.getJSON("user_info.php", function(info) {
      if (info)
        userLoggedInCallback(info);
    });


});
