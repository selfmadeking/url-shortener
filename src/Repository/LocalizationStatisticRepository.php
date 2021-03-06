<?php

namespace App\Repository;

use App\Entity\LocalizationStatistic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LocalizationStatistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocalizationStatistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocalizationStatistic[]    findAll()
 * @method LocalizationStatistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalizationStatisticRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LocalizationStatistic::class);
    }

    public function findLocalizationForToday($date, $country, $urlId)
    {
        $q = $this
            ->createQueryBuilder('s')
            ->where('s.createdAt = :date')
            ->andWhere('s.country = :country')
            ->andWhere('s.url = :urlId')
            ->setParameter('date', $date)
            ->setParameter('country', $country)
            ->setParameter('urlId', $urlId)
            ->getQuery();

        return $q->getResult();
    }

    public function findLocalizationWithOrderByClicks($urlId)
    {
        $q = $this
            ->createQueryBuilder('s')
            ->where('s.url = :urlId')
            ->setParameter('urlId', $urlId)
            ->orderBy('s.clicks', 'DESC')
            ->getQuery();

        return $q->getResult();
    }

}

