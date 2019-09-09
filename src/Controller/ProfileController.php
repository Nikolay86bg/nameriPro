<?php

namespace App\Controller;

use App\Doctrine\ORM\Tools\Pagination\Paginator;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("", name="profile", methods="GET")
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $paginator = (new Paginator($userRepository->getListQuery('name')))->paginate($request->get('page', 1));

        return $this->render('profile/index.html.twig', [
            'paginator' => $paginator,
        ]);
    }

//    /**
//     * @Route("/new", name="industry_new", methods="GET|POST")
//     *
//     * @param Request                $request
//     * @param EntityManagerInterface $entityManager
//     *
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
//     */
//    public function new(Request $request, EntityManagerInterface $entityManager, TranslatorInterface $translator)
//    {
////        $this->denyAccessUnlessGranted(DummyVoter::INDUSTRY);
//
//        $industry = new Industry();
//        $form = $this->createForm(IndustryType::class, $industry);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->persist($industry);
//            $entityManager->flush();
//
//            $this->addFlash('success', $translator->trans('general.flashes.saved'));
//
//            return $this->redirectToRoute('industry_show', ['id' => $industry->getId()]);
//        }
//
//        return $this->render('industry/new.html.twig', [
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="profile_show", methods="GET")
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
//        $this->denyAccessUnlessGranted(DummyVoter::INDUSTRY);

        return $this->render('profile/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="profile_edit", methods="GET|POST")
     *
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function edit(User $user, Request $request, EntityManagerInterface $entityManager, TranslatorInterface $translator)
    {
//        $this->denyAccessUnlessGranted(DummyVoter::INDUSTRY);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', $translator->trans('general.flashes.saved'));

            return $this->redirectToRoute('profile_show', ['id' => $user->getId()]);
        }

        return $this->render('profile/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
