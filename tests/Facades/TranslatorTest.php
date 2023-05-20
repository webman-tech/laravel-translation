<?php

namespace WebmanTech\LaravelTranslation\Tests\Facades;

use Illuminate\Contracts\Translation\Translator as TranslatorContract;
use PHPUnit\Framework\TestCase;
use WebmanTech\LaravelTranslation\Facades\Translator;

/**
 * https://laravel.com/docs/10.x/localization
 */
class TranslatorTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(TranslatorContract::class, Translator::instance());
        $this->assertInstanceOf(TranslatorContract::class, transL());
        $this->assertEquals(null, __()); // __() 不传返回 null
    }

    public function testLocale()
    {
        // 当前 locale
        $this->assertEquals('zh_CN', locale());

        // 由于未设置 fallback_locale，所以当 zh_CN 下没有该 key 时返回原始内容
        $this->assertEquals('你好', trans('你好')); // symfony 默认使用 domain 为 messages
        $this->assertEquals('messages.你好', transL('messages.你好')); // laravel 需要添加所属 group

        // 已有的翻译
        $this->assertEquals('你好', trans('你好2'));
        $this->assertEquals('你好', transL('messages.你好2'));

        // 用句子做为翻译的 key
        $this->assertEquals('我爱编程 From Message', trans('I love programming.')); // symfony 直接在 message 中写句子即可
        $this->assertEquals('我爱编程 From json', transL('I love programming.')); // laravel 需要写在 zh_CN.json 中

        // 指定语言文件
        $this->assertEquals('app中的翻译', trans('key_from_app', [], 'app'));
        $this->assertEquals('app中的翻译', transL('app.key_from_app'));


        // 设置 locale 为 en
        $this->assertEquals('en', locale('en'));

        // 已有的翻译
        $this->assertEquals('hello', trans('你好'));
        $this->assertEquals('hello', transL('messages.你好'));

        // 替换内容
        $this->assertEquals('hello, boy', trans('welcome0', ['%name%' => 'boy'])); // symfony 正常使用 %name%
        $this->assertEquals('hello, boy', trans('welcome', [':name' => 'boy'])); // symfony 也可以替换 :name
        $this->assertEquals('hello, boy', transL('messages.welcome', ['name' => 'boy'])); // laravel 不需要带上 :
        $this->assertEquals('hello, DAYLE', transL('messages.welcome2', ['name' => 'dayle'])); // laravel 自动转大写字母
        $this->assertEquals('hello, Dayle', transL('messages.welcome3', ['name' => 'dayle'])); // laravel 自动转首字母大写

        // 负数处理
        $this->assertEquals('There is one apple', trans('apple_count', ['%count%' => 1])); // symfony 使用 %count%
        $this->assertEquals('There are many apples', trans('apple_count', ['%count%' => 10]));
        $this->assertEquals('There is no apple', trans('apple_count2', ['%count%' => 0]));
        $this->assertEquals('There is one apple', trans('apple_count2', ['%count%' => 1]));
        $this->assertEquals('There are 18 apples', trans('apple_count2', ['%count%' => 18]));
        $this->assertEquals('There are many apples', trans('apple_count2', ['%count%' => 25]));
        $this->assertEquals('There is one apple', trans_choice('messages.apple_count', 1)); // laravel 使用 trans_choice
        $this->assertEquals('There are many apples', trans_choice('messages.apple_count', 3));
        $this->assertEquals('There is no apple', trans_choice('messages.apple_count3', 0));
        $this->assertEquals('There is one apple', trans_choice('messages.apple_count3', 1));
        $this->assertEquals('There are 18 apples', trans_choice('messages.apple_count3', 18, ['count' => 18]));
        $this->assertEquals('There are many apples', trans_choice('messages.apple_count3', 25));
    }
}
