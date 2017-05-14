<?php

namespace SpendingsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{

    public function getActiveCategories() {
        return $this->getEntityManager()
                    ->createQuery("SELECT c.id, c.name, c.description, c.created FROM SpendingsBundle:Category c WHERE c.status = 1")
                    ->getArrayResult();
    }

    public function getCategoryBySymbol($sSymbol) {
        return $this->getEntityManager()
            ->createQuery("SELECT c.id, c.name, c.description, c.created FROM SpendingsBundle:Category c WHERE c.symbol = :symbol")
            ->setParameter('symbol', $sSymbol)
            ->getArrayResult();
    }

}
