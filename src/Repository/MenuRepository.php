<?php

namespace App\Repository;

use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @method Menu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menu[]    findAll()
 * @method Menu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuRepository extends ServiceEntityRepository
{
    protected $urlGenerator;
    protected $request;

    public function __construct(RegistryInterface $registry, UrlGeneratorInterface $urlGenerator, RequestStack $requestStack)
    {
        parent::__construct($registry, Menu::class);

        $this->urlGenerator = $urlGenerator;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function findByCode($code)
    {
        $menu = $this->createQueryBuilder('m')
            ->andWhere('m.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if ($menu instanceof Menu) {
            foreach ($menu->getItems() as &$item) {
                $item = $this->setUrl($item);
                $item = $this->setActive($item);

                foreach ($item->getSubmenuItems() as &$submenuItem) {
                    $submenuItem = $this->setUrl($submenuItem);
                    $submenuItem = $this->setActive($submenuItem);
                }
            }
        }

        return $menu;
    }

    protected function setUrl(MenuItem $item) : MenuItem
    {
        if ($item->getLinkType() === 'page') {
            $page = $this->_em->getRepository(Page::class)->find(['id' => $item->getLinkTypeId()]);
            if (empty($page)) {
                return $item;
            }

            $item->setUrl($this->urlGenerator->generate('page_view', ['slug' => $page->getSlug()]));
        }

        return $item;
    }

    protected function setActive(MenuItem $item) : MenuItem
    {
        if ($item->getLinkType() === 'page') {
            $page = $this->_em->getRepository(Page::class)->find(['id' => $item->getLinkTypeId()]);
            if (empty($page)) {
                return $item;
            }

            if (trim($page->getSlug(), '/') === trim($this->request->getPathInfo(), '/')) {
                $item->setActive(true);
                if (!empty($item->getParent())) {
                    $item->getParent()->setActive(true);
                }
            }
        }

        return $item;
    }
}
