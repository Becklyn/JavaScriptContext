<?php declare(strict_types=1);

namespace Becklyn\JavaScriptContext\Provider;

use Becklyn\JavaScriptContext\Context\JavaScriptContext;

interface ContextProviderInterface
{
    /**
     * Provides additional context for the JavaScript context.
     * Will be called exactly once just before the context is fetched.
     *
     * @param JavaScriptContext $context
     * @param string|null       $domain  an optional domain, with which the providers can decide whether
     *                                   they want to attach data or not
     */
    public function provideJavaScriptContext (JavaScriptContext $context, ?string $domain) : void;
}
