<!DOCTYPE html>
<html>
  <head>
    <title>Padule管理ページ</title>
    <link href='../../img/favicon.ico' rel='shortcut icon'>
    <link href='../../css/bootstrap.min.css' rel='stylesheet'>
    <link href='../../css/padule.css' rel='stylesheet'>
    <meta charset='utf-8'>
    <meta content='width=device-width, minimum-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <style>
      .users-container{
        margin: 12px;
      }
      .users-table{
        padding: 12px;
        background-color: #FEFEFE;
      }
      .users-table>thead>tr{
        background-color: #EDEDED;
      }
      .count-container{
        font-size: 20px;
        margin: 12px;
      }
      .user-number{
        font-size: 60px;
        font-weight: bold;
      }
      .button-container{
        margin-top: 5px;
        margin-right: 6px;
      }
    </style>
  </head>
  <body>
    <div class='navbar navbar-inverse navbar-fixed-top padule-nav'>
      <div class='container-fluid'>
        <a class='navbar-brand' href='../users/admin'>
          Padule管理ページ
        </a>
      </div>
      <div class='button-container pull-right'>
        <a class='btn btn-default btn-sm' href='/users/logout'>
          ログアウト
        </a>
      </div>
      <div class='button-container pull-right'>
        <a class='btn btn-info btn-sm' href='/feedbacks'>
          フィードバックページ
        </a>
      </div>
    </div>
    <div class='count-container'>
      <span>登録者数</span>
      <span class='user-number'>
        <?php echo count($tmpUsers);?>
      </span>
      <span>人</span>
    </div>
    <div class='users-container'>
      <table class='table table-hover table-condensed users-table'>
        <thead>
          <th>氏名</th>
          <th>会社名</th>
          <th>メールアドレス</th>
          <th>登録日</th>
        </thead>
        <tbody>
          <?php foreach ($tmpUsers as $tmpUser):?>
            <tr>
              <td>
                <?php echo $tmpUser['TmpUser']['username'];?>
              </td>
              <td>
                <?php echo $tmpUser['TmpUser']['company'];?>
              </td>
              <td>
                <?php echo $tmpUser['TmpUser']['mail'];?>
              </td>
              <td>
                <?php echo $tmpUser['TmpUser']['created'];?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class='count-container'>
      <span>ユーザー数</span>
      <span class='user-number'>
        <?php echo count($users);?>
      </span>
      <span>人</span>
    </div>
    <div class='users-container'>
      <table class='table table-hover table-condensed users-table'>
        <thead>
          <th>アカウント</th>
          <th>暗号化したパスワード</th>
          <th>作成日</th>
        </thead>
        <tbody>
          <?php foreach ($users as $user):?>
            <tr>
              <td>
                <?php echo $user['User']['username'];?>
              </td>
              <td>
                <?php $user['User']['password'];?>
              </td>
              <td>
                <?php echo $user['User']['created'];?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
