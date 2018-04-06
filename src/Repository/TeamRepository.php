<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Team;

class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,Team::class);

    }


    /* ==========================================================
     * Persistence
     */
    public function save($entity)
    {
        if ($entity instanceof Team)
        {
            $em = $this->getEntityManager();

            $em->persist($entity);

            return;
        }
        throw new \Exception('Wrong type of entity for save');
    }
    public function commit()
    {
       $em = $this->getEntityManager();
       $em->flush();
    }
}
?>
