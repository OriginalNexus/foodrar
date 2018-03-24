$(document).ready(function()
{
    $('.sidenav').sidenav();

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
