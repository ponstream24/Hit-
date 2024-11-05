<?php
    session_start();

    require("src/utility.php");

    html_header("シングルプレイ")
?>
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">シングルプレイ エントリー</h1>
            <form action="play">
                <input type="hidden" name="type" value="single">
                <div class="field">
                    <label class="label">名前</label>
                    <div class="control">
                        <input class="input" type="text" name="username" placeholder="名前を入力してください" required>
                    </div>
                </div>
                <div class="buttons is-centered">
                    <button class="button is-primary" type="submit">ゲーム開始</button>
                    <button class="button" onclick="window.location.href = './';">戻る</button>
                </div>
            </form>
        </div>
    </section>

<?=html_footer()?>