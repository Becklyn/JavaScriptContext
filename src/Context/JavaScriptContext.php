<?php declare(strict_types=1);

namespace Becklyn\JavaScriptContext\Context;

use Becklyn\JavaScriptContext\Exception\ContextSealedException;

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
     * @param array $initial
     */
    public function __construct (array $initial = [])
    {
        $this->data = $initial;
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
     * @return array
     */
    public function get () : array
    {
        if ($this->sealed)
        {
            throw new ContextSealedException("Can't get data, as the context is already sealed.");
        }

        $this->sealed = true;
        return $this->data;
    }
}
