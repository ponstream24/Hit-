<?php
    session_start();

    require("src/utility.php");

    html_header("シングルプレイ")
?>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Hit & Blow - 2人用(PvP)</h1>
            <!-- 結果表示部分 -->
            <div id="game-status" class="table-container">
                <table class="table is-bordered">
                    <thead>
                        <tr>
                            <th colspan="4" class="has-text-centered">あなたの入力した数字</th>
                            <th class="has-text-centered" style="border-left: black 1.5px solid;">Hit</th>
                            <th class="has-text-centered">Blow</th>
                        </tr>
                    </thead>
                    <tbody id="result-table">
                    </tbody>
                </table>
            </div>
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

    <script src="script/game.js"></script>

<?=html_footer()?>