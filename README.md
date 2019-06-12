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
{{- javascript_context("some_other_id") -}}
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
