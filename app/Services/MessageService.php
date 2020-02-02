<?php

namespace App\Services;

class MessageService {

    const WARNING_MESSAGE = 'is-warning';
    const ERROR_MESSAGE = 'is-danger';
    const INFO_MESSAGE = 'is-info';
    const SUCCESS_MESSAGE = 'is-success';

    public function getMessageHTML(string $text, string $type)
    {
        return view('message.message')
            ->with('typeClass', $type)
            ->with('text', $text);
    }

    public function warningMessage(string $text)
    {
        return self::getMessageHTML($text, self::WARNING_MESSAGE);
    }

    public function errorMessage(string $text)
    {
        return self::getMessageHTML($text, self::ERROR_MESSAGE);
    }

    public function infoMessage(string $text)
    {
        return self::getMessageHTML($text, self::INFO_MESSAGE);
    }

    public function successMessage(string $text)
    {
        return self::getMessageHTML($text, self::SUCCESS_MESSAGE);
    }
}
