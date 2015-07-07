<?php

namespace Cjm\PhpSpec;

use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\ServiceContainer;

class EmojiFormatterExtension implements ExtensionInterface
{
    /**
     * @param ServiceContainer $container
     */
    public function load(ServiceContainer $container)
    {
        $container->set(
            'formatter.formatters.emoji',
            function ($c) {
                return new EmojiFormatter(
                  //  $c->get('formatter.presenter'),
                    $c->get('console.io')
                  //  $c->get('event_dispatcher.listeners.stats')
                );
            }
        );
    }
}
