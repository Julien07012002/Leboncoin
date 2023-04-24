<?php

// src/Repository/AnnouncementRepository.php

namespace App\Repository;

use App\Entity\Announcement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announcement::class);
    }

    public function findByVisible()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.isVisible = :visible')
            ->setParameter('visible', true)
            ->getQuery()
            ->getResult();
    }
}

