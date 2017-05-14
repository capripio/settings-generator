# Generate Settings For Backpack 
##Inspired By Settings Module
Generate Setting template for Backpack

To Use

1) Add the service provider to your config/app.php file:
```php
Capripio\SettingsGenerator\SettingsServiceProvider::class,
```


### Programmer
Use it like you would any config value in a virtual settings.php file. Except the values are stored in the database and fetched on boot, instead of being stored in a file.

``` php
Config::get('settings.contact_email')
Config::get('{SomeSettingName}.{SettingKey}')
Config::get('shipping.fees')
```