<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;


class ContactsController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $id_nom = $request->getSession()->get('id_nom');

        $repository = $this->entityManager->getRepository(Contact::class);
        $numContacts = $repository->findBy([
            'id_nom' => $id_nom
        ]);

        $contacts = [];

        foreach ($numContacts as $contact) {
            $contacts[] = $this->entityManager->getRepository(Utilisateur::class)->find($contact->id_contact);
        }

        return $this->render('contacts.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}
