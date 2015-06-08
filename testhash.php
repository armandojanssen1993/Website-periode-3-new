<?php
////
////$option = [
////    'cost' => 14,
////];
////
////$option2 = [
////    'cost' => 14,
////];
////
////echo password_hash("kaas", PASSWORD_BCRYPT, $option)."<br />";
////
////echo password_hash("kaas", PASSWORD_BCRYPT)."\n";
//
//
//$postwaarde = $_POST['password'];
//
//
//$option = [
//
//    'cost' => 12,
//];
//
//$hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $option);
//


$option = [

    'cost' => 12,
];

$password = password_hash($_POST['pass1'], PASSWORD_BCRYPT, $option);


if (password_verify($password, $hash)){
    echo 'password ok';
}else{
    echo 'goudvis';
}
