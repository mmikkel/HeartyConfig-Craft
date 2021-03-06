# Craft Hearty Config 1.1.3

This is my multi-environment config setup for Craft CMS. There are many like it, but this one is mine.

*Hearty makes it easy to set up Craft installs that are easy to move and deploy between different environments*.

With Hearty, the current environment is determined based on the host – i.e. $_SERVER[ 'SERVER_NAME' ] – and a map of URLs and environment keys. The idea is to "down-grade" general.php and db.php to just contain default/common settings; placing any additional environment specific settings (such as db credentials etc) in separate files following the template *config.{environment_key}.php*.

Note: Some (many?) ideas borrowed from BarrelStrength's config @ https://github.com/BarrelStrength/Craft-Multi-Environment-Config. A few main differences between BarrelStrength's setup and mine include:

- Hearty's environment config files combine database and general settings
- Hearty's environment config files are kept at root level of the /config folder

## Guide

With Hearty, your /config folder will contain some additional files, specifically *hearty.php* (where your different environments should be declared) as well as any environment specific config files (config.{environment}.php).

**I like to keep the /config folder outside my Craft folder, and to place both above the web root**.

To begin using Hearty, open up *hearty.php*, declare your environment URLs and keys, and then include the file in index.php (or just use the index.php example file included with Hearty):

```php
@include('../config/hearty.php');
```

Please note that multiple environment URLs should be either comma-separated, or a multi-dimensional array:

```php
$envs = [
    'dev' => ['dev.example1.com', 'dev.example2.com'],
    'stage' => 'stage.example1.com',
    'prod' => 'example.com,www.example.com',
];
```

### Important – about local dev:

For local development, Hearty ignores the $env array and just looks for a file called *config.local.php*. If that file is found, local environment is assumed, basically enabling you to use whatever URL and config settings you want for local environments. This is a good idea for teams working on the same application, enabling everyone to easily use their own URL and settings locally. _If you need common config settings for local environments, you can add a "local" environment to general.php and/or db.php._

*It's a super good idea to gitignore config.local.php*.
