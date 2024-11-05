<?php
    session_start();

    require("src/utility.php");

    if( 
        !isset($_SESSION["check_count"]) ||
        !isset($_SESSION["number"]) ||
        !isset($_SESSION["result"]) ||
        !isset($_SESSION["username"]) ||
        !isset($_SESSION["result_hit"]) ||
        !isset($_SESSION["result_blow"])
    ){
        $err = array();
        $err["message"] = "不明なセッション";
        $err["des"] = "有効なゲーム結果を取得できませんでした。";
        $_SESSION["temp_error"] = $err;
        
        unset($_SESSION["check_count"]);
        unset($_SESSION["number"]);
        unset($_SESSION["username"]);
        unset($_SESSION["result_hit"]);
        unset($_SESSION["result_blow"]);
        unset($_SESSION["result"]);

        header("Location: ./");
        exit();
    }

    $correct = $_SESSION["number"];
    $result_hit = $_SESSION["result_hit"];
    $result_blow = $_SESSION["result_blow"];
    $count = $_SESSION["check_count"];

    if( $count <= 2 ){
        $message = "豪運です！実力ではないのでもう一度やり直してください。";
    }
    else if( $count <= 3 ){
        $message = "パーフェクト！".$_SESSION["username"]."の実力は本物です！";
    }
    else if( $count <= 5 ){
        $message = $_SESSION["username"]."。本気ですか？";
    }

    else{
        $message = "ノーコメント。";
    }
    
    if( $_SESSION["result"] == "success" ){
        $result_title = "正解しました！";
    }
    else{
        $result_title = "中断しました....";
        $message = "・・・・・。";
    }

    unset($_SESSION["check_count"]);
    unset($_SESSION["number"]);
    unset($_SESSION["username"]);
    unset($_SESSION["result_hit"]);
    unset($_SESSION["result_blow"]);
    unset($_SESSION["result"]);

    html_header("結果")
?>
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">ゲーム結果</h1>
            <div class="box has-text-centered" id="chat">
            </div>
            <div class="buttons is-centered" id="show">
                <button type="button" class="button is-primary" onclick="show();">結果を表示</button>
            </div>
            <div class="buttons is-centered" id="onemore" style="display:none;">
                <a href="./" class="button is-primary">もう一度プレイ</a>
            </div>
        </div>
    </section>

    <script>

        // 文字列を順番に表示
        function displayText(text, interval = 100, id = "chat") {
            return new Promise((resolve) => {
                const target = document.getElementById(id);
                const outputElement = document.createElement("p");
                outputElement.style.minHeight = "1em";
                target.appendChild(outputElement);

                let index = 0;

                // 一文字表示
                function addCharacter() {
                    if (index < text.length) {
                        
                        if( text[index] != " " ){
                            const audio = new Audio("assets/char.mp3");
                            audio.play();
                        }
                        outputElement.textContent += text[index];
                        index++;
                        setTimeout(addCharacter, interval);
                    } else {
                        resolve();
                    }
                }

                // 一文字表示
                addCharacter();
            });
        }

        // もう一度を表示
        function showOnemore() {
            document.getElementById("onemore").style.display = "flex";
        }

        // メッセージを表示
        async function showMessages() {
            await displayText("結果は... <?=$result_title?>");
            await displayText("正解 : <?=$correct?>");
            await displayText("");
            await displayText("回答回数 : <?=$count?>回");
            await displayText("Hit合計 : <?=$result_hit?>回");
            await displayText("Blow合計 : <?=$result_blow?>回");
            await displayText(" ");
            await displayText("担当者から一言 : <?=$message?>");
            await displayText("");

            showOnemore();
        }

        // 表示
        function show(){
            document.getElementById("show").style.display = "none";

            // メッセージを表示
            showMessages();
        }
    </script>

<?=html_footer()?>