<?php

namespace App\Repository;

use App\Entity\ContentBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ContentBlockRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContentBlock::class);
    }

    public function findByCodes(array $codes)
    {
        $results = $this->findBy([
            'code' => $codes,
        ]);

        $blocks = [];
        foreach ($results as $block) {
            $blocks[$block->getCode()] = $block;
        }

        return $blocks;
    }
}
