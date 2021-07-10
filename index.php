<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./stylesheet.css">
  <link rel="shortcut icon" href="photos/ICON.png">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="./script.js"></script>
  <title>大崎上島｜コミュニティーサイト</title>
</head>

<body>
  <!-- ヘッダー -->
  <header>
    <h1><ruby>
        <rb>大崎上島</rb>
        <rt>Osaki Kamijima</rt>
      </ruby><br>
      <span>COMMUNITY SITE</span><br>
      <h2>version 0.0.0</h2>
    </h1>
  </header>
  <!-- ヘッダー終わり -->
  <div class="content-cover">
    <div class="content">
      <ul>
        <li class="recruitment contents"><i class="fas fa-users"></i>募集</li>
        <li class="bulletin-board contents"><i class="fas fa-clipboard-list"></i>掲示板</li>
        <li class="chat contents"><i class="fas fa-comments"></i>チャット</li>
          <li class="activity-report contents"><i class="fas fa-address-card"></i>活動報告</li>
        <li class="notifications contents"><i class="fas fa-bell"></i>お知らせ</li>
      </ul>
    </div>
  </div>
  <main>
    <!-- 募集 -->
      <iframe src="./recruitment.php" frameborder="0" class="recruitment-page"></iframe>
    <!-- 募集終わり -->
    <!-- 掲示板 -->
      <iframe src="./bulletin.php" frameborder="0" class="bulletin-board-page"></iframe>
    <!-- 掲示板終わり -->
    <!-- チャット -->
      <iframe src="./chat.php" frameborder="0" class="chat-page"></iframe>
    <!-- チャット終わり -->
    <!-- 活動報告 -->
      <iframe src="./activity.php" frameborder="0" class="activity-report-page"></iframe>
    <!-- 活動報告 -->
    <!-- お知らせ -->
      <iframe src="./notifications.php" frameborder="0" class="notifications-page"></iframe>
    <!-- お知らせ終わり -->
  </main>
  <!-- Jquery画面遷移終わり -->
  <div class="introduction">
    <h3>
      Welcome to the new style of community.
    </h3>
    <p>
      このコミュニティーサイトは有限会社シスコム・広島叡智学園中学校チームてれこみによって作成されました。
    </p>
    <table>
      <tr>
        <th>2021年1月</th>
        <td>インターンシップにてコミュニティーサイトの発案</td>
      </tr>
      <tr>
        <th>2021年3月</th>
        <td>プロジェクトデイにて原案の発表</td>
      </tr>
      <tr>
        <th>2021年6月</th>
        <td>ミーティングの後コミュニティーサイト作成開始</td>
      </tr>
      <tr>
        <th>2021年9月</th>
        <td>コミュニティーサイトver 0.0.1(内部デモ)完成</td>
      </tr>
      <tr>
        <th>2021年9月</th>
        <td>コミュニティーサイトver 1.0.2(叡智学園内)デモ配信</td>
      </tr>
      <tr>
        <th>2021年9月</th>
        <td>コミュニティーサイトver 2.0.3(島内学校)配信</td>
      </tr>
      <tr>
        <th>2021年9月</th>
        <td>コミュニティーサイトver 3.0.4(島内)配信</td>
      </tr>
    </table>
  </div>
  <footer>
    ©︎2021, TELECOMI
  </footer>
</body>

</html>