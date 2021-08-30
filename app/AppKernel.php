<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new MyApp\UserBundle\MyAppUserBundle(),
            new PI\BaseBundle\PIBaseBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new PI\MaterielBundle\PIMaterielBundle(),
            new PI\ForumBundle\PIForumBundle(),
            new PI\GestionAdminBundle\PIGestionAdminBundle(),
            new PI\GestionRandonneurBundle\PIGestionRandonneurBundle(),
            new PI\ReclamationBundle\PIReclamationBundle(),
            new PI\guidesBundle\PIguidesBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Gregwar\CaptchaBundle\GregwarCaptchaBundle(),
            new Ob\HighchartsBundle\ObHighchartsBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new Nomaya\SocialBundle\NomayaSocialBundle(),
            new blackknight467\StarRatingBundle\StarRatingBundle(),
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            new PI\AmineBundle\PIAmineBundle(),
            new PianoSolo\WeatherBundle\PianoSoloWeatherBundle(),
            new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),



        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
