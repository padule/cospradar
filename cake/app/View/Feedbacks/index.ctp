<!DOCTYPE html>
<html>
  <head>
    <title>Paduleフィードバック</title>
    <link href='../../img/favicon.ico' rel='shortcut icon'>
    <link href='../../css/bootstrap.min.css' rel='stylesheet'>
    <link href='../../css/padule.css' rel='stylesheet'>
    <link href='../../css/feedback.css' rel='stylesheet'>
    <meta charset='utf-8'>
    <meta content='width=device-width, minimum-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  </head>
  <body id='feedbackIndex'>
    <div class='navbar navbar-inverse navbar-fixed-top padule-nav'>
      <div class='container-fluid'>
        <a class='navbar-brand' href='/users/mypage'>
          Paduleに戻る
        </a>
        <ul class='nav navbar-nav pull-right' id='userInfo'>
          <li class='dropdown'>
            <a class='pull-right' data-toggle='dropdown' href='#'>
              <i class='glyphicon glyphicon-user'></i>
              <span id='userName' data-userid='<?php echo $user["id"]; ?>' data-isadmin='<?php echo $isAdmin; ?>'>
                <?php echo $user['username'];?>
              </span>
              <b class='caret'></b>
            </a>
            <ul class='dropdown-menu'>
              <li>
                <a href='/users/logout' id='logout'>
                  <i class='glyphicon glyphicon-off'></i>
                  ログアウト
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div class='info-container container-fluid'>
      <div class='row'>
        <div class='col-md-4 count-container'>
          <span class='feedback-number'>
            <?php echo count($feedbacks);?>
          </span>
          <span>件のフィードバック</span>
        </div>
        <div class='col-md-8'>
          <p>Paduleをご利用いただきありがとうございます！</p>
          <p>Paduleは鋭意改善中ですので、フィードバックをいただけばすぐに対応します！</p>
          <p>どんな小さなことでも大歓迎です！</p>
        </div>
      </div>
    </div>
    <div class='feedback-container container-fluid'>
      <div class='row-fluid'>
        <table class='table table-hover table-condensed table-bordered' id='feedbackTable'>
          <thead>
            <tr>
              <th></th>
              <?php if ($user["company_id"] == 9999): ?>
                <th>報告者</th>
              <?php endif; ?>
              <th>コメント</th>
              <th></th>
              <th>登録日</th>
              <th>対応状況</th>
              <th>運営コメント</th>
              <?php if ($user["company_id"] == 9999): ?>
                <th></th>
              <?php endif; ?>
            </tr>
            <tr class='new-feedback'>
              <td class='center feedback_kb'>
                <select class='form-control' id='feedbackKb'>
                  <option value='1'>アイデア</option>
                  <option value='2'>いいね！</option>
                  <option value='3'>質問</option>
                  <option value='4'>バグ</option>
                </select>
              </td>
              <?php if ($user["company_id"] == 9999): ?>
                <td></td>
              <?php endif; ?>
              <td>
                <textarea class='form-control' id='feedbackContent' placeholder='要望や質問を記入し、送信ボタンを押してください' rows='3'></textarea>
              </td>
              <td class='center btn-container'>
                <button class='btn btn-primary disabled' id='btnSendFeedback' type='button'>
                  送信
                </button>
              </td>
              <td class='center'></td>
              <td class='center'></td>
              <td></td>
              <?php if ($user["company_id"] == 9999): ?>
                <td></td>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <div class='modal fade' id='alertModal'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button aria-hidden='modal-body' class='close' data-dismiss='modal' type='button'>
              &times;
            </button>
            <i class='glyphicon glyphicon-question-sign'></i>
            <span class='modal-title'></span>
          </div>
          <div class='modal-body'></div>
          <div class='modal-footer'>
            <button class='btn btn-success' id='alertOK' type='button'>
              はい
            </button>
            <button class='btn btn-default' data-dismiss='modal' type='button'>
              いいえ
            </button>
          </div>
        </div>
      </div>
    </div>
    <script>
      if (window.padule == null) window.padule = { Models: {}, Collections: {}, Views: {},Routers: {} };
    </script>
    <script src='../../js/libs/jquery-2.0.3.min.js'></script>
    <script src='../../js/libs/bootstrap.min.js'></script>
    <script src='../../js/libs/json2.js'></script>
    <script src='../../js/libs/dateformat.js'></script>
    <script src='../../js/libs/underscore.js'></script>
    <script src='../../js/libs/backbone.js'></script>
    <script src='../../js/application.js'></script>
    <script src='../../js/padule.js'></script>
    <!-- template -->
    <script src='../../js/templates/templates.js'></script>
    <!-- model -->
    <script src='../../js/models/feedback.js'></script>
    <!-- collection -->
    <script src='../../js/collections/feedbacks.js'></script>
    <!-- view -->
    <script src='../../js/views/schedule/alert_modal.js'></script>
    <script src='../../js/views/feedback/feedback_list_element.js'></script>
    <script src='../../js/views/feedback/feedback_index.js'></script>
    <!-- router -->
    <script src='../../js/routers/schedules_router.js'></script>
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
