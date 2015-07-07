<?php

namespace Cjm\PhpSpec;

use PhpSpec\Console\IO;
use PhpSpec\Event\ExampleEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EmojiFormatter implements EventSubscriberInterface
{
    /**
     * @var IO
     */
    private $io;

    public function __construct(IO $io)
    {
        $this->io = $io;
    }

    public static function getSubscribedEvents()
    {
        return [
            'afterExample' => 'outputEmoji',
            'afterSuite' => 'outputSummary'
        ];
    }

    public function outputEmoji(ExampleEvent $event)
    {
        switch ($event->getResult()) {
            case ExampleEvent::PASSED:
                $this->io->write($this->encodeChar('&#x1f604;'));
                break;
            case ExampleEvent::FAILED:
                $this->io->write($this->encodeChar('&#x1f4a9;'));
                break;
            case ExampleEvent::BROKEN:
                $this->io->write($this->encodeChar('&#x1F525;'));
                break;
            case ExampleEvent::SKIPPED:
                $this->io->write($this->encodeChar('&#x1F648;'));
                break;
            case ExampleEvent::PENDING:
                $this->io->write($this->encodeChar('&#x1F649;'));
                break;
        }

        $this->io->write(' ');
    }


    private function encodeChar($entity)
    {
        return mb_convert_encoding($entity, 'UTF-8', 'HTML-ENTITIES');
    }

    public function outputSummary()
    {
        $this->io->writeln();
    }
}
