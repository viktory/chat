<?php
/**
 * Chat.php
 *
 * @project chat
 * @since 11.07.2015
 * @author Viktory Lysenko <lysenkoviktory@gmail.com>
 * @copyright Copyright (c) 2015, Viktory Lysenko
 */


namespace App;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        $session = (new SessionManager(App::getInstance()))->driver();
        $cookies = $conn->WebSocket->request->getCookies();
        $laravelCookie = urldecode($cookies[Config::get('session.cookie')]);
        $idSession = Crypt::decrypt($laravelCookie);
        $session->setId($idSession);
        $session->start();
        $userId = $session->get(Auth::getName());

        $conn->userId = $userId;
        echo "New connection! ({$conn->resourceId}), $userId\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $msg = json_decode($msg);

        echo sprintf('User %d sending message "%s" to user %d' . "\n"
            , $from->userId, $msg->message, $msg->userTo);

        $dialog = new Dialog();
        $dialog->from = $from->userId;
        $dialog->to = $msg->userTo;
        if ($dialog->validate()) {
            if (($existedDialog = Dialog::byUsers($dialog->from, $dialog->to)->first()) === null) {
                $dialog->save();
                $existedDialog = $dialog;
            }
            $message = new Message();
            $message->from = $from->userId;
            $message->dialog_id = $existedDialog->id;
            $message->text = $msg->message;

            if ($message->validate()) {
                $message->save();
                foreach ($this->clients as $client) {
                    if (($client->userId == $from->userId) || ($client->userId == $msg->userTo)) {
                        $client->send(view('chat._message', ['messages' => [$message]]));
                    }
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}