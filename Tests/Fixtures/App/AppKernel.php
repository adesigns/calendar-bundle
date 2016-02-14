<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;


class AppKernel extends Kernel
{
    public function getRootDir()
    {
        return __DIR__;
    }

    public function registerBundles()
    {
        $bundles = array();

        $bundles[] = new \Symfony\Bundle\FrameworkBundle\FrameworkBundle();
        $bundles[] = new \ADesigns\CalendarBundle\ADesignsCalendarBundle();

        return $bundles;
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir().'/'.Kernel::VERSION.'/adesigns-calendar-bundle/cache/'.$this->environment;
    }
    public function getLogDir()
    {
        return sys_get_temp_dir().'/'.Kernel::VERSION.'/adesigns-calendar-bundle/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }
}