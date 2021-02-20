<!-- Optional JavaScript -->
<!-- jQuery first, Popper.js, Bootstrap JSの順番に読み込む -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- localhostの場合の接続 -->
<!-- jQuery読み込み JSよりも先 -->
<!-- <script src="js/jquery-3.5.1.min.js"></script> -->
<!-- popper.js js読み込み -->
<!-- <script src="js/proper.min.js"></script> -->
<!-- popper.js js読み込み -->
<!-- <script src="js/bootstrap.min.js"></script> -->

<!-- 住所検索用 -->
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>


<!-- バリデートの読み込み -->
<?php require("../Views/validate.php"); ?>

<script>
  $(function(){
    user_insert_val();
    referrer();
    prefecture_search();
    prefecture_id();
  })

  //リファラー
  function referrer(){
    var ref = document.referrer;
    var result = ref.match(/[login.php]/);
    if(!result){
      location.href = "login.php";
    }
  }

</script>

<?php
require_once(ROOT_PATH.'/Controllers/UsersController.php');
$users = new UsersController();
$user = $users->view();
$message = $users->val($user);
 ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSSの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- localhostの場合の接続 -->
    <!-- CSS読み込み -->
    <!-- <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"> -->

    <link rel="stylesheet" href="css/style/index.css">
    <link rel="stylesheet" href="css/style/logoff_bg.css">

    <title>新規登録ページ</title>
  </head>
  <body>


    <div class="shadow-lg p-5 m-5 bg-white rounded">
      <h1>新規会員登録</h1>

      <form class="m-5" action="" method="post">
        <table id="user-input_table" class="table table-bordered table-hover">
          <!-- 氏名 -->
          <tr>
            <th>氏名<span class="p-2 text-danger">必須</span></th>
            <td>
              <input type="text" name="last_name" value="<?php if($_POST){echo $user['last_name'];} ?>" placeholder="苗字" autofocus>
              <input type="text" name="first_name" value="<?php if($_POST){echo $user['first_name'];} ?>" placeholder="名前" class="ml-3">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['name'])){echo "<div class='text-danger pt-1'>".$message['name']."</div>";} ?></span>
            </td>
          </tr>
          <!-- フリガナ -->
          <tr>
            <th>氏名(フリガナ)<span class="p-2 text-danger">必須</span></th>
            <td>
              <input type="text" name="last_name_kana" value="<?php if($_POST){echo $user['last_name_kana'];} ?>" placeholder="苗字(フリガナ)">
              <input type="text" name="first_name_kana" value="<?php if($_POST){echo $user['first_name_kana'];} ?>" placeholder="名前(フリガナ)" class="ml-3">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['kana'])){echo "<div class='text-danger pt-1'>".$message['kana']."</div>";} ?></span>
            </td>
          </tr>
          <!-- メール -->
          <tr>
            <th>Eメールアドレス(ユーザ名)<span class="p-2 text-danger">必須</span></th>
            <td>
              <input type="text" name="email" value="<?php if($_POST){echo $user['email'];} ?>" placeholder="メールアドレス">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['email'])){echo "<div class='text-danger pt-1'>".$message['email']."</div>";} ?></span>
            </td>
          </tr>
          <!-- パスワード -->
          <tr>
            <th>パスワード<span class="p-2 text-danger">必須</span></th>
            <td>
              <input type="text" name="password" placeholder="パスワード">
              <br>
              <input type="text" name="password_re" class="mt-2 mr-1" placeholder="パスワード(再入力)">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['password'])){echo "<div class='text-danger pt-1'>".$message['password']."</div>";} ?></span>
            </td>
          </tr>
          <!-- 電話番号 -->
          <tr>
            <th>電話番号<span class="p-2 text-danger">必須</span></th>
            <td>
              <input type="text" name="tel" value="<?php if($_POST){echo $user['tel'];} ?>" placeholder="電話番号(ハイフンなし)">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['tel'])){echo "<div class='text-danger pt-1'>".$message['tel']."</div>";} ?></span>
            </td>
          </tr>
          <!-- 郵便番号 -->
          <tr>
            <th>郵便番号<span class="p-2 text-danger">必須</span></th>
            <td>
              <input type="text" name="postcode" value="<?php if($_POST){echo $user['postcode'];} ?>" placeholder="郵便番号(ハイフンなし)">
              <button type="button" class="ajaxzip3" href="#">住所検索</button>
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['postcode'])){echo "<div class='text-danger pt-1'>".$message['postcode']."</div>";} ?></span>
            </td>
          </tr>
          <!-- 都道府県 -->
          <tr>
            <th>都道府県名<span class="p-2 text-danger">必須</span></th>
            <td>
              <select id="prefecture_id" name="prefecture_id">
                <option value="" selected>都道府県</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                <option value="岩手県">岩手県</option>
                <option value="宮城県">宮城県</option>
                <option value="秋田県">秋田県</option>
                <option value="山形県">山形県</option>
                <option value="福島県">福島県</option>
                <option value="茨城県">茨城県</option>
                <option value="栃木県">栃木県</option>
                <option value="群馬県">群馬県</option>
                <option value="埼玉県">埼玉県</option>
                <option value="千葉県">千葉県</option>
                <option value="東京都">東京都</option>
                <option value="神奈川県">神奈川県</option>
                <option value="新潟県">新潟県</option>
                <option value="富山県">富山県</option>
                <option value="石川県">石川県</option>
                <option value="福井県">福井県</option>
                <option value="山梨県">山梨県</option>
                <option value="長野県">長野県</option>
                <option value="岐阜県">岐阜県</option>
                <option value="静岡県">静岡県</option>
                <option value="愛知県">愛知県</option>
                <option value="三重県">三重県</option>
                <option value="滋賀県">滋賀県</option>
                <option value="京都府">京都府</option>
                <option value="大阪府">大阪府</option>
                <option value="兵庫県">兵庫県</option>
                <option value="奈良県">奈良県</option>
                <option value="和歌山県">和歌山県</option>
                <option value="鳥取県">鳥取県</option>
                <option value="島根県">島根県</option>
                <option value="岡山県">岡山県</option>
                <option value="広島県">広島県</option>
                <option value="山口県">山口県</option>
                <option value="徳島県">徳島県</option>
                <option value="香川県">香川県</option>
                <option value="愛媛県">愛媛県</option>
                <option value="高知県">高知県</option>
                <option value="福岡県">福岡県</option>
                <option value="佐賀県">佐賀県</option>
                <option value="長崎県">長崎県</option>
                <option value="熊本県">熊本県</option>
                <option value="大分県">大分県</option>
                <option value="宮崎県">宮崎県</option>
                <option value="鹿児島県">鹿児島県</option>
                <option value="沖縄県">沖縄県</option>
              </select>
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['prefecture_id'])){echo "<div class='text-danger pt-1'>".$message['prefecture_id']."</div>";} ?></span>
            </td>
          </tr>
          <!-- 市区町村 -->
          <tr>
            <th>住所1(市区町村)<span class="p-2 text-danger">必須</span></th>
            <td>
              <input type="text" name="city" value="<?php if($_POST){echo $user['city'];} ?>" placeholder="市区町村">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['city'])){echo "<div class='text-danger pt-1'>".$message['city']."</div>";} ?></span>
            </td>
          </tr>
          <!-- 番地 -->
          <tr>
            <th>住所2(番地)<span class="p-2 text-danger">必須</span></th>
            <td>
              <input type="text" name="block" value="<?php if($_POST){echo $user['block'];} ?>" placeholder="番地">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['block'])){echo "<div class='text-danger pt-1'>".$message['block']."</div>";} ?></span>
            </td>
          </tr>
          <!-- 建物名 -->
          <tr>
            <th class="pr-5">住所3(建物名)<span class="p-2"></span></th>
            <td>
              <input type="text" name="building" value="<?php if($_POST){echo $user['building'];} ?>" placeholder="建物名">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['building'])){echo "<div class='text-danger pt-1'>".$message['building']."</div>";} ?></span>
            </td>
          </tr>

        </table>
        <button class="btn btn-primary btn-block" type="submit">確認</button>
      </form>

    </div>

      <script>
        //都道府県検索
        function prefecture_search() {
          $('.ajaxzip3').on('click', function(){
            AjaxZip3.zip2addr('postcode','','prefecture_id','city');

            //成功時に実行する処理
            AjaxZip3.onSuccess = function() {
              $('.addr3').focus();
            };

            //失敗時に実行する処理
            AjaxZip3.onFailure = function() {
              alert('郵便番号に該当する住所が見つかりません');
            };

            return false;
          });
        }

        // 都道府県選択
        function prefecture_id() {
          $('#prefecture_id').val('<?php if($_POST){echo $user['prefecture_id'];} ?>');
        }
      </script>

  </body>
</html>
