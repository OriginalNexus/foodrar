var userInfo;
var currentDisplay = 0;

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
      refreshContent();
    }
  });
}

function refreshContent()
{
  if (currentDisplay == 0) getRecents();
  else if (currentDisplay == 1) getBadges();
  else if (currentDisplay == 2) getRestaurants();
  else if (currentDisplay == 3) getVouchers();
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
  $('#contentTitle').empty();
  $('#itemsContainer').empty();
  $('.fixed-action-btn').hide();
  $.getJSON("recents.php", function(recents) {
    $('#contentTitle').text('Recent posts');
    var itemDivTemplate = $("<div>");
    itemDivTemplate.load('post.html', function() {
      $.each(recents, function() {
        var itemDiv = itemDivTemplate.clone();
        itemDiv.find('.weight').text(this['quantity'] + " kg");
        itemDiv.find('.location').text(this['location']);
        itemDiv.find('.date-time').text(this['date']);
        itemDiv.find('.status').text(this['status_display_name']);
        itemDiv.appendTo('#itemsContainer');
      });
      $('.fixed-action-btn').show();
    });
  }).fail(function(req) {
    M.toast({ html: req.responseText });
  });
}

function getBadges()
{
  $('#contentTitle').empty();
  $('#itemsContainer').empty();
  $('.fixed-action-btn').hide();
  $.getJSON("badges.php", function(badges) {
    $('#contentTitle').text('Badges');
    var itemDivTemplate = $("<div>");
    itemDivTemplate.load('badge.html', function() {
      $.each(badges, function() {
        var itemDiv = itemDivTemplate.clone();
        itemDiv.find('.badgeImg').attr('src', this['icon_url']);
        itemDiv.find('.badgeName').text(this['name']);
        itemDiv.find('.badgeWeight').text(this['target'] + ' kg');
        itemDiv.find('.badgePercent').text('(' + Math.round(Math.min(100, userInfo['quantity'] / this['target'] * 100) * 100) / 100 + '%)');
        itemDiv.appendTo('#itemsContainer');
      });
    });
  }).fail(function(req) {
    M.toast({ html: req.responseText });
  });
}

function getRestaurants()
{
  $('#contentTitle').empty();
  $('#itemsContainer').empty();
  $('.fixed-action-btn').hide();
  $.getJSON('restaurants.php', function(restaurants) {
    $('#contentTitle').text('Involved restaurants');
    var itemDivTemplate = $("<div>");
    itemDivTemplate.load('restaurant.html', function() {
      $.each(restaurants, function() {
        var itemDiv = itemDivTemplate.clone();
        itemDiv.find('.restaurantName').text(this['name']);
        itemDiv.find('.restaurantWeight').text(this['quantity'] + " kg");
        itemDiv.appendTo('#itemsContainer');
      });
    });
  }).fail(function(req) {
    M.toast({ html: req.responseText });
  });
}

function getVouchers()
{
  $('#contentTitle').empty();
  $('#itemsContainer').empty();
  $('.fixed-action-btn').hide();
  $.getJSON('vouchers.php', function(vouchers) {
    $('#contentTitle').text('Vouchers');
    var itemDivTemplate = $("<div>");
    itemDivTemplate.load('voucher.html', function() {
      $.each(vouchers, function() {
        var itemDiv = itemDivTemplate.clone();
        itemDiv.find('.voucherName').text(this['name']);
        itemDiv.find('.voucherCode').text(this['token']);
        itemDiv.find('.voucherValue').text(this['value']);
        itemDiv.appendTo('#itemsContainer');
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
      currentDisplay = 0;
      refreshContent();
    });

    $('#badges').click(function()
    {
      currentDisplay = 1;
      refreshContent();
    });

    $('#vouchers').click(function()
    {
      currentDisplay = 2;
      refreshContent();
    });

    $('#restaurants').click(function()
    {
      currentDisplay = 3;
      refreshContent();
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
          refreshContent();
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
