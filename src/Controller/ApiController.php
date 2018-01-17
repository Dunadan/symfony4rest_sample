<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use App\Entity\UselessEntity;
use App\Form\UselessType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends FOSRestController
{

    protected $em = null;
    /**
     * ApiController constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getUselessesAction()
    {
        $result = $this->em->getRepository(UselessEntity::class)->findAll();

        return View::create($result);
    }

    public function getUselessAction($id)
    {
        $result = $this->getEntityOr404($id);

        return View::create($result);
    }

    protected function getEntityOr404($id)
    {
        $result = $this->em->getRepository(UselessEntity::class)->find($id);

        if ($result === null) {
            throw new NotFoundHttpException("Entity not found");
        }

        return $result;
    }

    public function postUselessAction(Request $request)
    {
        $form = $this->createForm(UselessType::class );

        $form->handleRequest($request);

        if ($form->isValid()) {

            $useless = $form->getData();
            $this->em->persist($useless);
            $this->em->flush();

            return View::create($useless, Response::HTTP_CREATED);

        } else {
            return View::create($form, Response::HTTP_BAD_REQUEST);
        }
    }

    public function patchUselessAction($id, Request $request)
    {
        $useless = $this->getEntityOr404($id);

        $form = $this->createForm(UselessType::class, $useless,['method' => $request->getMethod()]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $useless = $form->getData();

            $this->em->persist($useless);
            $this->em->flush();

            return View::create($useless, Response::HTTP_OK);

        } else {
            return View::create($form, Response::HTTP_BAD_REQUEST);
        }
    }

    public function deleteUselessAction($id)
    {
        $useless = $this->getEntityOr404($id);

        $this->em->remove($useless);
        $this->em->flush();

        return View::create($useless, Response::HTTP_NO_CONTENT);
    }

}