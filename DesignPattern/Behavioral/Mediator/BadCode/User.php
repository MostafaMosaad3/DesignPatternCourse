<?php

// ============================================
// BAD CODE: WITHOUT MEDIATOR PATTERN
// ============================================

/**
 * PROBLEMS:
 * ❌ Users know about each other (tight coupling)
 * ❌ Each user manages list of other users
 * ❌ Hard to add new features
 * ❌ N×N connections (spaghetti code)
 */

namespace DesignPattern\Mediator\BadCode;

// ============================================
// USER CLASS (Knows about other users)
// ============================================


class User
{
    public $name ;
    public $messages = [] ;
    private $contacts = [] ;

    public function __construct(string $name)
    {
        $this->name = $name;
    }


    /**
     * ❌ BAD: Must manually add each contact
     */
    public function addContact(User $user) :void
    {
        $this->contacts[] = $user;
    }


    public function receive(string $message , User $user) :void
    {
        $this->messages[] = [
            'from' => $user,
            'message' => $message
        ];
    }


    /**
     * ❌ BAD: User directly sends to another user
     * ❌ Tight coupling!
     */
    public function sendToUser(string $message , User $recipient) :void
    {
        $recipient->receive($message , $this) ;
    }

    /**
     * ❌ BAD: Must loop through all contacts to broadcast
     * ❌ User handles distribution logic
     */
    public function setToAll(string $message) : void
    {
        foreach ($this->contacts as $contact) {
            $contact->receive($message , $this);
        }
    }

}


/**
 * ============================================
 * PROBLEMS WITH THIS CODE:
 * ============================================
 *
 * 1. TIGHT COUPLING:
 *    ❌ Everyone knows everyone!
 *
 * 2. MANUAL CONNECTIONS:
 *    ❌ Must call addContact() for each pair
 *    ❌ 3 users = 6 addContact() calls
 *    ❌ 10 users = 90 addContact() calls!
 *
 * 3. HARD TO ADD NEW USER:
 *    ❌ Must call addContact() on Alice, Bob, Charlie
 *    ❌ David must add Alice, Bob, Charlie
 *    ❌ 6 more addContact() calls!
 *
 * 4. HARD TO ADD FEATURES:
 *    ❌ Want to mute user? Every user needs mute logic
 *    ❌ Want to block user? Every user needs block list
 *    ❌ Want message history? Every user stores it
 *
 * 5. DISTRIBUTION LOGIC IN USERS:
 *    ❌ User shouldn't manage message routing
 *    ❌ sendToAll() logic repeated in each user
 *
 **/
