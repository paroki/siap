<?php


namespace Paroki\User\Controller;


use Paroki\User\Entity\User;
use Paroki\User\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
class UpdateProfileController extends AbstractController
{
    #[Route(
        '/profile',
        'user_update_profile',
        methods: ['POST']
    )]
    public function update(
        Request $request,
        UserInterface $user,
        UserManager $userManager,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $json = json_decode($request->getContent());

        $user->setNama($json->nama);
        $errors = $validator->validate($user);
        if(0 === count($errors)){
            $userManager->save($user);
            return new JsonResponse(
                ['message' => 'Perubahan Profile berhasil disimpan.'],
                JsonResponse::HTTP_OK
            );
        }

        $messages = [];
        foreach($errors as $violation){
            $messages[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return new JsonResponse(
            ['errors' => $messages],
            JsonResponse::HTTP_BAD_REQUEST
        );
    }
}