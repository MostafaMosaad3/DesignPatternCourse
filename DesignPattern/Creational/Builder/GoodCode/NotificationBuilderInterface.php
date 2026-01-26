<?php

namespace GoodCode;

/**
 * ============================================
 * COMPONENT 2: BUILDER INTERFACE
 * ============================================
 * Defines all possible building steps
 */

interface NotificationBuilderInterface
{
    public function setTitle(string $title): self;
    public function setSender(string $name, ?string $avatar = null): self;
    public function setTimestamp(\DateTime $timestamp): self;
    public function setPriority(string $priority): self;
    public function addAttachment(string $type, string $url, string $name): self;
    public function addAction(string $label, string $action): self;
    public function setIcon(string $icon): self;
    public function setSound(string $sound): self;
    public function setVibrate(bool $vibrate): self;
    public function build(): Notification;
}
