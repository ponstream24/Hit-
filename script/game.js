
let selectedNumber = "";

// 数字ボタンの処理
function addNumber(num) {
    const audio = new Audio("assets/tap.mp3");
    audio.play();

    if (selectedNumber.length < 4) {
        selectedNumber += num;
        document.getElementById("selected-number").textContent = selectedNumber;
    }
}

function deleteNumber() {
    const audio = new Audio("assets/delete.mp3");
    audio.play();

    selectedNumber = "";
    document.getElementById("selected-number").textContent = "";
}

// 送信処理
function submitNumber() {
    if (selectedNumber.length === 4) {
        const audio = new Audio("assets/submit.mp3");
        audio.play();

        // サーバーにデータ送信
        fetch('api?func=check_number&number=' + selectedNumber)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status) {
                    const hit = data.check.hit;
                    const blow = data.check.blow;
                    addLine(hit, blow);
                } else {
                    bulmaToast.toast({
                        opacity: 0.9,
                        dismissible: true,
                        message: "エラーが発生しました。再度ナンバーを送信してください[1]",
                        type: "is-warning is-info px-6 is-flex-direction-column",
                        position: "top-center",
                        duration: 3000
                    });
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                bulmaToast.toast({
                    opacity: 0.9,
                    dismissible: true,
                    message: "エラーが発生しました。再度ナンバーを送信してください[2]",
                    type: "is-warning is-info px-6 is-flex-direction-column",
                    position: "top-center",
                    duration: 3000
                });
            });

        document.getElementById("selected-number").textContent = "";
    } else {
        alert("4桁の数字を入力してください");
    }
}

function addLine(hit, blow) {
    const tbody = document.getElementById("result-table");
    const newRow = document.createElement("tr");
    tbody.appendChild(newRow);

    const cells = [];

    // 入力した数字を表示
    for (let i = 0; i < 4; i++) {
        const td = document.createElement("td");
        td.className = "has-text-centered";
        td.textContent = selectedNumber[i];
        cells.push(td);
    }

    // HitとBlowの結果を表示
    const hitTd = document.createElement("td");
    hitTd.className = "has-text-centered hit_current";
    hitTd.textContent = hit;
    cells.push(hitTd);

    const blowTd = document.createElement("td");
    blowTd.className = "has-text-centered";
    blowTd.textContent = blow;
    cells.push(blowTd);

    cells.forEach((cell, index) => {
        setTimeout(() => {
            const audio = new Audio("assets/show_number.mp3");
            audio.play();
            newRow.appendChild(cell);
        }, index * 100);
    });

    selectedNumber = ""; // 選択された数字をクリア

    if( hit == 4 ) success();
}

function success(){

    confetti({
        particleCount: 100,
        spread: 70,
        origin: { y: 0.6 },
        angle: 55
      });
    confetti({
        particleCount: 100,
        spread: 70,
        origin: { y: 0.6 },
        angle: 125
    });

    const inputArea = document.getElementById("input-area");

    inputArea.style.display = "none";
    
    const next = document.getElementById("next");

    next.style.display = "block";
    
    const audio = new Audio("assets/success.mp3");
    audio.play();

    setTimeout(() => {
        const audio = new Audio("assets/success.mp3");
        audio.play();
    }, 200);
    
    setTimeout(() => {
        const audio = new Audio("assets/success.mp3");
        audio.play();
    }, 400);
}