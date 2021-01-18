<?php


namespace App\Controller;


use App\Entity\Reader;
use App\Entity\ReaderAccount;
use App\Form\ReaderType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ReaderController extends BaseController
{
    /**
     * @Route ("/admin/readers", name="admin_reader")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $reader = $this->getDoctrine()->getRepository(Reader::class)->findAll();

        return $this->respond($reader);
    }

    /**
     * @Route ("/reader/{id}", name="reader")
     * @param Request $request
     * @return Response
     */
    public function readerAction(Request $request)
    {
        $id=$request->get('id');
        $reader = $this->getDoctrine()->getRepository(Reader::class)->findOneBy(['id'=>$id]);

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
    /**
     * @Route ("/reader/{id}/update", name="reader_update")
     * @param Request $request
     * @return Response
     */
    public function updateAction(Request $request)
    {
        $id=$request->get('id');
        $reader = $this->getDoctrine()->getRepository(Reader::class)->findOneBy(['id'=>$id]);
        if(!$reader) {
            throw new NotFoundHttpException('Reader not found');
        }
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

    /**
     * @Route ("/reader/{id}/delete", name="reader_delete")
     * @param Request $request
     * @return Response
     */
    public function deleteAction(Request $request)
    {
        $id=$request->get('id'); echo $id;
        $reader = $this->getDoctrine()->getRepository(Reader::class)->findOneBy(['id'=>$id]);
        if(!$reader) {
            throw new NotFoundHttpException('Reader not found');
        }
        $this->getDoctrine()->getManager()->remove($reader);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond(null);
    }
}