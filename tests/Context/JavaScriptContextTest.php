<?php declare(strict_types=1);

namespace Tests\Becklyn\JavaScriptContext\Context;

use Becklyn\JavaScriptContext\Context\JavaScriptContext;
use Becklyn\JavaScriptContext\Exception\ContextSealedException;
use PHPUnit\Framework\TestCase;

class JavaScriptContextTest extends TestCase
{
    /**
     *
     */
    public function testSetting () : void
    {
        $context = new JavaScriptContext(["c" => true]);
        $context
            ->set("a", 1)
            ->set("b", "two");

        $result = $context->get();
        self::assertSame(1, $result["a"]);
        self::assertSame("two", $result["b"]);
        self::assertSame(true, $result["c"]);
    }


    public function testOverwrite () : void
    {
        $context = new JavaScriptContext(["c" => true]);
        $context
            ->set("a", 1)
            ->set("a", 2)
            ->set("c", false);
        
        $result = $context->get();
        self::assertSame(2, $result["a"]);
        self::assertSame(false, $result["c"]);
    }


    /**
     *
     */
    public function testSetSeal () : void
    {
        $this->expectException(ContextSealedException::class);
        $context = new JavaScriptContext(["c" => 3]);
        $context->get();
        $context->set("a", 1);
    }


    /**
     *
     */
    public function testGetSeal () : void
    {
        $this->expectException(ContextSealedException::class);
        $context = new JavaScriptContext(["c" => 3]);
        $context->get();
        $context->get();
    }
}
