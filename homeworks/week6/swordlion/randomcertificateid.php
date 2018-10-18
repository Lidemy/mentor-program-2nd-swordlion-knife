<?php
function randtext() {
    $password_len = 32;    //字串長度
    $password = '';
    $word = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';   //亂數內容
    $len = strlen($word);
    for ($i = 0; $i < 32; $i++) {
        $password .= $word[rand() % $len];
    }
    return $password;
}
?>

