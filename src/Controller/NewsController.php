<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends BaseController

{
    /**
     * @Route ("/news", name="news")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $news = $this->getDoctrine()->getRepository(News::class)->findAll();

        return $this->respond($news);
    }

    /**
     * @Route ("/admin/news/create", name="admin_news_create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }
        $this->getDoctrine()->getManager()->persist($news);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($news);
    }

    /**
     * @Route ("/admin/news/{id}/update", name="news_update")
     * @param Request $request
     * @return Response
     */
    public function updateAction(Request $request): Response
    {
        $id=$request->get('id');
        $news = $this->getDoctrine()->getRepository(News::class)->findOneBy(['id'=>$id]);
        if(!$news) {
            throw new NotFoundHttpException('Reader not found');
        }
        $form = $this->createForm(NewsType::class, $news);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }
        $this->getDoctrine()->getManager()->persist($news);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($news);
    }

    /**
     * @Route ("/admin/news/{id}/delete", name="news_delete")
     * @param Request $request
     * @return Response
     */
    public function deleteAction(Request $request): Response
    {
        $id=$request->get('id');
        $news = $this->getDoctrine()->getRepository(News::class)->findOneBy(['id'=>$id]);
        if(!$news) {
            throw new NotFoundHttpException('Reader not found');
        }
        $this->getDoctrine()->getManager()->remove($news);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond(null);
    }

    /**
     * @Route ("/news/today", name="news_order")
     * @param Request $request
     * @return Response
     */
    public function orderByTodayAction(Request $request): Response
    {
        $date = date_create(date("Y-m-d"));
        $news = $this->getDoctrine()->getRepository(News::class)->findBy(['date'=>$date]);
        if(!$news) {
            throw new NotFoundHttpException('News not found');
        }
        return $this->respond($news);
    }
}