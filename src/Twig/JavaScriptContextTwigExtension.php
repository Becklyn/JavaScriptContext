<?php declare(strict_types=1);

namespace Becklyn\JavaScriptContext\Twig;

use Becklyn\JavaScriptContext\Context\JavaScriptContext;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class JavaScriptContextTwigExtension extends AbstractExtension
{
    /**
     * @var JavaScriptContext
     */
    private $context;


    /**
     */
    public function __construct (JavaScriptContext $context)
    {
        $this->context = $context;
    }


    /**
     */
    public function renderDataContainer (?string $domain = null, string $id = "_javascript-context") : string
    {
        return \sprintf(
            '<script id="%s" class="_javascript-context _data-container" type="application/json">%s</script>',
            \htmlspecialchars($id, \ENT_QUOTES),
            \htmlspecialchars(\json_encode($this->context->get($domain)), \ENT_NOQUOTES)
        );
    }

    /**
     * @inheritDoc
     */
    public function getFunctions ()
    {
        return [
            new TwigFunction("javascript_context", [$this, "renderDataContainer"], ["is_safe" => ["html"]]),
        ];
    }
}
