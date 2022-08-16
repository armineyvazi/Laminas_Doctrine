<?php

declare(strict_types=1);

namespace Post\view\Helper;
use http\Exception\InvalidArgumentException;
use Post\Entity\Service\PostModelService;
use Post\Plugin\PostPlugin;
use Interop\Container\Containerinterface;


class PostHelper
{
    protected  $postPlugin;

    public function  getPostPlugin()
    {
        return $this->postPlugin;
    }

    public function  setPostPlugin($postPlugin)
    {
        if(!this->postPlugin instanceof PostPlugin)
        {
            throw new InvalidArgumentException(
                sprintf('
                   %s expects a %s intance;recived %s ',
                __METHOD__,PostPlugin::class,
                    (is_object  ($postPlugin) ? get_class ($postPlugin)     :   gettype ($postPlugin))
                )
            );
            return $this->postPlugin=$postPlugin;
        }
    }
    public function  __invoke(ContainerInterface  $container ,$requestedName,array  $options=null)
    {
        if(is_null($this->postPlugin))
        {
            $this->setPostPlugin(new PostPlugin((PostModelService::class)));
        }
        return $this->getPostPlugin();
    }
}