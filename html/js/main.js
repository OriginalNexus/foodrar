
function userLoggedInCallback(info)
{
  // alert('will load content soon');
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
        $("#pageContainer").load("recents.html");
    });

    $('#badges').click(function()
    {
        // alert("Badges clicked.");
    });

    $('#vouchers').click(function()
    {
        // alert("Vouchers clicked.");
    });

    $('#restaurants').click(function()
    {
        // alert("restaurants clicked.");
    });

    $('#loginBtn').click(function()
    {
        $.post('login.php', { email: $('#emailLogin').val(), pass: $('#passwordLogin').val() }, function()
        {
                document.location = '';
        }).fail(function(req)
        {
            M.toast({ html: req.responseText });
        });
    });

    $('#logoutBtn').click(function()
    {
        $.post('logout.php', {}, function()
        {
                document.location = '';
        }).fail(function(req)
        {
            M.toast({ html: req.responseText });
        });
    });

    $('#registerBtn').click(function()
    {
        $.post('register.php',
        {
            email: $('#emailRegister').val(),
            pass: $('#passwordRegister').val(),
            name: $('#nameRegister').val(),
            tel: $('#phoneRegister').val(),
            is_person: $('#isCompanyRegister')[0].checked ? 0 : 1 }, function()
            {
                document.location = '';
            }).fail(function(req)
            {
                M.toast({ html: req.responseText });
            });
    });

    $.getJSON("user_info.php", function(info)
     {
        if (info) userLoggedInCallback(info);
     });
});
