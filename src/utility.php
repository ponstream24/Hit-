<?php

    ini_set('display_errors', "On");
    date_default_timezone_set ('Asia/Tokyo');
    /*
        src内のphpファイルを全て読み込む
    */

    // srcのパス
    $_src = pathinfo(__FILE__, PATHINFO_DIRNAME);
    // $_src = "src/";

    loadPHPFileAll($_src);
  
    /**
     * loadPHPFileAll
     * 下層含めて全てのPHP読み込み
     * @param  string $_src srcパス
     * @return void
     */
    function loadPHPFileAll($_src){

        // 読み込みの例外
        $exception = [$_src."utility.php"];

        // もし、$_srcがデレクトリである
        if( is_dir($_src) ){

            $files = glob($_src."*");

            foreach ($files as $file) {
                
                // ファイル名が .phpで終わっているか && 例外ではないか
                // if( str_ends_with($file,".php") && !in_array($file, $exception)){
                if( endsWith($file,".php") && !in_array($file, $exception)){

                    require($file);
                }

                // もしデレクトリなら
                else if( is_dir($file) ){
                    loadPHPFileAll($file."/");
                }
            }
        }
    }

    /**
     * GenerateCode
     * ランダム数字生成
     * @param  int $length 桁数
     * @param  bool $duplicates 重複の許可
     * @return string
     */
    function GenerateCode($length = 4, $duplicates = true){
        if ($duplicates) {
            $max = pow(10, $length) - 1; 
            $rand = random_int(0, $max);
            $code = sprintf('%0' . $length . 'd', $rand);
        } else {
            // かぶりなしの場合
            if ($length > 10) {
                throw new InvalidArgumentException('Length must be 10 or less for unique digits.');
            }
            $digits = range(0, 9);
            shuffle($digits);
            $code = implode('', array_slice($digits, 0, $length));
        }

        return $code;
    }
   
    /**
     * GenerateKey
     * ランダム文字生成
     * @param  int $length 文字数
     * @return string
     */
    function GenerateKey($length = 4){

        // 生成
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
    }
 
    /**
     * GenerateToken
     * token生成(CSRFトークン用)
     * @param  int $length 文字数
     * @param  bool $save $_SESSION['token']に保存するか
     * @return string
     */
    function GenerateToken($length = 16,$save = true){

        //トークンの長さ
        $TOKEN_LENGTH = $length;

        //トークンの生成
        $tokenByte = openssl_random_pseudo_bytes($TOKEN_LENGTH);
        $token = bin2hex($tokenByte);

        if( $save ){
            //トークの保存
            $_SESSION['token'] = $token;
        }

        return $token;
    }

    /**
     * encryption
     * パスワード用暗号化
     * @param  string $content 平文
     * @return string ハッシュ
     */
    function encryption($content){

        return password_hash($content, PASSWORD_DEFAULT);
    }

    /**
     * encrypt
     * ノーマル暗号化
     * @param  string $content 平文
     * @return string 暗号文
     */
    function encrypt($content){
        // 暗号化(hash化)
        return base64_encode(openssl_encrypt($content, 'AES-128-ECB', Pass_Key));
    }

    /**
     * decrypt
     * ノーマル復号化
     * @param  string $content 暗号文
     * @return string 平文
     */

    function decrypt($content){
        // 暗号化(hash化)
        return openssl_decrypt(base64_decode($content), 'AES-128-ECB', Pass_Key);
    }

    
    /**
     * startsWith
     * 7系用
     * @param  string $haystack
     * @param  string $needle
     * @return bool
     */
    function startsWith($haystack, $needle) {
        return (strpos($haystack, $needle) === 0);
    }

    /**
     * endsWith
     * 7系用
     * @param  string $haystack
     * @param  string $needle
     * @return bool
     */
    function endsWith($haystack, $needle) {
        return (strlen($haystack) > strlen($needle)) ? (substr($haystack, -strlen($needle)) == $needle) : false;
    }
   
    /**
     * json_get
     * json取得
     * @param  string $pash パス
     * @return void
     */
    function json_get($pash){
        $json = file_get_contents($pash); //指定したファイルの要素をすべて取得する
        $jsons = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'); //読み取ったJSONデータを表示するときに文字化けしないように
        $arr = json_decode($jsons, true);//json形式のデータを連想配列の形式にする
        
        return $arr;
    }
   
    /**
     * json_set
     * json保存
     * @param  string $pash パス
     * @param  array $json Array
     * @return void
     */
    function json_set($pash, $json){
        file_put_contents($pash, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
    }