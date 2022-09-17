# webman-tech/laravel-translation

Laravel [illuminate/translation](https://packagist.org/packages/illuminate/translation) for webman

## 介绍

站在巨人（laravel）的肩膀上使文件存储使用更加*可靠*和*便捷*

所有方法和配置与 laravel 几乎一模一样，因此使用方式完全参考 [Laravel文档](http://laravel.p2hp.com/cndocs/8.x/translation) 即可

## 安装

```bash
composer require webman-tech/laravel-translation
```

## 使用

所有 API 同 laravel，以下仅对有些特殊的操作做说明

常规使用如下：

```php
<?php
namespace app\controller;

use support\Request;

class FooController
{
    public function bar(Request $request) 
    {
        $message1 = transL('messages.abc');
        $message2 = trans_choice('messages.xyz', 2);
        $message3 = __('messages.mnl');
        return json([
            $message1, $message2, $message3
        ]);
    }
}
```

### tranL()

由于 webman 下默认使用 `symfony/translation`，且已经定义过 trans 方法，为了不冲突，此处使用 `transL()`
