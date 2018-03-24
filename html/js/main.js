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
});
