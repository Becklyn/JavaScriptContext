<?php declare(strict_types=1);

namespace Tests\Becklyn\JavaScriptContext\Twig;

use Becklyn\JavaScriptContext\Context\JavaScriptContext;
use Becklyn\JavaScriptContext\Twig\JavaScriptContextTwigExtension;
use PHPUnit\Framework\TestCase;

class JavaScriptContextTwigExtensionTest extends TestCase
{
    /**
     *
     */
    public function testDataContainer () : void
    {
        $extension = new JavaScriptContextTwigExtension(new JavaScriptContext(["<b>" => 2]));
        self::assertSame(
            '<script id="_javascript-context" class="_javascript-context _data-container" type="application/json">{"&lt;b&gt;":2}</script>',
            $extension->renderDataContainer()
        );
    }

    /**
     *
     */
    public function testSettingId () : void
    {
        $extension = new JavaScriptContextTwigExtension(new JavaScriptContext(["<b>" => 2]));
        self::assertSame(
            '<script id="other-id" class="_javascript-context _data-container" type="application/json">{"&lt;b&gt;":2}</script>',
            $extension->renderDataContainer("other-id")
        );
    }


    /**
     * Ensure that all and the correct functions are installed.
     */
    public function testFunctionActivation ()
    {
        $extension = new JavaScriptContextTwigExtension(new JavaScriptContext());
        $functions = $extension->getFunctions();

        self::assertCount(1, $functions);
        self::assertSame("javascript_context", $functions[0]->getName());
    }
}
