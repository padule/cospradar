<!DOCTYPE html>
<html>
  <head>
    <title>Padule</title>
    <link href='../../img/favicon.ico' rel='shortcut icon'>
    <link href='../../css/bootstrap.min.css' rel='stylesheet'>
    <link href='../../css/datepicker.css' rel='stylesheet'>
    <link href='../../css/padule.css' rel='stylesheet'>
    <link href='../../css/schedule.css' rel='stylesheet'>
    <meta content='スケジュール,調整' name='keywords'>
    <meta content='スケジュール,調整' name='description'>
    <meta content='Padule' property='og:title'>
    <meta content='' property='og_image'>
    <meta content='' property='og:description'>
    <meta content='website' property='og:type'>
    <meta content='http://padule.me' property='og:url'>
    <meta content='Padule' property='og:site_name'>
    <meta charset='utf-8'>
    <meta content='width=device-width, minimum-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  </head>
  <body>
    <div class='navbar navbar-inverse navbar-fixed-top padule-nav'>
      <div class='container-fluid'>
        <a class='navbar-brand' href='/users/mypage'>
          Padule
        </a>
        <div class='info-area pull-left'>
          <span class='label'></span>
        </div>
        <ul class='nav navbar-nav pull-right' id='userInfo' data-userid='<?php echo $userId; ?>'>
        <li class='dropdown'>
          <a class='pull-right' data-toggle='dropdown' href='#'>
            <i class='glyphicon glyphicon-user'></i>
            <span id='userName'></span>
            <b class='caret'></b>
          </a>
          <ul class='dropdown-menu'>
            <li>
              <a href='#' id='logout'>
                <i class='glyphicon glyphicon-off'></i>
                ログアウト
              </a>
            </li>
          </ul>
        </li>
        </ul>
        <div class='feedback-container pull-right'>
          <a class='btn btn-default btn-sm' href='/feedbacks'>
            <i class='glyphicon glyphicon-edit'></i>
            フィードバックはこちらから！
          </a>
        </div>
      </div>
    </div>
    <div class='schedule-container container-fluid'>
      <div class='row-fluid'>
        <div id='eventSidebar'>
          <div class='add-container' id='addEventButtonContainer'>
            <button class='add-event-btn btn btn-primary'>
              スケジュール追加
            </button>
          </div>
          <div class='sidebar-container'>
            <ul class='nav' id='eventList'></ul>
          </div>
        </div>
        <div id='scheduleContents'>
          <div class='control-container'></div>
          <div class='schedule-table-container'>
            <div class='no-event'>
              <span>
                <i class='glyphicon glyphicon-info-sign'></i>
                Paduleへようこそ！
              </span>
              <span>
                スケジュールを作成するか、作成したスケジュールを選択してください。
              </span>
            </div>
          </div>
          <div class='button-container'>
            <a class='btn btn-lg btn-success disabled' id='confirmButton' onclick="ga('send', 'event', 'schedule', 'confirm', 'confirmEvent', 1);" type='button'>
              編集した日時を確定
            </a>
          </div>
        </div>
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
    <script src='../../js/libs/bootstrap-datepicker.js'></script>
    <script src='../../js/libs/bootstrap-timepicker.min.js'></script>
    <script src='../../js/libs/json2.js'></script>
    <script src='../../js/libs/dateformat.js'></script>
    <script src='../../js/libs/underscore.js'></script>
    <script src='../../js/libs/backbone.js'></script>
    <script src='../../js/libs/backbone.localStorage.js'></script>
    <script src='../../js/application.js'></script>
    <script src='../../js/padule.js'></script>
    <script src='../../js/libs/jquery.mockjax.js'></script>
    <!-- template -->
    <script src='../../js/templates/templates.js'></script>
    <!-- model -->
    <script src='../../js/models/event.js'></script>
    <script src='../../js/models/schedule.js'></script>
    <script src='../../js/models/seeker.js'></script>
    <script src='../../js/models/seeker_schedule.js'></script>
    <script src='../../js/models/user.js'></script>
    <!-- collection -->
    <script src='../../js/collections/events.js'></script>
    <script src='../../js/collections/schedules.js'></script>
    <script src='../../js/collections/seeker_schedules.js'></script>
    <!-- view -->
    <script src='../../js/views/schedule/alert_modal.js'></script>
    <script src='../../js/views/schedule/event.js'></script>
    <script src='../../js/views/schedule/event_list.js'></script>
    <script src='../../js/views/schedule/event_list_element.js'></script>
    <script src='../../js/views/schedule/info_area.js'></script>
    <script src='../../js/views/schedule/schedule.js'></script>
    <script src='../../js/views/schedule/schedule_control.js'></script>
    <script src='../../js/views/schedule/schedule_table.js'></script>
    <script src='../../js/views/schedule/schedule_tbody.js'></script>
    <script src='../../js/views/schedule/schedule_tbody_th.js'></script>
    <script src='../../js/views/schedule/schedule_tbody_tr.js'></script>
    <script src='../../js/views/schedule/schedule_td.js'></script>
    <script src='../../js/views/schedule/schedule_tfoot.js'></script>
    <script src='../../js/views/schedule/schedule_tfoot_tr.js'></script>
    <script src='../../js/views/schedule/schedule_tfoot_td.js'></script>
    <script src='../../js/views/schedule/schedule_thead.js'></script>
    <script src='../../js/views/schedule/schedule_thead_th.js'></script>
    <script src='../../js/views/schedule/schedule_thead_tr.js'></script>
    <script src='../../js/views/schedule/user_info.js'></script>
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
