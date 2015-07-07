<?php

namespace spec\Cjm\PhpSpec;

use PhpSpec\Console\IO;
use PhpSpec\Event\ExampleEvent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EmojiFormatterSpec extends ObjectBehavior
{
    function let(IO $io)
    {
        $this->beConstructedWith($io);
    }

    function it_is_an_event_subscriber()
    {
        $this->shouldHaveType(EventSubscriberInterface::class);
    }

    function it_outputs_smiley_when_example_passes(IO $io, ExampleEvent $event)
    {
        $event->getResult()->willReturn(ExampleEvent::PASSED);

        $this->outputEmoji($event);

        $io->write(mb_convert_encoding('&#x1f604;', 'UTF-8', 'HTML-ENTITIES'))->shouldHaveBeenCalled();
        $io->write(' ')->shouldHaveBeenCalled();
    }

    function it_outputs_poop_when_example_is_failed(IO $io, ExampleEvent $event)
    {
        $event->getResult()->willReturn(ExampleEvent::FAILED);

        $this->outputEmoji($event);

        $io->write(mb_convert_encoding('&#x1F4A9;', 'UTF-8', 'HTML-ENTITIES'))->shouldHaveBeenCalled();
        $io->write(' ')->shouldHaveBeenCalled();
    }

    function it_outputs_fire_when_example_is_broken(IO $io, ExampleEvent $event)
    {
        $event->getResult()->willReturn(ExampleEvent::BROKEN);

        $this->outputEmoji($event);

        $io->write(mb_convert_encoding('&#x1F525;', 'UTF-8', 'HTML-ENTITIES'))->shouldHaveBeenCalled();
        $io->write(' ')->shouldHaveBeenCalled();
    }

    function it_outputs_monkey_when_example_is_skipped(IO $io, ExampleEvent $event)
    {
        $event->getResult()->willReturn(ExampleEvent::SKIPPED);

        $this->outputEmoji($event);

        $io->write(mb_convert_encoding('&#x1F648;', 'UTF-8', 'HTML-ENTITIES'))->shouldHaveBeenCalled();
        $io->write(' ')->shouldHaveBeenCalled();
    }

    function it_outputs_monkey_when_example_is_pending(IO $io, ExampleEvent $event)
    {
        $event->getResult()->willReturn(ExampleEvent::PENDING);

        $this->outputEmoji($event);

        $io->write(mb_convert_encoding('&#x1F649;', 'UTF-8', 'HTML-ENTITIES'))->shouldHaveBeenCalled();
        $io->write(' ')->shouldHaveBeenCalled();
    }

    function it_outputs_a_break_at_the_end(IO $io)
    {
        $this->outputSummary();

        $io->writeln()->shouldHaveBeenCalled();
    }
}
