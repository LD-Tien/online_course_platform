<?php

namespace App\Interfaces\Moderation;

interface ModerationRepositoryInterface
{
    public function textModeration(string $text);

    public function detectExplicitContentInVideoFileAsync($videoFile, string $webhookUri);
}