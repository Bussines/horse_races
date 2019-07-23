<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserController extends AbstractController
{

    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * @return Response
     * @Route("/user/list", name="user_url", methods={"GET"})
     */
    public function index(){
        $users =  $this->userService->findAllUsers();
        $adminUser= $this->userService->getAdmin();
        $adminData=array();
        if(isset($adminUser))
        {
            $adminData['id']=(int)$adminUser['userId'];

        }
        return $this->render('users/index.html.twig',array('users'=>$users,'adminData'=>$adminData));
    }

    /**
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @param $request
     * @Route("/user/delete", name="delete_user", methods={"DELETE"})
     */
    public function deleteUserAjax(Request $request){
        $id = $request->get('id');
        $result= $this->userService->deleteUserById($id);
        exit(json_encode($result));
    }

}