<?php

namespace spec\Cjm\PhpSpec;

use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\ObjectBehavior;
use PhpSpec\ServiceContainer;
use Prophecy\Argument;

class EmojiFormatterExtensionSpec extends ObjectBehavior
{
    function it_is_an_extension()
    {
        $this->shouldHaveType(ExtensionInterface::class);
    }

    function it_adds_an_emoji_formatter(ServiceContainer $container)
    {
        $this->load($container);

        $container->set('formatter.formatters.emoji', Argument::any())->shouldBeCalled();
    }
}
