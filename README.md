JavaScript Context
==================

A simple library to send data from PHP to JavaScript.


Usage
-----

Fetch the `JavaScriptContext` service:


```php
use Becklyn\JavaScriptContext\Context\JavaScriptContext;


function doSomething (JavaScriptContext $context)
{
    $context
        ->set("some-data", 123)
        ->set("locale", "de");
}
```

Afterwards embed it in your twig template:

```twig
{{- javascript_context() -}}
```

The container will have the `_javascript-context _data-container` classes and the ID `_javascript-context`.
To modify the ID, pass the new ID to the function: 

```twig
{{- javascript_context(null, "some_other_id") -}}
``` 

Fetching the Data
-----------------

To fetch the data from the `script` container, just JSON-parse it, after removing the HTML escaping, for example:

```js
let data = JSON.parse(
   (document.getElementById("_javascript-context").textContent || "")
       .replace(/&lt;/g, "<")
       .replace(/&gt;/g, ">")
       .replace(/&amp;/g, "&")
);
```

In the JSON output, only the following chars are HTML escaped: `<`, `>` and `&`.



Context Providers
-----------------

If some data has to always be passed to the template, then it is convenient to just register a context provider.

```php
use Becklyn\JavaScriptContext\Context\JavaScriptContext;
use Becklyn\JavaScriptContext\Provider\ContextProviderInterface;

class MyProvider implements ContextProviderInterface
{
    public function provideJavaScriptContext (JavaScriptContext $context, ?string $domain) : void
    {
        $context->set("some", "value");
    }
}
```

Each provider receives the context to modify, as well as optionally a domain. This is just a `string` key with which
the providers can decide whether they want to attach data or not.

For example to separate the context into `app` and `backend` you can just register all providers and then in your
template include it like this:

```twig
{# in your frontend #}
{{- javascript_context("app") -}}


{# and in the backend do #}
{{- javascript_context("backend") -}
```

You must add the tag `javascript_context.provider` to your service.
If you use autoconfiguration, the tag is added automatically.
