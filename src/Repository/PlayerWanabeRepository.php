<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\PlayerWanabe;

class PlayerWanabeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,PlayerWanabe::class);
    }
    public function createPlayer()
    {
        return new PlayerWanabe();
    }
    /* ==========================================================
     * Persistence
     */
    public function save($entity)
    {
        if ($entity instanceof PlayerWanabe)
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

