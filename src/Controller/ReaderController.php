<?php


namespace App\Controller;


use App\Entity\Reader;
use App\Form\ReaderType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReaderController extends BaseController
{
    /**
     * @Route ("/api/admin/reader", name="admin_reader")
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {
        $reader = $this->getDoctrine()->getRepository(Reader::class)->findAll();

        return $this->json($reader);
    }

    /**
     * @Route ("/api/reader/create", name="reader_create")
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request)
    {
        $reader = new Reader();
        $form = $this->createForm(ReaderType::class, $reader);
        $form->submit($request->request->all());
        if (!$form->isValid())
        {
            $name=$request->get('email');
            print_r($name);
            exit;
        }
        $this->getDoctrine()->getManager()->persist($reader);
        $this->getDoctrine()->getManager()->flush();
        return $this->json($reader);
    }
}