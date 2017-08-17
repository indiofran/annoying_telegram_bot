<?php


// Add you bot's API key and name
$bot_api_key  = '379040946:AAHwPP4iV4Gt5cAWKvhPHeYJLOt9d9gZgCE';
$website = "https://api.telegram.org/bot".$bot_api_key;
$content = file_get_contents("php://input");
$update = json_decode($content, TRUE);
$message = $update["message"];
$chatId = $message["chat"]["id"];
$text = $message["text"];
$user_name = $message["from"]["first_name"];
$text = strtolower($text);

if($text == "hola") {
    $response = "Hola $user_name! ¿Ya me empezaste a romper las pelotas?";
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}
$wendy_questions=['¿Esta lloviendo afuera?', '¿Aburrida la clase?', 'Pasé por el barrio chino y me compré un spinner'];

if($text == "/wendyask") {
    $response = $wendy_questions[rand (0, count($wendy_questions))];
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}
$frases_de_homero = ['¡D\'oh!!', 'Por el alcohol, la causa y la solución de todos los problemas de la vida.', 'Tendrá todo el dinero del mundo, pero hay una cosa que nunca podrá comprar...¡¡¡UN DINOSAURIO!!!', '¡Soperutano!', 'El que ríe al último... se muere de risa', '¡Palurdo!', '¡Estúpido y sensual Flanders!','¡Anda la osa!','Compumundohipermegared'];
if($text == "/homersay") {
    $response = $frases_de_homero[rand (0, count($frases_de_homero))];
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}
if($text == "/vivis") {
    $response = "Vivito y coleando  " . $user_name;
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}
if($text == "/insulto") {
    $response = "Por ahora solo digo LA CONCHA DE TU MADRE ALLBOYS!";
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}

$matches = 0;
if(preg_match('/\/sugerir/',$text, $matches)){
    $response = str_replace("/sugerir", "", $text);
    file_get_contents($website."/sendmessage?chat_id=339839616&text=".$response);
    $response = "Que rompe Huevos!!!! Pero se lo digo a Cisco";
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}

if($user_name == "Wendy" && preg_match('/?/',$text, $matches) > 0 ){
    $response = "Let me Google that For you";
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
    $let_me_google = str_replace('?','',$text);
    $let_me_google = str_replace(" ", "+", $let_me_google);
    $response = urlencode("http://lmgtfy.com/?q=$let_me_google");
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}

if($text == "/wendylluvia"){
    $key = "e254c7639bac4a81b83204216171503";
    $city = 'Buenos%20Aires';
    $url = "http://api.apixu.com/v1/current.json?key=".$key."&q=".$city;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    $json_output=curl_exec($ch);
    curl_close($ch);
    $weather = json_decode($json_output);
    $rain = strpos($weather->current->condition->text, 'rain') !== false;
    if($rain) {
        $response = "Wendy, esta lloviendo ahora. ¿Si te lo digo en ingles entendes? " .$weather->current->condition->text;
        file_get_contents($website . "/sendmessage?chat_id=" . $chatId . "&text=" . $response);
    }else{
        $response = "Asomate boluda! por ahi en ingles lo entedes! ".$weather->current->condition->text;
        file_get_contents($website . "/sendmessage?chat_id=" . $chatId . "&text=" . $response);
    }
}

$insultos_elegantes = ['Asno', 'Badulaque', 'Baladí', 'Berzotas', 'Bodoque', 'Bolonio', 'Coprófago', 'Crápulo', 'Fenómeno', 'Champion'];
if(preg_match('/olicheck/',$text, $matches)) {
    $response = $insultos_elegantes[rand (0, count($insultos_elegantes))];
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}
$random_number= rand(0,101);
$wendy_shut_up_message = ['Che Wendy, CALLATE!', 'Wendy, Hablaste mucho', 'Wendy, sos mas molesta que yo', "Wendy, Wendy. Basta", 'Wendy, calmate un poco', 'Wendy, volvé a whatsApp', 'Wendy está bien', 'Wendy, tenes razón', 'Wendy, lixo, calha boca, argentina boluda!'];

if($user_name == "Wendy" && $random_number > 59){
    $response = $wendy_shut_up_message[rand (0, count($wendy_shut_up_message))];
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}

if($random_number > 89 ){
    $response = urlencode("#Tremendo");
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}
if($text == "github"){
    $response = "https://github.com/indiofran/annoying_telegram_bot";
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$response);
}

