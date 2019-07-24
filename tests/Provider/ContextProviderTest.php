<?php declare(strict_types=1);

namespace Tests\Becklyn\JavaScriptContext\Provider;

use Becklyn\JavaScriptContext\Context\JavaScriptContext;
use Becklyn\JavaScriptContext\Provider\ContextProviderInterface;
use PHPUnit\Framework\TestCase;

class ContextProviderTest extends TestCase
{
    /**
     * Tests that the provider is called if the context is fetched.
     */
    public function testCalled () : void
    {
        $provider = $this->getMockBuilder(ContextProviderInterface::class)
            ->getMock();
        $context = new JavaScriptContext([], [$provider]);

        $provider
            ->expects(self::once())
            ->method("provideJavaScriptContext")
            ->with($context, null);

        $context->get();
    }

    /**
     * Checks that the provider is not called if the context is never fetched.
     */
    public function testNotCalled () : void
    {
        $provider = $this->getMockBuilder(ContextProviderInterface::class)
            ->getMock();

        $provider
            ->expects(self::never())
            ->method("provideJavaScriptContext");

        $context = new JavaScriptContext([], [$provider]);
        $context->set("key", "value");
    }

    /**
     * Tests that the provider is called if the context is fetched.
     */
    public function testProviderArguments () : void
    {
        $provider = $this->getMockBuilder(ContextProviderInterface::class)
            ->getMock();
        $context = new JavaScriptContext([], [$provider]);

        $provider
            ->expects(self::once())
            ->method("provideJavaScriptContext")
            ->with($context, "domain");

        $context->get('domain');
    }
}
