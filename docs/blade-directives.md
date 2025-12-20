Blade Directives
================

## @nltop()

Convert newlines to HTML paragraphs. Multiple consecutive newlines create new paragraphs, single newlines become `<br>`.

```blade
@nltop("First line\nSecond line\n\nNew paragraph")
```
```html
<p>First line<br>Second line</p><p>New paragraph</p>
```

## @nltopflat()

Convert text to a single paragraph, all consecutive newlines become a single `<br>`.

```blade
@nltopflat("Line 1\n\nLine 2\n\n\nLine 3")
```
```html
<p>Line 1<br>Line 2<br>Line 3</p>
```

## @nltobr()

Convert newlines to `<br>` (like PHP's `nl2br()`).

```blade
@nltobr("Line 1\nLine 2\n\nLine 3")
```
```html
Line 1<br>Line 2<br><br>Line 3
```
