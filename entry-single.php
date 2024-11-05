<?php
session_start();

require("src/utility.php");

html_header("シングルプレイ")
?>
<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">シングルプレイ エントリー</h1>
        <form action="play" method="POST">
            <input type="hidden" name="type" value="single">
            <div class="field">
                <label class="label">名前</label>
                <div class="control">
                    <input class="input" type="text" name="username" placeholder="名前を入力してください" required>
                </div>
            </div>

            <div class="field">
                <label class="label">同じ数字の使用</label>
                <div class="control">
                    <label class="radio">
                        <input type="radio" onclick="changeHelp(true);" name="number_generation" value="with_duplicates" checked required>
                        あり
                    </label>
                    <label class="radio">
                        <input type="radio" onclick="changeHelp(false);" name="number_generation" value="without_duplicates" required>
                        なし
                    </label>
                </div>
                <p id="help">例: 1251, 1111, 3566</p>
            </div>

            <div class="buttons is-centered">
                <button class="button is-primary" type="submit">ゲーム開始</button>
                <button class="button" type="button" onclick="window.location.href = './';">戻る</button>
            </div>
        </form>
    </div>
</section>

<script>
    function changeHelp(status){
        
        const help = document.getElementById("help");

        if( status ){
            help.innerHTML = "例: <b>1</b>25<b>1</b>, <b>1111</b>, 35<b>66</b>";
        }
        else{
            help.innerHTML = "例: 1234, 2571, 3691";
        }
    }
</script>

<?=html_footer()?>
