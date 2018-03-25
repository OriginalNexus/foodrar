var userInfo;

function userInfoCallback(info)
{
  $('#sideName').html('<i class="fas fa-user"></i> ' + userInfo['name']);
  $('#sideKg').html('<i class="fas fa-recycle"></i> ' + userInfo['quantity'] + ' kg');

  $('#nameSettings').val(userInfo['name']);
  $('#phoneSettings').val(userInfo['telephone']);
  if (userInfo['is_person'])
    $('#personRadioSettings').prop("checked", true);
  else
    $('#companyRadioSettings').prop("checked", true);

  M.updateTextFields();
}

function getUserInfo()
{
  $.getJSON('user_info.php', function(info) {
    if (info) {
      userInfo = info;
      userInfoCallback();
      getRecents();
    }
  });
}

function setQuote()
{
  $.getJSON('quotes.php', function(quotes) {
    if (quotes)
      $('#motivationalContainer').text('"' + quotes[Math.floor(Math.random() * quotes.length)]['text'] + '"');
  });
}

function getRecents()
{
  $.getJSON("recents.php", function(recents) {
    $('#postsContainer').empty();
    var postDivTemplate = $("<div>");
    postDivTemplate.load('post.html', function() {
      $.each(recents, function() {
        var postDiv = postDivTemplate.clone();
        postDiv.find('.weight').text(this['quantity'] + " kg");
        postDiv.find('.location').text(this['location']);
        postDiv.find('.date-time').text(this['date']);
        postDiv.find('.status').text(this['status_display_name']);
        postDiv.appendTo('#postsContainer');
      });
    });
  }).fail(function(req) {
    M.toast({ html: req.responseText });
  });

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
        getRecents();
    });

    $('#badges').click(function()
    {
        $("#pageContainer").load("badges.html");
    });

    $('#vouchers').click(function()
    {
        $("#pageContainer").load("vouchers.html");
    });

    $('#restaurants').click(function()
    {
        $("#pageContainer").load("restaurants.html");
    });

    $('.fixed-action-btn').floatingActionButton();

    $('#loginForm').submit(function(event)
    {
        $.post('login.php', { email: $('#emailLogin').val(), pass: $('#passwordLogin').val() }, function()
        {
                document.location = '';
        }).fail(function(req)
        {
            M.toast({ html: req.responseText });
        });

        return false;
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

    $('#registerForm').submit(function(event)
    {
        $.post('register.php',
        {
            email: $('#emailRegister').val(),
            pass: $('#passwordRegister').val(),
            name: $('#nameRegister').val(),
            tel: $('#phoneRegister').val(),
            is_person: $('#personRadioRegister').prop('checked') ? 1 : 0 }, function(data) {
                document.location = '';
        }).fail(function(req) {
            M.toast({ html: req.responseText });
        });

        return false;
    });

    $('#settingsForm').submit(function(event)
    {
        $.post('settings.php', {
            pass: $('#passwordSettings').val(),
            name: $('#nameSettings').val(),
            tel: $('#phoneSettings').val(),
            is_person: $('#personRadioSettings').prop('checked') ? 1 : 0 }, function(data) {
                M.toast({ html: 'User settings updated!' });
                getUserInfo();
        }).fail(function(req) {
            M.toast({ html: req.responseText });
        });

        return false;
    });

    $('#newPostForm').submit(function()
    {
        $.post('new_post.php', {
            from: $('#fromNewPost').val() + ":00",
            to: $('#toNewPost').val() + ":00",
            kg: $('#kgNewPost').val(),
            address: $('#addressNewPost').val(),
            notes: $('#notesNewPost').val()
        }, function(data) {
          M.toast({ html: 'Post added!' });
          getRecents();
        }).fail(function(req) {
            M.toast({ html: req.responseText });
        });

        return false;
    });

    $('.timepicker').timepicker({
      twelveHour: false
    });

    getUserInfo();

    setQuote();
});
