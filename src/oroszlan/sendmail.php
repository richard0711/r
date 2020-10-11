<?php
$post = file_get_contents('php://input');
$post = json_decode($post, true);
$from = (isset($post["e_email"])) ? $post["e_email"] : "";
$message = (isset($post["e_message"])) ? $post["e_message"] : "";
$phone = (isset($post["e_phone"])) ? $post["e_phone"] : "";
if ($from == '') {
    echo json_encode(array("error"=>"Kérjük adja meg e-mail címét!"));
    exit;
}
if ($message == '') {
    echo json_encode(array("error"=>"Nem adott meg üzenetet!"));
    exit;
}
$message .= "<br/>Üzenetet küldte: ";
if ($phone) {
    $message .= "<br/>Telefonszám: ".$phone;
}
$message .= "<br/>E-mail címe: ".$from;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <orogytarweboldal@gmail.com>' . "\r\n";
mail("richard.benedek@gmail.com", "Üzenet a weboldalról", $message, $headers);
echo json_encode(array("success"=>"Üzenetét megkaptuk, hamarosan válaszolunk."));

