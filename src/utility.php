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

    // 下層含めて全てのPHP読み込み
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

    // ランダム数字生成
    function GenerateCode($length = 4){
        $max = pow(10, $length) - 1;                    // コードの最大値算出
        $rand = random_int(0, $max);                    // 乱数生成
        $code = sprintf('%0'. $length. 'd', $rand);     // 乱数の頭0埋め

        return $code;
    }

    // ランダム文字生成
    function GenerateKey($length = 4){

        // 生成
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
    }

    // token生成
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
     * パスワード用暗号化
     */
    function encryption($content){

        return password_hash($content, PASSWORD_DEFAULT);
    }

    /**
     * ノーマル暗号化
     */
    function encrypt($content){
        // 暗号化(hash化)
        return base64_encode(openssl_encrypt($content, 'AES-128-ECB', Pass_Key));
    }

    /**
     * ノーマル復号化
     */
    function decrypt($content){
        // 暗号化(hash化)
        return openssl_decrypt(base64_decode($content), 'AES-128-ECB', Pass_Key);
    }


    function startsWith($haystack, $needle) {
        return (strpos($haystack, $needle) === 0);
    }

    function endsWith($haystack, $needle) {
        return (strlen($haystack) > strlen($needle)) ? (substr($haystack, -strlen($needle)) == $needle) : false;
    }

    // json取得
    function json_get($pash){
        $json = file_get_contents($pash); //指定したファイルの要素をすべて取得する
        $jsons = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'); //読み取ったJSONデータを表示するときに文字化けしないように
        $users = json_decode($jsons, true);//json形式のデータを連想配列の形式にする
        
        return $users;
    }

    // json保存
    function json_set($pash, $json){
        file_put_contents($pash, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
    }