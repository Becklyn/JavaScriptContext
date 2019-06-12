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
     * @param JavaScriptContext $context
     */
    public function __construct (JavaScriptContext $context)
    {
        $this->context = $context;
    }


    /**
     * @return string
     */
    public function renderDataContainer (string $id = "_javascript-context") : string
    {
        return \sprintf(
            '<script id="%s" class="_javascript-context _data-container" type="application/json">%s</script>',
            \htmlspecialchars($id, \ENT_QUOTES),
            \htmlspecialchars(\json_encode($this->context->get()), \ENT_NOQUOTES)
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
