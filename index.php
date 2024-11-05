<?php
    session_start();

    require("src/utility.php");

    html_header("Welcome")
?>

<body id="index_page">
    <!-- Heroセクション -->
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title">Hit & Blow</h1>
                <h2 class="subtitle">数字を当てる推理ゲーム！</h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <div class="box">
                <p><strong>ルール:</strong> コンピュータがランダムに選んだ4桁の数字を当てましょう！</p>
                <ul>
                    <li>数字と桁の両方が合っている場合は「Hit」とカウント。</li>
                    <li>数字は合っているが桁が違う場合は「Blow」とカウント。</li>
                </ul>
                <p>全ての桁を正しく当てると勝利です！</p>
                <button class="button is-success is-fullwidth" id="startGameBtn">ゲームを開始する</button>
            </div>
        </div>
    </section>

    <div class="modal" id="gameModeModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">プレイモードを選択</p>
                <button class="delete" aria-label="close" id="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <div class="buttons">
                    <a href="entry-single" class="button is-primary is-fullwidth">1人プレイ</a>
                    <a href="entry-pvp" class="button is-link is-fullwidth">オンライン対戦</a>
                </div>
            </section>
        </div>
    </div>

    <script>
        // モーダル開閉の処理
        const startGameBtn = document.getElementById('startGameBtn');
        const gameModeModal = document.getElementById('gameModeModal');
        const closeModal = document.getElementById('closeModal');

        // モーダルを表示
        startGameBtn.addEventListener('click', () => {
            gameModeModal.classList.add('is-active');
        });

        // モーダルを閉じる
        closeModal.addEventListener('click', () => {
            gameModeModal.classList.remove('is-active');
        });

        // 背景クリックでもモーダルを閉じる
        document.querySelector('.modal-background').addEventListener('click', () => {
            gameModeModal.classList.remove('is-active');
        });
    </script>

<?=html_footer()?>