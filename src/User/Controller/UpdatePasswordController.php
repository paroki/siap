<?php


namespace Paroki\User\Controller;


use Paroki\User\Entity\User;
use Paroki\User\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UpdatePasswordController extends AbstractController
{
    #[Route('/user/update-password', 'user_update_password', methods: ['POST'])]
    public function save(
        Request $request,
        UserInterface $user,
        UserManager $userManager,
        UserPasswordHasherInterface $hasher
    ): Response
    {
        $content = $request->getContent();
        $data = json_decode($content);
        if(!property_exists($data, 'oldPassword') || !property_exists($data,'newPassword')){
            return new JsonResponse([], 401);
        }
        $old = $data->oldPassword;
        $new = $data->newPassword;

        if($hasher->isPasswordValid($user, $old)){
            $hashed = $hasher->hashPassword($user, $new);
            $user->setPassword($hashed);
            $userManager->save($user);
            return new JsonResponse([], 200);
        }

        return new JsonResponse([
            'message' => 'Password lama anda salah'
        ], 401);
    }
}