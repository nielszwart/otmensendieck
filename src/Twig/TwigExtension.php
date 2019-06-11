<?php
namespace App\Twig;

use App\Entity\Media;
use App\Entity\Menu;
use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    protected $em;
    protected $urlGenerator;

    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator)
    {
        $this->em = $em;
        $this->urlGenerator = $urlGenerator;
    }

    public function getFilters()
    {
        return array(
            new TwigFilter('formatBytes', array($this, 'formatBytes')),
        );
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('getMenu', array($this, 'getMenu')),
            new TwigFunction('getMedia', array($this, 'getMedia')),
        );
    }


    /**
     * @param $bytes
     * @param int $precision
     * @return string
     */
    public function formatBytes($bytes, $precision = 0)
    {
        $size = ['B','kB','MB','GB','TB','PB','EB','ZB','YB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$precision}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    /**
     * @param $code
     * @return string
     */
    public function getMenu($code)
    {
        $menu = $this->em->getRepository(Menu::class)->findOneBy(['code' => $code]);
        if (empty($menu)) {
            return '';
        }

        foreach ($menu->getItems() as &$item) {
            if ($item->getLinkType() === 'page') {
                $page = $this->em->getRepository(Page::class)->find(['id' => $item->getLinkTypeId()]);
                if (empty($page)) {
                    continue;
                }

                $item->setUrl($this->urlGenerator->generate('page_view', ['slug' => $page->getSlug()]));
            }
        }

        return $menu;
    }

    /**
     * @param $code
     * @return string
     */
    public function getMedia($code)
    {
        $media = $this->em->getRepository(Media::class)->findOneBy(['code' => $code]);
        if (empty($media)) {
            return '';
        }

        return '/media/' . $media->getImage()->getName();
    }
}
