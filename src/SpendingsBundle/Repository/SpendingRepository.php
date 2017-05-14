<?php

namespace SpendingsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SpendingRepository extends EntityRepository
{

    public function getAllSpendings() {
        return $this->getEntityManager()
            ->createQuery("SELECT s.id, c.name, s.price, s.description, s.created
FROM SpendingsBundle:Spending s
LEFT JOIN SpendingsBundle:Category c ON (s.category = c.id)
WHERE s.status = 1")
            ->getArrayResult();
    }

}
