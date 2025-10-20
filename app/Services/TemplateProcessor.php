<?php

namespace App\Services;

use App\Models\MessageTemplate;

class TemplateProcessor
{
    public function process(MessageTemplate $template, array $data): string
    {
        $body = $template->body;

        foreach ($data as $key => $value) {
            $placeholder = '{' . $key . '}';
            $body = str_replace($placeholder, $value, $body);
        }

        return $body;
    }
}

