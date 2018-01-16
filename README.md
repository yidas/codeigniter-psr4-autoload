<p align="center">
    <a href="https://codeigniter.com/" target="_blank">
        <img src="https://codeigniter.com/assets/images/ci-logo-big.png" height="100px">
    </a>
    <h1 align="center">CodeIgniter PSR-4 Autoload</h1>
    <br>
</p>

CodeIgniter 3 PSR-4 Autoloader for Application

[![Latest Stable Version](https://poser.pugx.org/yidas/codeigniter-psr4-autoload/v/stable?format=flat-square)](https://packagist.org/packages/yidas/codeigniter-psr4-autoload)
[![Latest Unstable Version](https://poser.pugx.org/yidas/codeigniter-psr4-autoload/v/unstable?format=flat-square)](https://packagist.org/packages/yidas/codeigniter-psr4-autoload)
[![License](https://poser.pugx.org/yidas/codeigniter-psr4-autoload/license?format=flat-square)](https://packagist.org/packages/yidas/codeigniter-psr4-autoload)

FEATURES
--------

- ***PSR-4 Namespace** support as Yii2 & Laravel elegant patterns like*

- *Easy way to use **Interface, Trait, Abstract and Extending Class***

- ***Whole Codeigniter application** directory structure support*


DEMONSTRATION
-------------

Autoload class files by PSR-4 namespace with `app` prefix in Codeigniter:

```php
# /application/libraries/MemberService.php:
\app\libraries\MemberService::auth();

# /application/widgets/StatWidget.php:
\app\widgets\StatWidget::run();

class Blog_model extends app\models\BaseModel {}
class Blog extends app\libraries\BaseController {}
class Car implements app\contracts\CarInterface {}
```

More specifically, create a class with namespace refering to the file path `\application\helpers\`:

```php
<?php
namespace app\helpers;

class ArrayHelper
{
    public static function indexBy($input) {}
}
```

Then call it in Controller action:

```php
<?php
use app\helpers\ArrayHelper;
...
ArrayHelper::indexBy($input);
\app\helpers\ArrayHelper::indexBy($input);
```

---

REQUIREMENTS
------------

This library requires the following:

- PHP 5.3.0+
- CodeIgniter 3.0.0+

---

INSTALLATION
------------

Run Composer in your Codeigniter project under the folder `\application`:

    composer require yidas/codeigniter-psr4-autoload
    
Check Codeigniter `application/config/config.php`:

```php
$config['composer_autoload'] = TRUE;
```
    
> You could customize the vendor path into `$config['composer_autoload']`

---

CONFIGURATION
-------------

After installation, you need to register it into Codeigniter system hook.

### 1. Enabling Hooks

The hooks feature can be globally enabled/disabled by setting the following item in the `application/config/config.php` file:

```php
$config['enable_hooks'] = TRUE;
```

### 2. Adding a Hook

Hooks are defined in the `application/config/hooks.php` file, add above hook into it:

```php
/*
  | -------------------------------------------------------------------
  |  Auto-load All Classes with PSR-4
  | -------------------------------------------------------------------
  | After registering \yidas\Psr4Autoload, you could auto-load every
  | classes in the whole Codeigniter application with `app` PSR-4 
  | prefix by default, for example:
  | # /application/libraries/MemberService.php:
  | \app\libraries\MemberService::auth();
  | # /application/widgets/StatWidget.php:
  | \app\widgets\StatWidget::run();
  | class Blog_model extends app\models\BaseModel {}
  | class Blog extends app\libraries\BaseController {}
  | class Car_model implements app\contracts\CarInterface {}
  |
  | The called class need to define namespace to support PSR-4 Autoload 
  | only, which means it would not support CI_Loader anymore.
  |
  | @see https://github.com/yidas/codeigniter-psr4-autoload
 */
 
$hook['pre_system'][] = [new yidas\Psr4Autoload, 'register'];
```

---

USAGE
-----

After installation, the namespace prefix `app` is used for the current Codeigniter application directory.

### Extending Class

Create a class with PSR-4 namespace under `application` directory, for eaxmple `application/model/BaseModel.php`:

```php
<?php
namespace app\models;

class BaseModel extends \CI_Model {}
```

Then define a class to extend above class, for eaxmple `application/model/My_model.php`:

```php
<?php

class My_model extends app\models\BaseModel {}
```

> In this case, Codeigniter `My_model` could not use PSR-4 namespace.


### Interface

Create a interface under `application` directory, for eaxmple `application/interface/CarInterface.php`:

```php
<?php
namespace app\interfaces;

interface CarInterface {}
```

Then apply the interface to a class, for eaxmple `application/libraries/Car.php`:

```php
<?php
namespace app\libraries;

class Car implements \app\interfaces\CarInterface {}
```

> In this case, the `Car` lib could be called by using `new \app\libraries\Car;`.


### Trait

Create a trait under `application` directory, for eaxmple `application/libraries/LogTrait.php`:

```php
<?php
namespace app\libraries;

trait LogTrait {}
```

Then inject the trait into a class, for eaxmple `application/controller/Blog.php`:

```php
class Blog extends CI_Controller
{
    use \app\libraries\LogTrait;
}
```

### Abstract

Create an abstract under `application` directory, for eaxmple `application/libraries/BaseController.php`:

```php
<?php
namespace app\libraries;

abstract class BaseController extends \CI_Controller {}
```

Then define a class to extend above abstract class, for eaxmple `application/libraries/BaseController.php`:

```php
class Blog extends app\libraries\BaseController {}
```

---

CONCEPTION
----------

Codeigniter Loader is a good practice for loading one time instantiated component just like Yii2 Application Components, but it's lacking of Class mapping, which makes inconvenience to load classes including interfaces, traits, abstracts or extending classes.

Thus, You could defind classes with PSR-4 Namespace while these classes are not component kind, even Helpers which you may want use static method and customized class name.

---

LIMITATIONS
-----------

### Namespace Class No Longer Support CI_Loader

The called class need to define namespace to support PSR-4 Autoload only, which means it would not support Built-in CI_Loader anymore.
