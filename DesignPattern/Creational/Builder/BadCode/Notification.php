<?php

/**
 * ============================================
 * BAD CODE: WITHOUT BUILDER PATTERN
 * ============================================
 *
 * PROBLEMS:
 * 1. Constructor with too many parameters
 * 2. Hard to remember parameter order
 * 3. Must pass null for optional parameters
 * 4. Not flexible for future changes
 * 5. Hard to read and maintain
 *
 * ============================================
 */


class Notification
{
    private string $message;
    private ?string $title;
    private ?string $senderName;
    private ?string $senderAvatar;
    private ?\DateTime $timestamp;
    private string $priority;
    private array $attachments;
    private array $actions;
    private ?string $icon;
    private ?string $sound;
    private bool $vibrate;

    /**
     * Constructor Hell - Too many parameters!
     */
    public function __construct(
        string $message,
        ?string $title = null,
        ?string $senderName = null,
        ?string $senderAvatar = null,
        ?\DateTime $timestamp = null,
        string $priority = 'normal',
        array $attachments = [],
        array $actions = [],
        ?string $icon = null,
        ?string $sound = null,
        bool $vibrate = false
    ) {
        $this->message = $message;
        $this->title = $title;
        $this->senderName = $senderName;
        $this->senderAvatar = $senderAvatar;
        $this->timestamp = $timestamp;
        $this->priority = $priority;
        $this->attachments = $attachments;
        $this->actions = $actions;
        $this->icon = $icon;
        $this->sound = $sound;
        $this->vibrate = $vibrate;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
