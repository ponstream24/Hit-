<?php

/**
 * setNumber
 * ランダム数字をセット
 * @param  mixed $duplicates 重複の許可
 * @return void
 */
function setNumber($duplicates = true){

    $_SESSION["number"] = GenerateCode(4, $duplicates);
    $_SESSION["check_count"] = 0;
    $_SESSION["result_hit"] = 0;
    $_SESSION["result_blow"] = 0;
}

/**
 * getNumber
 * セッションの数字を返す
 * @return int
 */
function getNumber(){

    return $_SESSION["number"];
}

/**
 * checkNumber
 * $numberのhit数,blow数を返す
 * @param  mixed $number 確認したい数字
 * @return array
 */
function checkNumber($number) {

    $res = array();
    $res["hit"] = 0;
    $res["blow"] = 0;

    
    if( isset($_SESSION["number"]) ){

        $correct = str_split($_SESSION["number"]);
        $guess = str_split($number);

        // Hitチェック
        for ($i = 0; $i < count($guess); $i++) {
            if ($guess[$i] === $correct[$i]) {
                $res["hit"]++;
                $correct[$i] = null;
                $guess[$i] = null;
            }
        }

        // Blowチェック
        foreach ($guess as $i => $g) {
            if ($g !== null && in_array($g, $correct)) {
                $res["blow"]++;
                $index = array_search($g, $correct);
                $correct[$index] = null;
            }
        }

        $_SESSION["result_hit"] += $res["hit"];
        $_SESSION["result_blow"] += $res["blow"];

        $_SESSION["check_count"]++;
    }

    return $res;
}


?>