let selectedNumber = "";

// 数字ボタンの処理
function addNumber(num) {
    if (selectedNumber.length < 4) {
        selectedNumber += num;
        document.getElementById("selected-number").textContent = selectedNumber;
    }
}

function deleteNumber() {
    selectedNumber = "";
    document.getElementById("selected-number").textContent = "";
}

// 送信処理
function submitNumber() {
    if (selectedNumber.length === 4) {

        // さーばーにデータ送信

        document.getElementById("selected-number").textContent = "";
    } else {
        alert("4桁の数字を入力してください");
    }
}

function addLine(hit, blow) {

    const tbody = document.getElementById("result-table");
    const newRow = document.createElement("tr");

    // 入力した数字を表示
    for (let i = 0; i < 4; i++) {
        const td = document.createElement("td");
        td.className = "has-text-centered";
        td.textContent = selectedNumber[i];
        newRow.appendChild(td);
    }

    // HitとBlowの結果を表示
    const hitTd = document.createElement("td");
    hitTd.className = "has-text-centered";
    hitTd.textContent = hit;
    newRow.appendChild(hitTd);

    const blowTd = document.createElement("td");
    blowTd.className = "has-text-centered";
    blowTd.textContent = blow;
    newRow.appendChild(blowTd);

    tbody.appendChild(newRow);

    selectedNumber = ""; // 選択された数字をクリア
}