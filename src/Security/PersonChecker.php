<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 19/07/2018
 * Time: 16:16
 */

namespace App\Security;

use App\Entity\Person as AppPerson;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class PersonChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppPerson) {
            return;
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppPerson) {
            return;
        }

        // user account is expired, the user may be notified
        if (!$user->getIsActive()) {
            throw new \Exception("Ce membre n'est pas actif");
        }
    }
}