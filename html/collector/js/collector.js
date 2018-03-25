var userInfo;

function userInfoCallback()
{
  // user userInfo here
  console.log(userInfo['email']);
}

function getUserInfo()
{
  $.getJSON('user_info.php', function(info) {
    if (info) {
      userInfo = info;
      userInfoCallback();
      getPosts();
    }
  });
}

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function getPosts()
{
  $('#itemsContainer').empty();
  $.getJSON("posts.php", function(posts) {
    var itemDivTemplate = $("<div>");
    itemDivTemplate.load('post.html', function() {
      $.each(posts, function() {
        var itemDiv = itemDivTemplate.clone();
        itemDiv.find('.weight').text(this['quantity'] + " kg");
        itemDiv.find('.location').text(this['location']);
        var time1 = new Date("July 1 2018, " + this['time_lower']);
        var time2 = new Date("July 1 2018, " + this['time_upper']);
        itemDiv.find('.date-time').text(addZero(time1.getHours()) + ":" + addZero(time1.getMinutes()) + " - " + addZero(time2.getHours()) + ":" + addZero(time2.getMinutes()));
        itemDiv.find('.status').text(this['status_display_name']);
        itemDiv.find('.userName').text(this['user_name']);
        itemDiv.find('.phoneNumber').text(this['user_telephone']);
        itemDiv.find('.phoneNumber').attr('href', "tel://" + this['user_telephone']);
        itemDiv.find('.phoneNumber').click(function(event) {
          event.stopPropagation();
        });
        itemDiv.children('.customContainer').data('post', this);
        itemDiv.appendTo('#itemsContainer');
      });

      $(".customContainer .location").click(function(event)
      {
        window.location = "https://www.google.com/maps/search/?api=1&query=" + encodeURI($(this).parents('.customContainer').data('post')['location']);
        return false;
      });

      $(".customContainer").click(function(event)
      {
        if ($(this).data('post')['status'] === 'unprocessed') {
          if(confirm("Are you sure you want to pick up waste from " + $(this).data('post')['location'] + "?")) {
            $.post('status.php', { action: 'start', id: $(this).data('post')['id'] }, function() {
              M.toast({ html: 'Post is now in progress!' });
              getPosts();
            }).fail(function(req) {
              M.toast({ html: req.responseText });
            });
          }
        } else if ($(this).data('post')['status'] === 'in_progress') {
            var quantity = prompt("Please enter final weight:", $(this).data('post')['quantity']);
            if (quantity != null) {
              $.post('status.php', { action: 'confirm', id: $(this).data('post')['id'], quantity: quantity }, function() {
                M.toast({ html: 'Post is now completed!' });
                getPosts();
              }).fail(function(req) {
                M.toast({ html: req.responseText });
              });
            }
          }
      });
    });
  }).fail(function(req) {
    M.toast({ html: req.responseText });
  });

}

$(document).ready(function()
{
  console.log("collector ready");

  getUserInfo();

});
