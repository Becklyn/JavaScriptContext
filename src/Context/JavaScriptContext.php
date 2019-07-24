<?php declare(strict_types=1);

namespace Becklyn\JavaScriptContext\Context;

use Becklyn\JavaScriptContext\Exception\ContextSealedException;
use Becklyn\JavaScriptContext\Provider\ContextProviderInterface;

class JavaScriptContext
{
    /**
     * @var array
     */
    private $data;


    /**
     * @var bool
     */
    private $sealed = false;


    /**
     * @var iterable|ContextProviderInterface[]
     */
    private $providers;


    /**
     * @param array    $initial
     * @param iterable $providers
     */
    public function __construct (array $initial = [], iterable $providers = [])
    {
        $this->data = $initial;
        $this->providers = $providers;
    }


    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return JavaScriptContext
     */
    public function set (string $key, $value) : self
    {
        if ($this->sealed)
        {
            throw new ContextSealedException("Can't set data, as the context is already sealed.");
        }

        $this->data[$key] = $value;
        return $this;
    }


    /**
     * Returns the complete context and seals the container.
     *
     * @param string|null $domain an optional domain, with which the providers can decide whether they want to attach
     *                            data or not
     *
     * @return array
     */
    public function get (?string $domain = null) : array
    {
        if ($this->sealed)
        {
            throw new ContextSealedException("Can't get data, as the context is already sealed.");
        }

        foreach ($this->providers as $provider)
        {
            $provider->provideJavaScriptContext($this, $domain);
        }

        $this->sealed = true;
        return $this->data;
    }
}
