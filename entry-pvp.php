<?php
    session_start();

    require("src/utility.php");

    html_header("マッチング")
?>

    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">2人用ゲームマッチング</h1>
            <form action="play">
                <input type="hidden" name="type" value="pvp">
                <div class="field">
                    <label class="label">プレイヤー名</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="名前を入力してください" required>
                    </div>
                </div>
                <div class="buttons is-centered">
                    <button class="button is-link" type="submit">マッチングを開始</button>
                    <button class="button" onclick="window.location.href = './';">戻る</button>
                </div>
            </form>
        </div>
    </section>

<?=html_footer()?>