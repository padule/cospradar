<!DOCTYPE html>
<html>
  <head>
    <title>Padule登録受付完了</title>
    <link href='/img/favicon.ico' rel='shortcut icon'>
    <link href='/css/bootstrap.min.css' rel='stylesheet'>
    <link href='/css/complete.css' rel='stylesheet'>
    <meta charset='utf-8'>
    <meta content='width=device-width, minimum-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <script src='/js/libs/jquery-2.0.3.min.js' type='text/javascript'></script>
    <script src='/js/libs/jquery.lettering-0.6.1.min.js' type='text/javascript'></script>
    <script src='/js/libs/jquery.lettering.animate.min.js' type='text/javascript'></script>
  </head>
  <body>
    <div class='navbar navbar-inverse navbar-fixed-top landing-nav' role='navigation'>
      <div class='container'>
        <div class='navbar-header'>
          <a class='navbar-brand' href='/'>
            <img class='logo' src='/img/logo.png'>
          </a>
        </div>
      </div>
    </div>
    <div class='container message-container'>
      <div class='row'>
        <div class='col-md-6'>
          <div class='messages'>
            <h2 class='title'>登録を受け付けました！</h2>
            <p class='description' id='description1'>
              この度はPaduleにご登録いただきありがとうござます。
            </p>
            <p class='description' id='description2'>
              Paduleは現在β版開発中ですので、アカウントを随時発行させていただいております。
            </p>
            <p class='description' id='description3'>
              アカウント発行後、登録メールアドレス宛に承認のメッセージをお送りいたします。
            </p>
            <p class='description' id='description4'>
              採用に関わる方々の工数を激減させるべく尽力して参りますので、どうぞよろしくお願いいたします。
            </p>
            <p class='description' id='description5'>
              ご不明な点などございましたら、運営チームまでお気軽にご連絡ください。
            </p>
          </div>
        </div>
        <div class='col-md-6'>
          <div class='image-container image-main'></div>
        </div>
      </div>
    </div>
    <div class='container info-container'>
      <h3 class='title'>最新情報をチェック！</h3>
      <div class='col-md-12'>
        <p>
          <img src='/img/icon-facebook.png'>
          <a href='http://www.facebook.com/padule.me'>
            Facebookページ『面接の日程調整ツール Padule』
          </a>
          <blockquote>
            <small>
              Paduleの最新情報が満載です！ユーザーの声や、今後の展開などについてもご紹介していきます。
            </small>
          </blockquote>
        </p>
        <p>
          <img src='/img/icon-feed.png'>
          <a href='http://blog.padule.me'>
            公式ブログ『残業するほどヒマじゃない。Padule』
          </a>
          <blockquote>
            <small>
              Paduleを使う多忙なビジネスマン向けの情報を発信しています。Paduleが誕生したStartupWeekendの情報も要チェックです。
            </small>
          </blockquote>
        </p>
        <p>
          <i class='glyphicon glyphicon-user'></i>
          <a href='padule@outlook.com'>
            &nbsp;お問合せ先メールアドレス
          </a>
          <blockquote>
            <small>
              ご質問・ご要望、何でもお待ちしております！どんな小さなことでもフィードバックしていただけると嬉しいです。お気軽にご連絡ください。
            </small>
          </blockquote>
        </p>
      </div>
    </div>
    <div class='container footer-container'>
      <div class='pull-right'>
        © 2013 Padule Inc. - Started by
        <a href='http://tokyo.startupweekend.org/'>
          Startup Weekend Tokyo
        </a>
      </div>
    </div>
    <script>
      var lettering = function(el, callback) {
        $(el).show().lettering().animateLetters({opacity:0},{opacity:1},{randomOrder:false,time:150}, callback);
      };
      (function() {
        lettering("#description1", function(){
          lettering("#description2", function(){
            lettering("#description3", function(){
              lettering("#description4", function(){
                lettering("#description5");
              });
            });
          });
        });
      })();
    </script>
  </body>
</html>
