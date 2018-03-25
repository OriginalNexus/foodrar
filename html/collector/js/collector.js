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
    }
  });
}

$(document).ready(function()
{
  console.log("collector ready");

  getUserInfo();

  $(".customContainer").click(function()
  {
    console.log("vezi tu"); // Cand e unprocessed, alert pentru are you sure si...prompt maps direct cand e in process
  });
});
