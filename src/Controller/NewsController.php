<?php


namespace App\Controller;


use App\Entity\News;
use App\Form\CategoryType;
use App\Form\NewsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends BaseController

{
    /**
     * @Route ("/news", name="news")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $news = $this->getDoctrine()->getRepository(News::class)->findAll();
        return $this->respond($news);
    }

    /**
     * @Route ("/admin/news/create", name="admin_news_create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->submit($request->request->all());
        $a=$request->request->get('category');
        print_r($a);
        if (!$form->isValid())
        {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }
        $this->getDoctrine()->getManager()->persist($news);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($news);
    }
}