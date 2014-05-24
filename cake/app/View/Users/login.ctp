<!DOCTYPE html>
<html>
  <head>
    <title>Padule</title>
    <link href='/img/favicon.ico' rel='shortcut icon'>
    <link href='/css/bootstrap.min.css' rel='stylesheet'>
    <link href='/css/bootstrap-responsive.css' rel='stylesheet'>
    <link href='/css/padule.css' rel='stylesheet'>
    <link href='/css/login.css' rel='stylesheet'>
    <meta content='スケジュール,調整' name='keywords'>
    <meta content='日程調整をパズル感覚で行おう' name='description'>
    <meta content='Padule' property='og:title'>
    <meta content='' property='og_image'>
    <meta content='' property='og:description'>
    <meta content='website' property='og:type'>
    <meta content='http://padule.me' property='og:url'>
    <meta content='Padule' property='og:site_name'>
    <meta charset='utf-8'>
    <meta content='width=device-width, minimum-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  </head>
  <body id='usersLogin'>
    <div class='navbar navbar-inverse navbar-fixed-top padule-nav'>
      <div class='container-fluid'>
        <a class='navbar-brand' href='/users/login'>
          Padule
        </a>
      </div>
    </div>
    <div class='container-fluid'>
      <form action='/users/login' class='form-signin' id='userLoginForm' method='post'>
        <p class='form-signin-heading'>
          メールアドレスとパスワードを入力してください。
        </p>
        <input autofocus='' class='form-control' id='userName' name='data[User][username]' placeholder='メールアドレス' required='' type='text'>
        <input class='form-control' id='userPassword' name='data[User][password]' placeholder='パスワード' required='' type='password'>
        <button class='btn btn-lg btn-primary btn-block' type='submit'>
          ログイン
        </button>
      </form>
    </div>
    <div class='container-fluid footer-container'>
      © 2013 Padule Inc. - Started by
      <a href='http://tokyo.startupweekend.org/'>
        Startup Weekend Tokyo
      </a>
    </div>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-45987329-1', 'padule.me');
      ga('send', 'pageview');
    </script>
  </body>
</html>
