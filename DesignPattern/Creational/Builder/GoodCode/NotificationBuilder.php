<?php

/**
 * ============================================
 * COMPONENT 3: CONCRETE BUILDER
 * ============================================
 * Implements the builder interface and
 * constructs the product step by step
 */
namespace GoodCode;

use Mockery\Matcher\Not;

class NotificationBuilder implements NotificationBuilderInterface
{

    private Notification $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }
    public function setTitle(string $title): self
    {
        $this->notification->setTitle($title);
        return $this;
    }

    public function setSender(string $name, ?string $avatar = null): self
    {
        $this->notification->setSender($name, $avatar);
        return $this;
    }

    public function setTimestamp(\DateTime $timestamp): self
    {
        $this->notification->setTimestamp($timestamp);
        return $this;
    }

    public function setPriority(string $priority): self
    {
        $this->notification->setPriority($priority);
        return $this;
    }

    public function addAttachment(string $type, string $url, string $name): self
    {
        $this->notification->addAttachment($type, $url, $name);
        return $this;
    }

    public function addAction(string $label, string $action): self
    {
        $this->notification->addAction($label, $action);
        return $this;
    }

    public function setIcon(string $icon): self
    {
        $this->notification->setIcon($icon);
        return $this;
    }

    public function setSound(string $sound): self
    {
        $this->notification->setSound($sound);
        return $this;
    }

    public function setVibrate(bool $vibrate): self
    {
        $this->notification->setVibrate($vibrate);
        return $this;
    }

    public function build(): Notification
    {
        return $this->notification;
    }
}
