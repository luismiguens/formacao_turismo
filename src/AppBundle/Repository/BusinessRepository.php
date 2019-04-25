<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Year;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupRepository
 *
 * @author luis
 */
class BusinessRepository extends EntityRepository {

    //put your code here



    public function findBusinessByYear(Year $year) {

        $rsm = new ResultSetMapping;
        $rsm->addEntityResult('AppBundle:Business', 'b');
        $rsm->addFieldResult('b', 'id', 'id');
        $rsm->addFieldResult('b', 'name', 'name');
        $rsm->addFieldResult('b', 'website', 'website');
        $rsm->addFieldResult('b', 'presentation', 'presentation');
        $rsm->addFieldResult('b', 'image', 'image');
        
        $query = $this->_em->createNativeQuery('SELECT LENGTH(business.name) l, id, name, website, presentation, image '
                . 'FROM business '
                . 'INNER JOIN business_year '
                . 'ON business.id = business_year.business_id '
                . 'WHERE business_year.year_id = ? '
                . 'ORDER BY l', $rsm);
        $query->setParameter(1, $year->getId());

        return $query->getResult();


    }

}
