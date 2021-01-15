<?php


namespace App\Controller;


use App\Entity\Reader;
use App\Form\ReaderType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReaderController extends BaseController
{
    /**
     * @Route ("/admin/reader", name="admin_reader")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $reader = $this->getDoctrine()->getRepository(Reader::class)->findAll();

        return $this->respond($reader);
    }

    /**
     * @Route ("/reader/create", name="reader_create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $reader = new Reader();
        $form = $this->createForm(ReaderType::class, $reader);
        $form->submit($request->request->all());
        if (!$form->isValid())
        {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }
        $this->getDoctrine()->getManager()->persist($reader);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($reader);
    }

}