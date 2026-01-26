<?php

namespace GoodCode;

/**
 * ============================================
 * COMPONENT 4: DIRECTOR
 * ============================================
 * Orchestrates the builder to create
 * common configurations
 */

class NotificationDirector
{
    private NotificationBuilderInterface $builder;

    public function __construct(NotificationBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function setBuilder(NotificationBuilderInterface $builder): void
    {
        $this->builder = $builder;
    }

    /**
     * Build a simple text notification
     */
    public function buildSimpleNotification(): Notification
    {
        return $this->builder
            ->setTimestamp(new \DateTime())
            ->build();
    }

    /**
     * Build a message notification
     */
    public function buildMessageNotification(string $senderName, ?string $avatar = null): Notification
    {
        return $this->builder
            ->setTitle("New Message")
            ->setSender($senderName, $avatar)
            ->setTimestamp(new \DateTime())
            ->setIcon("💬")
            ->setSound("message.mp3")
            ->addAction("Reply", "reply")
            ->addAction("Mark as Read", "mark_read")
            ->build();
    }

    /**
     * Build an urgent notification
     */
    public function buildUrgentNotification(string $title): Notification
    {
        return $this->builder
            ->setTitle($title)
            ->setPriority("urgent")
            ->setTimestamp(new \DateTime())
            ->setIcon("🚨")
            ->setSound("urgent.mp3")
            ->setVibrate(true)
            ->build();
    }

    /**
     * Build an email notification
     */
    public function buildEmailNotification(string $sender, bool $hasAttachment = false): Notification
    {
        $notification = $this->builder
            ->setTitle("New Email")
            ->setSender($sender, "avatar.png")
            ->setTimestamp(new \DateTime())
            ->setIcon("📧")
            ->setSound("email.mp3")
            ->addAction("Open", "open_email")
            ->addAction("Delete", "delete_email");

        if ($hasAttachment) {
            $notification->addAttachment("pdf", "document.pdf", "attachment.pdf");
        }

        return $notification->build();
    }
}

/* ============================================
* KEY BENEFITS
* ============================================
 *
 * 1. PRODUCT: Complex object with many options
* 2. BUILDER INTERFACE: Contract for all builders
* 3. CONCRETE BUILDER: Step-by-step construction
* 4. DIRECTOR: Pre-configured common builds
*
 * ✅ Fluent and readable
* ✅ Only set what you need
* ✅ Reusable construction logic (Director)
* ✅ Easy to add new builder types
*
 * ============================================
 */
