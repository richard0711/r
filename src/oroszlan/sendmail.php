<?php
$post = file_get_contents('php://input');
$post = json_decode($post, true);
$from = (isset($post["e_email"])) ? $post["e_email"] : "";
$name = (isset($post["e_name"])) ? $post["e_name"] : "";
$message = (isset($post["e_message"])) ? $post["e_message"] : "";
$phone = (isset($post["e_phone"])) ? $post["e_phone"] : "";
if ($from == '') {
    echo json_encode(array("error"=>"Kérjük adja meg e-mail címét!"));
    exit;
}
if ($name == '') {
    echo json_encode(array("error"=>"Kérjük adja meg nevét!"));
    exit;
}
if ($message == '') {
    echo json_encode(array("error"=>"Nem adott meg üzenetet!"));
    exit;
}
$message .= "<br/>Üzenetet küldte: ".$name;
if ($phone) {
    $message .= "<br/>Telefonszám: ".$phone;
}
$message .= "<br/>E-mail címe: ".$from;
mail("richard.benedek@gmail.com", "Üzenet a weboldalról", $message);
echo json_encode(array("success"=>"Üzenetét megkaptuk, hamarosan válaszolunk."));

