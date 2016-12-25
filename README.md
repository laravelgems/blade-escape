# Blade Escape - fight against XSS

Blade Escape is a service provider that extends `Blade` directives and allows use `Laragems\Escape` library.

```php
<div style="background-color: @css($color);">
    <label>@text($label)</label>
    <input type="text" name="custom" value="@attr($value)"/>
</div>
<a href="/profile?u=@param($username)">Profile</a>
<button onclick="callMyFunction('@js($username)');">Validate</button>
<script>
    var username = "@js($username)";
</script>
```

## Installation
```shell
composer require laravelgems/blade-escape
```

After that add service provider to a `config\app.php`
```php
        /*
         * Package Service Providers...
         */
         ...
         LaravelGems\BladeEscape\Providers\BladeEscapeServiceProvider::class,
         ...
```

## HTML - @text($variable), safe
```php
<p>@text($resume)</p>
<div>@text($bio)</div>
```

## HTML Attribute - @attr(@variable), safe when following rules
Attribute's value should be quoted. For usage with whitelist attributes: align, alink, alt, bgcolor, border, cellpadding, cellspacing, class, color, cols, colspan, coords, dir, face, height, hspace, ismap, lang, marginheight, marginwidth, multiple, nohref, noresize, noshade, nowrap, ref, rel, rev, rows, rowspan, scrolling, shape, span, summary, tabindex, title, usemap, valign, value, vlink, vspace, width

```php
<input type="text" value="@attr($variable)"/>
<img src="image.png" alt="@attr($variable)"/>
```

## URL Parameter - @param($variable), safe
```php
<a href="search?keyword=@param($variable)">Click Me</a>
```

## Javascript Parameter - @js($variable), safe when following rules
Value should be quoted. Avoid using dangerous functions (eval and so on), example - `setTimeout("@js($variable)")` (can be hacked!)

```php
<script>
    var username = "@js($variable)";
</script>
<a href="#" onclick="displayDialog('@js($title)');">Click</a>
```

## CSS - @css($variable), safe when following rules
Surrounded by quotes. Avoid complex properties like `url`, `behavior` and custom (`-moz-binding`). Do not put untrusted data into IE's expression property value
```php
<style>
    .article { background-color: '@css($color)';}
</style>
<span style="width: '@css($width)';"></span>
```

**Must Read:** [QWASP - XSS Prevention Cheat Sheet](https://www.owasp.org/index.php/XSS_(Cross_Site_Scripting)_Prevention_Cheat_Sheet)


You don't like the names of directives. Ok, just change them in a published config.
