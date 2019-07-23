<?php


namespace App\Controller;

use App\Service\HorseService;
use App\Service\RaceService;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use App\Service\RaceHorseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\RouteCollection;
class RaceHorseController extends AbstractController
{

    /**
     * @var RaceHorseService
     */
    private $raceHorseService;

    /**
     * @var RaceService
     */
    private $raceService;

    /**
     * RaceHorseController constructor.
     * @param RaceHorseService $raceHorseService
     * @param RaceService $raceService
     */
    public function __construct(RaceHorseService $raceHorseService,RaceService $raceService)
    {
        $this->raceHorseService = $raceHorseService;
        $this->raceService = $raceService;
    }

    /**
     * @Route("/raceHorse/list", name="home_url", methods={"GET"})
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(){
        $ongoingRaces = $this->raceHorseService->findOngoingRaces();
        $bestResult=$this->raceHorseService->findBestResult();
        $finishedRaces=$this->raceHorseService->findFinishedRaces();
        $canCreate = $this->raceService->isMaximumOngoingRaceMet();
        return $this->render('races/index.html.twig',array('races'=>$ongoingRaces,'canCreate'=>$canCreate,'bestResult'=>$bestResult,'finishedRaces'=>$finishedRaces));
    }

    /**
     *  @param $request
     * @throws \Doctrine\ORM\ORMException
     * @Route("raceHorse/create", name="create_race", methods={"POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */

    public function createNewRace(Request $request)
    {
        $canCreate = $this->raceService->isMaximumOngoingRaceMet();
        if(!$canCreate)
        {
            throw new AccessDeniedException($this->generateUrl('home_url'));
        }
        $result= $this->raceHorseService->createNewRace();
        exit(json_encode($result));
    }

    /**
     * @param Request $request
     * @Route("raceHorse/progress", name="progress_race", methods={"POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function progressOngoingRacesAjax(Request $request)
    {
        $result= $this->raceHorseService->progressOngoingRaces();
        exit(json_encode($result));
    }

}