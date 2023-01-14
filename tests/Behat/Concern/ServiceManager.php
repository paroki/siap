<?php


namespace Paroki\Tests\Behat\Concern;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

trait ServiceManager
{
    private KernelInterface $kernel;
    private ContainerInterface $container;

    /**
     * @return KernelInterface
     */
    public function getKernel(): KernelInterface
    {
        return $this->kernel;
    }

    /**
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel): void
    {
        $this->kernel = $kernel;
        $this->container = $kernel->getContainer();
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    public function getService(string $id)
    {
        return $this->getContainer()->get($id);
    }
}