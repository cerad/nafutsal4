<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Player;

class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,Player::class);

    }

    /* ==========================================================
     * Persistence
     */
    public function save($entity)
    {
        if ($entity instanceof Player)
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

