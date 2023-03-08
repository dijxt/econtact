<?php

namespace App\Service;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class AuthService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function authenticateUser($nom, $num): Utilisateur
    {
        $utilisateur = $this->entityManager->getRepository(Utilisateur::class)->findOneBy([
            'nom' => $nom,
            'num' => $num,
        ]);

        if (!$utilisateur) {
            throw new CustomUserMessageAuthenticationException('Nom ou numéro invalide.');
        }

        return $utilisateur;
    }
}
