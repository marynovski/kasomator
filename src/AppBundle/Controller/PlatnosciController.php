<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Faktury;
use AppBundle\Entity\Podatki;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Platnosci controller.
 *
 * @Route("platnosci")
 */
class PlatnosciController extends Controller
{

    /**
     * @Route("/", name="platnosci")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilderFaktury = $em->getRepository(Faktury::class)->createQueryBuilder('f');
        $result_faktury = $queryBuilderFaktury->select('f, k')
            ->leftJoin('f.kontrahent', 'k')
            ->where($queryBuilderFaktury->expr()->isNotNull('f.terminPlatnosci'))
            ->andWhere('f.czyZaplacono = 0')
            ->orderBy('f.terminPlatnosci', 'ASC')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

//        print_r($result_faktury);

        $queryBuilderPodatki = $em->getRepository(Podatki::class)->createQueryBuilder('p');
        $result_podatki = $queryBuilderPodatki->select('p')
            ->where($queryBuilderPodatki->expr()->isNotNull('p.terminPlatnosci'))
            ->andWhere('p.czyZaplacono = 0')
            ->orderBy('p.terminPlatnosci', 'ASC')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
//        print_r($result_podatki);
//        die();

        $platnosci = array_merge($result_faktury, $result_podatki);


        foreach ($platnosci as $key => $part) {
            $sort[$key] = $part['terminPlatnosci']->getTimestamp();
        }
//        print_r($sort);
//        die();
        array_multisort($sort, SORT_ASC, $platnosci);
//        array_multisort( array_column($platnosci, "id"), SORT_ASC, $platnosci );


//        print_r($platnosci);
//        die();

        $teraz = date_create()->format('Y-m-d H:i:s');

        return $this->render('platnosci/index.html.twig', array(
            'platnosci' => $platnosci,
            'teraz' => $teraz,
        ));
    }

    /**
     * @Route("/platnosci_status_zaplacone", name="platnosci_status_zaplacone", options={"expose": true})
     * @param Request $request
     * @return JsonResponse
     */
    public function platnosciStatusZaplaconeAjaxAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException('Not XHR.');
        }
        $em = $this->getDoctrine()->getManager();

        $id = $request->request->get('id');
        if ($nr = $request->request->get('nr')) {

            $return_msg['response'] = "To jest faktura".$nr;

            $faktura = $em->getRepository(Faktury::class)->find($id);
            $faktura->setczyZaplacono(true);
            $em->persist($faktura);
            $em->flush();


        } else {

            $em = $this->getDoctrine()->getManager();

            $podatek = $em->getRepository(Podatki::class)->find($id);
            $podatek->setczyZaplacono(true);
            $em->flush();

            $return_msg['response'] = "To nie jest faktura!.".$id;
        }

        return new JsonResponse($return_msg);
    }

}
