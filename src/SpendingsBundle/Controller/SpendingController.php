<?php

namespace SpendingsBundle\Controller;

use SpendingsBundle\Entity\Spending;
use SpendingsBundle\Form\SpendingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class SpendingController extends Controller
{
    /**
     * @Template("SpendingsBundle:Spending:index.html.twig")
     */
    public function indexAction(Request $request)
    {

        $category = new Spending();
        $form = $this->createForm(SpendingType::class, $category);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('spendings'));
        }

        return [
            'name' => 'Jon',
            'form' => $form->createView(),
        ];
    }

    public function tableAction() {
        $aaSpendings = $this->getDoctrine()
            ->getRepository('SpendingsBundle:Spending')
            ->getAllSpendings();

        foreach ($aaSpendings as $iKey => $aSpending) {
            $aaSpendings[$iKey]['created'] = $aSpending['created']->format('Y-m-d H:i:s');
        }

        $response = new Response(json_encode(['data' => $aaSpendings]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
