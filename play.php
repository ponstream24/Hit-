<?php
    session_start();

    require("src/utility.php");

    $err = array();

    if( 
        isset( $_POST ) &&
        isset( $_POST["type"] )
    ){
        // シングル戦
        if( $_POST["type"] == "single" ){

            $duplicates = true;

            if( isset($_POST["number_generation"]) ){
                
                $duplicates = $_POST["number_generation"] != "without_duplicates";
            }
            unset($_SESSION["check_count"]);
            unset($_SESSION["number"]);
            unset($_SESSION["result_hit"]);
            unset($_SESSION["result_blow"]);
            unset($_SESSION["result"]);
            
            setNumber($duplicates);
        }

        // オンライン戦
        else{

            // if( isset($_POST["roomid"]) ){
            // }

            // 非公開サーバーのため、ここは強制タイムアウト
            $err["message"] = "Timeout : マッチングサーバーとの接続ができませんでした。";
            $err["des"] = "再度接続を試すか、時間を空けてお試しください。<br>ご迷惑をおかけし大変申し訳ございません。";
        }
    }
    else{
        $err["message"] = "不明なセッション";
        $err["des"] = "再度接続を試すか、時間を空けてお試しください。<br>ご迷惑をおかけし大変申し訳ございません。";
    }

    $username = $_POST["username"] ?? "ゲスト";

    $_SESSION["username"] = $username;

    // エラーあり
    if( !empty($err) ){
        $_SESSION["temp_error"] = $err;
        header("Location: ./");
        exit();
    }

    $_SESSION["result"] = "playnow";

    html_header("シングルプレイ");
?>
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Hit & Blow</h1>
            <h3 class="subtitle has-text-centered"><?=$username?></h3>
        
            <!-- 結果表示部分 -->
            <div id="game-status" class="table-container">
                <table class="table is-bordered">
                    <thead>
                        <tr>
                            <th colspan="4" class="has-text-centered">あなたの入力した数字</th>
                            <th class="has-text-centered hit_current">Hit</th>
                            <th class="has-text-centered">Blow</th>
                        </tr>
                    </thead>
                    <tbody id="result-table">
                    </tbody>
                </table>
            </div>
            <h5 class="has-text-centered" onclick="if(confirm('あきらめますか？')) window.location.href = 'result'">あきらめる</h5>
        </div>
    </section>

    <!-- 入力エリア -->
    <div id="input-area">
        <p class="has-text-centered"><span id="selected-number"></span></p>
        <p id="player-prompt" class="has-text-centered">数字を予想してください</p>
        <div class="number-buttons">
            <button class="button is-link" onclick="addNumber(1)">1</button>
            <button class="button is-link" onclick="addNumber(2)">2</button>
            <button class="button is-link" onclick="addNumber(3)">3</button>
            <button class="button is-link" onclick="addNumber(4)">4</button>
            <button class="button is-link" onclick="addNumber(5)">5</button>
            <button class="button is-link" onclick="addNumber(6)">6</button>
            <button class="button is-link" onclick="addNumber(7)">7</button>
            <button class="button is-link" onclick="addNumber(8)">8</button>
            <button class="button is-link" onclick="addNumber(9)">9</button>
            <button class="button is-link" onclick="addNumber(0)">0</button>
        </div>
        <div class="has-text-centered">
            <button class="button is-danger" onclick="deleteNumber()">削除</button>
            <button class="button is-success" onclick="submitNumber()">送信</button>
        </div>
    </div>

    <section class="section" id="next" style="display: none;">
        <div class="container">
            <div class="buttons is-centered">
                <form action="result">
                    <button class="button is-primary" type="submit">次へ</button>
                </form>
            </div>
        </div>
    </section>

    <script src="script/game.js"></script>

<?=html_footer()?>