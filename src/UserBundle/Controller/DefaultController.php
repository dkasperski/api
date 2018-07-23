<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="user_index")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('user_show');
    }

    /**
     * @Route("/user/{id}", name="user_show", requirements={"id"="\d+"})
     *
     * @param int|null $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id = null)
    {
        $users = [];
        $usersArray = [];
        $userReadRepository = $this->get('user.read-repository.dbal');
        $userMapper = $this->get('user.mapper.dbal');

        if ($id !== null) {
            $user = $userReadRepository->getUser($id);
            if ($user) {
                $users[] = $user;
            }
        } else {
            $users = $userReadRepository->getAllUsers();
        }

        foreach ($users as $user) {
            $usersArray[] = $userMapper->toArray($user);
        }

        return new JsonResponse($usersArray);
    }
}
