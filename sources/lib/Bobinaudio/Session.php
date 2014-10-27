<?php

namespace Bobinaudio;

use Symfony\Component\HttpFoundation\Session\Session as SfSession;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use PommProject\Foundation\Session\Session as PommSession;

class Session extends SfSession
{
    protected $session;
    protected $admin;

    public function __construct(SessionStorageInterface $storage = null, AttributeBagInterface $attributes = null, FlashBagInterface $flashes = null, PommSession $session)
    {
        parent::__construct($storage, $attributes, $flashes);
        $this->session = $session;
    }

    public function isLogged()
    {
        return (bool) !is_null($this->admin);
    }

    public function logIn($login, $password)
    {
        $this->admin = $this->session
            ->getModel('\Bobinaudio\TransfoSchema\AdminModel')
            ->login($login, $password);

        if ($this->isLogged())
        {
            $this->admin['last_logon'] = new DateTime();
            $this->session
                ->getModel('\Bobinaudio\TransfoSchema\AdminModel')
                ->updateOne($this->admin, ['last_logon']);
        }

        return $this;
    }

    public function logOut()
    {
        $this->admin = null;

        return $this;
    }
}
