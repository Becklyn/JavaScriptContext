1.x to 2.0
==========

*   The signature of the `javascript_context()` Twig function has changed, as previously it had only the `$id` as argument
    but now has `$domain, $id`. To transform your implementation for v2, just do:
    
    ```twig
    {# before #}
    {{- javascript_context("your-id") -}}

    {# after #}
    {{- javascript_context(null, "your-id") -}}
    ```
    
    If you didn't set an explicit `$id`, there is nothing to change.
