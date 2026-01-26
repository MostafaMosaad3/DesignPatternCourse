<?php

namespace GoodCode;

/**
 * ============================================
 * COMPONENT 1: PRODUCT
 * ============================================
 * The complex object being constructed
 */

class Notification
{
    private string $message;
    private ?string $title = null;
    private ?string $senderName = null;
    private ?string $senderAvatar = null;
    private ?\DateTime $timestamp = null;
    private string $priority = 'normal';
    private array $attachments = [];
    private array $actions = [];
    private ?string $icon = null;
    private ?string $sound = null;
    private bool $vibrate = false;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setSender(string $name, ?string $avatar = null): void
    {
        $this->senderName = $name;
        $this->senderAvatar = $avatar;
    }

    public function setTimestamp(\DateTime $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function setPriority(string $priority): void
    {
        $this->priority = $priority;
    }

    public function addAttachment(string $type, string $url, string $name): void
    {
        $this->attachments[] = [
            'type' => $type,
            'url' => $url,
            'name' => $name
        ];
    }

    public function addAction(string $label, string $action): void
    {
        $this->actions[] = [
            'label' => $label,
            'action' => $action
        ];
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function setSound(string $sound): void
    {
        $this->sound = $sound;
    }

    public function setVibrate(bool $vibrate): void
    {
        $this->vibrate = $vibrate;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }

}
