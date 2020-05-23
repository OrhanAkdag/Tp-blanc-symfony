<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_list")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        $pagination = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1), /*page number*/
            8 /*limit per page*/
        );
        return $this->render('article/index.html.twig', [
            'pagination' => $pagination,
            'articles'=> $articles
            ]);
    }

    /**
     * @Route("admin/article-list", name="admin_article_list")
     */
    public function listArticle(PaginatorInterface $paginator, Request $request)
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        $pagination = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('admin/list-article.html.twig', [
            'pagination' => $pagination,
            'articles'=> $articles
            ]);
    }

    /**
     * @Route("admin/add-article", name="add_article")
     */
    public function addArticle(Request $request)
    {
        $form = $this->createForm(ArticleType::class, new Article());

        $form->handleRequest($request);

       if($form->isSubmitted() and $form->isValid()){
           $article = $form->getData();
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($article);
           $entityManager->flush();
           $this->addFlash(
            'notice',
            'L\'article '.$article->getId().' a été ajouté !');
           return $this->redirectToRoute('admin_article_list');
       } else {

           return $this->render('admin/add-article.html.twig',
               [
                   'form'=> $form->createView()
               ]);
       }
    }

    /**
     * @Route("detail/{article}", name="detail_article")
     */
    public function detailArticle(Article $article)
    {

        return $this->render('article/detail-article.html.twig', ['article'=>$article]);
    }

      /**
     * @Route("admin/update-article/{article}", name="update_article")
     */
    public function updateArticle(Article $article, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'L\'article '.$article->getId().' a été mis à jour !');
            return $this->redirectToRoute('admin_article_list');
        } else {
            return $this->render('admin/edit-article.html.twig',
                [
                    'form'=> $form->createView()
                ]);
        }
    }

    /**
     * @Route("admin/delete-article/{article}", name="delete_article")
     */
    public function deleteArticle(Article $article)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        
        $this->addFlash(
            'notice',
            'L\'article '.$article->getId().' a été supprimé !');
        $entityManager->flush();
        return $this->redirectToRoute('admin_article_list');
    }

    
}
