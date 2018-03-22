<p align="center">
    <a href="https://codeigniter.com/" target="_blank">
        <img src="https://codeigniter.com/assets/images/ci-logo-big.png" height="100px">
    </a>
    <h1 align="center">CodeIgniter PSR-4 Autoload</h1>
    <br>
</p>

CodeIgniter 3 PSR-4 Autoloader for Application

[![Latest Stable Version](https://poser.pugx.org/yidas/codeigniter-psr4-autoload/v/stable?format=flat-square)](https://packagist.org/packages/yidas/codeigniter-psr4-autoload)
[![License](https://poser.pugx.org/yidas/codeigniter-psr4-autoload/license?format=flat-square)](https://packagist.org/packages/yidas/codeigniter-psr4-autoload)

This PSR-4 extension is collected into [yidas/codeigniter-pack](https://github.com/yidas/codeigniter-pack) which is a complete solution for Codeigniter framework.

FEATURES
--------

- ***PSR-4 Namespace** support as Yii2 & Laravel elegant patterns like*

- *Easy way to use **Interface, Trait, Abstract and Extending Class***

- ***Whole Codeigniter application** directory structure support*

---

OUTLINE
-------

- [Demonstration](#demonstration)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
  - [Extending Class](#extending-class)
  - [Interface](#interface)
  - [Trait](#trait)
  - [Abstract](#abstract)
- [Conception](#conception)
- [Limitations](#limitations)
  
---

DEMONSTRATION
-------------

By default, all PSR-4 namespace with `app` prefix in Codeigniter would relates to application directory.

- The class `/application/libraries/MemberService.php` could be called by:

```php
new \app\libraries\MemberService;
```

- The class `/application/services/Process.php` with `static run()` method could be called by:

```php
\app\services\Process::run();
```

- Enable to extend or implement classes with standard way:

```php
class Blog_model extends app\models\BaseModel {}
class Blog extends app\components\BaseController {}
class Car implements app\contracts\CarInterface {}
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

USAGE
-----

After installation, the namespace prefix `app` is used for the current Codeigniter application directory.


### Static Class


Create a hepler with PSR-4 namespace with a new `helpers` folder under `application` directory, for eaxmple `\application\helpers\`:

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

Create a interface with a new `interface` folder under `application` directory, for eaxmple `application/interface/CarInterface.php`:

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
namespace app\components;

trait LogTrait {}
```

Then inject the trait into a class, for eaxmple `application/controller/Blog.php`:

```php
class Blog extends CI_Controller
{
    use \app\components\LogTrait;
}
```

### Abstract

Create an abstract under `application` directory, for eaxmple `application/libraries/BaseController.php`:

```php
<?php
namespace app\components;

abstract class BaseController extends \CI_Controller {}
```

Then define a class to extend above abstract class, for eaxmple `application/libraries/BaseController.php`:

```php
class Blog extends app\components\BaseController {}
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
