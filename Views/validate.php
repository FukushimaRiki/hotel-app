<script>
  // ログイン時のバリデーション
  function login_val() {
    $("button[type='submit']").on("click",function(){
      var result = 0;
      var email = $("input[name='email']").val().trim();
      var password = $("input[name='password']").val().trim();
      // 空欄チェック
      if(email == ""||password == "") {
        result++;
      }
      //メールの型指定
      if(!(email.match(/^([\w\-._])+@([\w\-._])+\.([a-zA-Z]+)+$/))){
        result++;
      }
      //パスワード　4文字以上チェック
     if(password.length < 4){
       result++;
     }
     //もしエラーが一つでもあったらcontactに送信先を変更する。
     if(result >= 1){
         $("form").attr("action","#");
     }
    })
  }

  // メールアドレス入力時のバリデーション
  function email_val() {
    $("button[type='submit']").on("click",function(){
      var result = 0;
      var email = $("input[name='email']").val().trim();
      // 空欄チェック
      if(email == "") {
        result++;
      }
      //メールの型指定
      if(!(email.match(/^([\w\-._])+@([\w\-._])+\.([a-zA-Z]+)+$/))){
        result++;
      }

     //もしエラーが一つでもあったらcontactに送信先を変更する。
     if(result >= 1){
         $("form").attr("action","#");
     }
    })
  }

  // パスワード入力時のバリデーション
  function password_val() {
    $("button[type='submit']").on("click",function(){
      var result = 0;
      var password = $("input[name='password']").val().trim();
      var password_re = $("input[name='password_re']").val().trim();
      // 空欄チェック
      if(password == ""||password_re == "") {
        result++;
      }
      //パスワードの文字（英語・数字）チェック
      if((!(password.match(/^[0-9a-zA-Z]+$/)))||(!(password_re.match(/^[0-9a-zA-Z]+$/))))　{
        result++;
      }
      //パスワードの4文字以上10文字以下チェック
      if((password.length < 4)||(password.length > 10)||(password_re.length < 4)||(password_re.length > 10)){
        result++;
      }
      // パスワードと再入力パスワードが同一であるかのチャック
      if(!(password == password_re)) {
        result++;
      }
     //もしエラーが一つでもあったらcontactに送信先を変更する。
     if(result >= 1){
         $("form").attr("action","#");
     }else{
       if (confirm('このパスワードに変更してもよろしいでしょうか？')) { //予約をキャンセルするかの確認用ポップアップ
         $('form').attr('href','password-reset_complete.php');
       }
     }

    })
  }

  // ユーザ情報登録の入力時のバリデーション
  function user_insert_val() {
    $("button[type='submit']").on("click",function(){
      var result = 0;
      var last_name = $("input[name='last_name']").val().trim();
      var first_name = $("input[name='first_name']").val().trim();
      var last_name_kana = $("input[name='last_name_kana']").val().trim();
      var first_name_kana = $("input[name='first_name_kana']").val().trim();
      var email = $("input[name='email']").val().trim();
      var password = $("input[name='password']").val().trim();
      var password_re = $("input[name='password_re']").val().trim();
      var tel = $("input[name='tel']").val().trim();
      var postcode = $("input[name='postcode']").val().trim();
      var prefecture_id = $("select[name='prefecture_id']").val().trim();
      var city = $("input[name='city']").val().trim();
      var block = $("input[name='block']").val().trim();
      var building = $("input[name='building']").val().trim();

      // 空欄チェック
      if(last_name == ""||first_name == ""||last_name_kana == ""||first_name_kana == ""||email == ""||password == ""||password_re == ""||tel == ""||postcode == ""||prefecture_id == ""||city == ""||block == "") {
        result++;
      }
      // 名前の１０文字以下チェック
      if((last_name.length > 10)||(first_name.length > 10)) {
        result++;
      }
      // フリガナの２０文字以下チェック
      if((last_name_kana.length > 20)||(first_name_kana.length > 20)) {
          result++;
        }
      //メールの型指定
      if(!(email.match(/^([\w\-._])+@([\w\-._])+\.([a-zA-Z]+)+$/))) {
        result++;
      }
      //パスワードの文字（英語・数字）チェック
      if((!(password.match(/^[0-9a-zA-Z]+$/)))||(!(password_re.match(/^[0-9a-zA-Z]+$/))))　{
        result++;
      }
      //パスワードの4文字以上10文字以下チェック
      if((password.length < 4)||(password.length > 10)||(password_re.length < 4)||(password_re.length > 10)){
        result++;
      }
      // パスワードと再入力パスワードが同一であるかのチャック
      if(!(password == password_re)) {
        result++;
      }
      // 電話番号の数字チェック
      if(!(tel.match(/^[0-9]+$/))) {
        result++;
      }
      // 郵便番号の数字チェック
      if(!(postcode.match(/^[0-9]+$/))) {
        result++;
      }
      // 郵便番号の７桁チェック
      if(postcode.length != 7) {
          result++;
      }
      // 住所の５０文字以下チェック
      if((city.length > 50)||(block.length > 50)||(building.length > 50)) {
         result++;
      }

     //もしエラーが一つでもあったらcontactに送信先を変更する。
     if(result >= 1){
         $("form").attr("action","#");
     }else{
       if (confirm('この内容で変更してよろしいでしょうか？')) { //予約をキャンセルするかの確認用ポップアップ
         $("form").attr("action","registration_complete.php");
       }
     }

    })
  }


  // ユーザ情報更新の入力時のバリデーション
  function user_update_val() {
    $("button[type='submit']").on("click",function(){
      var result = 0;
      var last_name = $("input[name='last_name']").val().trim();
      var first_name = $("input[name='first_name']").val().trim();
      var last_name_kana = $("input[name='last_name_kana']").val().trim();
      var first_name_kana = $("input[name='first_name_kana']").val().trim();
      var email = $("input[name='email']").val().trim();
      var password = $("input[name='password']").val().trim();
      var password_re = $("input[name='password_re']").val().trim();
      var tel = $("input[name='tel']").val().trim();
      var postcode = $("input[name='postcode']").val().trim();
      var prefecture_id = $("select[name='prefecture_id']").val().trim();
      var city = $("input[name='city']").val().trim();
      var block = $("input[name='block']").val().trim();
      var building = $("input[name='building']").val().trim();

      // 空欄チェック
      if(last_name == ""||first_name == ""||last_name_kana == ""||first_name_kana == ""||email == ""||password == ""||password_re == ""||tel == ""||postcode == ""||prefecture_id == ""||city == ""||block == "") {
        result++;
      }
      // 名前の１０文字以下チェック
      if((last_name.length > 10)||(first_name.length > 10)) {
        result++;
      }
      // フリガナの２０文字以下チェック
      if((last_name_kana.length > 20)||(first_name_kana.length > 20)) {
          result++;
        }
      //メールの型指定
      if(!(email.match(/^([\w\-._])+@([\w\-._])+\.([a-zA-Z]+)+$/))) {
        result++;
      }
      //パスワードの文字（英語・数字）チェック
      if((!(password.match(/^[0-9a-zA-Z]+$/)))||(!(password_re.match(/^[0-9a-zA-Z]+$/))))　{
        result++;
      }
      //パスワードの4文字以上10文字以下チェック
      if((password.length < 4)||(password.length > 10)||(password_re.length < 4)||(password_re.length > 10)){
        result++;
      }
      // パスワードと再入力パスワードが同一であるかのチャック
      if(!(password == password_re)) {
        result++;
      }
      // 電話番号の数字チェック
      if(!(tel.match(/^[0-9]+$/))) {
        result++;
      }
      // 郵便番号の数字チェック
      if(!(postcode.match(/^[0-9]+$/))) {
        result++;
      }
      // 郵便番号の７桁チェック
      if(postcode.length != 7) {
          result++;
      }
      // 住所の５０文字以下チェック
      if((city.length > 50)||(block.length > 50)||(building.length > 50)) {
         result++;
      }

     //もしエラーが一つでもあったらcontactに送信先を変更する。
     if(result >= 1){
         $("form").attr("action","#");
     }else{
       if (confirm('この内容で変更してよろしいでしょうか？')) { //予約をキャンセルするかの確認用ポップアップ
         $('form').attr('action','user-edit_complete.php');
       }
     }
    })
  }

  // 空室検索時のバリデーション
  function room_search_val() {
    $("button[type='submit']").on("click",function(){
      var result = 0;
      var start_date = $("input[name='start_date']").val().trim();
      var number_of_people = $("select[name='number_of_people']").val().trim();
      // 空欄チェック
      if(start_date == ""||number_of_people == "") {
        result++;
      }

     //もしエラーが一つでもあったらcontactに送信先を変更する。
     if(result >= 1){
         $("form").attr("action","#");
     }
    })
  }

</script>
