<?php

namespace App;

use League\Csv\Writer;
use League\Csv\Reader;

class MessageList
{
    private array $messages = [];
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $allMessages = iterator_to_array(Reader::createFromPath($this->filePath, 'r')
            ->getRecords());

        foreach ($allMessages as $newMessage) {
            $this->add(new Message(
                $newMessage[0],
                $newMessage[1]
            ));
        }
    }

    public function add(Message $message): void
    {
        $this->messages[] = $message;
    }

    public function new(Message $message): void
    {
        $writer = Writer::createFromPath($this->filePath, 'a+');
        $writer->insertOne([
            $message->nickname(),
            $message->message()
        ]);
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}