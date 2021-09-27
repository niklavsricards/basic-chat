<?php

require_once 'vendor/autoload.php';

use App\Message;
use App\MessageList;

$messageList = new MessageList('files/chat_history.csv');

if (isset($_POST['submit'])) {
    $message = new Message(
        $_POST['nickname'],
        $_POST['message']
    );

    $messageList->add($message);
    $messageList->new($message);

    header('Location: index.php');
}

$allMessages = $messageList->getMessages();


?>

<?php foreach ($allMessages as $message): ?>
    <div class="alert alert-info w-25" role="alert">
        <?php echo $message->nickname() . ': ' . $message->message(); ?>
    </div>
<?php endforeach; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous">

<h3>Chat app</h3>

<form class="w-25 ms-1" action="/" method="post">
    <div class="mb-3">
        <label for="nickname" class="form-label">Nickname: </label>
        <input type="text" class="form-control" id="nickname" name="nickname">
    </div>

    <div class="mb-3">
        <label for="message" class="form-label">Message: </label>
        <input type="text" class="form-control" id="message" name="message">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Send</button>
</form>
