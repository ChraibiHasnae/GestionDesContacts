<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Contacts;
class ContactController extends AbstractController {
   

    /**
     * @Route("/contact/{id}")
     */
    public function viewAction($id) {
        $contact = $this->getDoctrine()->getRepository(Contacts::class);
        $contact = $contact->find($id);
        if (!$contact) {
            throw $this->createNotFoundException(
                'Aucun contact pour l\'id: ' . $id
            );
        }
        return $this->render(
            'contacts/view.html.twig',
            array('contact' => $contact)
        );
    }
    /**
     * @Route("/contacts/all")
     */
    public function showAction() {
        $contacts = $this->getDoctrine()->getRepository(Contacts::class);
        $contacts = $contacts->findAll();
        return $this->render(
            'contacts/list.html.twig',
            array('contacts' => $contacts)
        );
    }
    /**
     * @Route("/delete/{id}" , name="contact_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $id = $em->merge($id);
        //$contact = $this->getDoctrine()->getRepository(Contacts::class);
        $contact = $contact->find($id);
        if (!$contact) {
            throw $this->createNotFoundException(
                'There are no contacts with the following id: ' . $id
            );
        }
        $em->remove($contact);
        $em->flush();
        return $this->redirect($this->generateUrl('contacts_all'));
    }
    /**
     * @Route("/edit/{id}" , name="contact_edit")
     */
    public function updateAction(Request $request, $id) {
        $contact = $this->getDoctrine()->getRepository(Contacts::class);
        $contact = $contact->find($id);
        if (!$contact) {
            throw $this->createNotFoundException(
                'There are no contacts with the following id: ' . $id
            );
        }
        $form = $this->createFormBuilder($article)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Editer'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $contact = $form->getData();
            $em->flush();
            return $this->redirect($this->generateUrl('contacts_all'));
        }
        return $this->render(
            'contacts/edit.html.twig',
            array('form' => $form->createView())
        );
    }
}