<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./b_stylesheet.css">
  <link rel="shortcut icon" href="photos/ICON.png">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="./script.js"></script>
  <title>大崎上島｜コミュニティーサイト</title>
</head>

<body>
  <main>
    <!-- 募集 -->
    <div class="recruitment-page" id="1">
      ver 3.1より導入予定
    </div>
    <!-- 募集終わり -->
    <!-- 掲示板 -->
    <div class="bulletin-board-page">
    <?php
      // DBログイン情報
      define('DB_HOST', 'localhost');
      define('DB_USER', 'root');
      define('DB_PASS', '');
      define('DB_NAME', 'board');
      // タイムゾーン設定
      date_default_timezone_set('Asia/Tokyo');
      // 変数初期化
      $current_date = null;
      $message = array();
      $message_array = array();
      $error_message = array();
      $pdo = null;
      $stmt = null;
      $res = null;
      $option = null;
      session_start();
      // データベース接続
      try {
        $option = array(
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
        );
        $pdo = new PDO('mysql:charset=UTF8;dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS, $option);
        // 接続時のエラー内容取得
      } catch (PDOException $e) {
        $error_message[] = $e->getMessage();
      }
      // 空白除去
      if (!empty($_POST['btn_submit'])) {
        $view_name = preg_replace('/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $_POST['view_name']);
        $message = preg_replace('/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $_POST['message']);
        // 表示名入力確認
        if (empty($view_name)) {
          $error_message[] = '表示名を入力してください。';
        } else {
          // 表示名保存
          $_SESSION['view_name'] = $view_name;
        }
        // メッセージ入力確認
        if (empty($message)) {
          $error_message[] = 'ひと言メッセージを入力してください。';
        } else {
          if (100 < mb_strlen($message, 'UTF-8')) {
            // 文字数確認
            $error_message[] = 'ひと言メッセージは100文字以内で入力してください。';
          }
        }
        if (empty($error_message)) {
          // 書き込み日時取得
          $current_date = date("Y-m-d H:i:s");
          // トランザクション開始
          $pdo->beginTransaction();
          // SQL作成
          try {
            $stmt = $pdo->prepare("INSERT INTO message (view_name, message, post_date) VALUES ( :view_name, :message, :current_date)");
            // 値の代入
            $stmt->bindParam(':view_name', $view_name, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->bindParam(':current_date', $current_date, PDO::PARAM_STR);
            // SQLクエリ実行
            $res = $stmt->execute();
            // コミット
            $res = $pdo->commit();
            // エラー時ロールバック
          } catch (Exception $e) {
            $pdo->rollBack();
          }
          if ($res) {
            $_SESSION['success_message'] = 'メッセージを書き込みました。';
          } else {
            $error_message[] = '書き込みに失敗しました。';
          }
          // プリペアドステートメント削除
          $stmt = null;
          header('Location: ./bulletin.php');
          exit;
        }
      }
      // メッセージデータ取得
      if (empty($error_message)) {
        $sql = "SELECT view_name,message,post_date FROM message ORDER BY post_date DESC";
        $message_array = $pdo->query($sql);
      }
      // DB接続解除
      $pdo = null;
      ?>
      <?php if (!empty($error_message)) : ?>
        <ul class="error_message">
          <?php foreach ($error_message as $value) : ?>
            <li><i class="fas fa-exclamation-circle"></i><?php echo $value ?></li>
          <?php endforeach ?>
        </ul>
      <?php endif; ?>
      <?php if (empty($_POST['btn_submit']) && !empty($_SESSION['success_message'])) : ?>
        <p class="success_message"><?php echo htmlspecialchars($_SESSION['success_message'], ENT_QUOTES, 'UTF-8'); ?></p>
        <?php unset($_SESSION['success_message']); ?>
      <?php endif; ?>
      <form method="post">
        <div>
          <label for="view_name">表示名</label>
          <input id="view_name" type="text" name="view_name" value="<?php if (!empty($_SESSION['view_name'])) {echo htmlspecialchars($_SESSION['view_name'], ENT_QUOTES, 'UTF-8');} ?>">
        </div>
        <div>
          <label for="message">ひとことメッセージ</label>
          <textarea name="message" id="message"><?php if (!empty($message)) {echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8');} ?></textarea>
        </div>
        <input type="submit" name="btn_submit" value="書き込む" id="submit_data">
      </form>
      <section>
        <?php if (!empty($message_array)) : ?>
          <?php foreach ($message_array as $value) : ?>
            <article>
              <div class="info">
                <h2><?php echo htmlspecialchars($value['view_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
              </div>
              <p><?php $final_message = nl2br(htmlspecialchars($value['message'], ENT_QUOTES, 'UTF-8'));
                $final_message = preg_replace('/(FUCK|Fuck|FUck|FUCk|FuCk|FuCK|FucK|fuck|クソ|くそ|糞|クそ|くソ|バカ|馬鹿|バか|ばカ|アホ|あホ|アほ|あほ|阿呆|shit|SHIT|Shit|SHit|SHIt|sHit|sHIt|sHIT|shIt|shIT|shiT|死ね|テロ)/u', '**', $final_message);
                echo $final_message
              ?></p>
            </article>
          <?php endforeach; ?>
        <?php endif; ?>
      </section>
    </div>
    <!-- 掲示板終わり -->
    <!-- チャット -->
    <div class="chat-page">
      ver 3.2より導入予定
    </div>
    <!-- チャット終わり -->
    <!-- 活動報告 -->
    <div class="activity-report-page">
      
    </div>
    <!-- 活動報告 -->
    <!-- お知らせ -->
    <div class="notifications-page">

    </div>
    <!-- お知らせ終わり -->
  </main>
  <!-- Jquery画面遷移終わり -->
</body>

</html>


<!-- 開発メモ -->
<!-- ・画面遷移について→それぞれの機能自体は別ファイルで作成し、iframeで読みこむ。これにより、headerの画面遷移を行うことができる。iframeはdisplayで管理する。 -->