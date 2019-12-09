## PHP Token Generator

Simple yet secure string generator for PHP7.

- Crypto-secure
- Strings can be used in URLs
- Optionnaly remove similar characters (Il1 and 0oO)
- You choose the returned string length

### Installation

```bash
composer require gsylvestre/php-token-generator
```

### Usage
```php
$generator = new \PHPTokenGenerator\TokenGenerator();
$token = $generator->generate(24); //RDTAwiMFSZiTs5y3Eqq7b9ud
```

#### Other usages
Default string length is 32:
```php
$generator = new \PHPTokenGenerator\TokenGenerator();
$token = $generator->generate(); //MpWUMGLUeg6FQQr6CHi7S8n9tfapY2bc 
```

By default, the characters `Il10oO` are removed from returned string (because they look alike and cause errors when human reading is required). You can still get them by passing `false` as second argument : 
```php
$generator = new \PHPTokenGenerator\TokenGenerator();
$token = $generator->generate(12, false); //9tIKdlfCSOo4
```

### License 
MIT