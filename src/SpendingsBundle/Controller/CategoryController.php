<?php

namespace SpendingsBundle\Controller;

use SpendingsBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use SpendingsBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * @Template("SpendingsBundle:Category:index.html.twig")
     */
    public function indexAction(Request $request)
    {

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('category'));
        }

        return [
            'name' => 'Jon',
            'form' => $form->createView(),
        ];
    }

    public function tableAction() {
        $aaCategories = $this->getDoctrine()
            ->getRepository('SpendingsBundle:Category')
            ->getActiveCategories();

        foreach ($aaCategories as $iKey => $aCategory) {
            $aaCategories[$iKey]['created'] = $aCategory['created']->format('Y-m-d H:i:s');
        }

        $response = new Response(json_encode(['data' => $aaCategories]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function callAction(Request $request) {

//        $aCategoryData = $request->request->get('category');
//        $category = new Category();
//        $category->setSymbol($aCategoryData['symbol']);
//        $category->setName($aCategoryData['name']);
//        $category->setDescription($aCategoryData['description']);
//        $category->setCreated(date('Y-m-d H:i:s'));
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($category);
//        $em->flush();

//        $aCategory = $this->getDoctrine()
//            ->getRepository('SpendingsBundle:Category')
//            ->getCategoryBySymbol($category->getSymbol());

//        $response = new Response(json_encode(['status' => 'success']));
//        $response->headers->set('Content-Type', 'application/json');

        $category = new Category();
        $category->setSymbol('own');
        $category->setName('new name');
        $category->setDescription('DDD');
        $category->setCreated(date('Y-m-d H:i:s'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return new Response('Success');

    }

//http://127.0.0.1:8000/category

}
