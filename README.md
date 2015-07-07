# Emoji Formatter for PhpSpec

## Installation

Install with composer:

```
composer require --dev ciaranmcnulty/phpspec-emoji-formatter "@dev"
```

Add to `phpspec.yml`:

```
formatter.name: emoji

extensions:
  - Cjm\PhpSpec\EmojiFormatterExtension
```

## Usage

Execute phpspec with the flag `--format emoji`

