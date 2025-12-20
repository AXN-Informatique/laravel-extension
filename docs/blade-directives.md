Blade Directives
================

- [@nltop()](#nltop)
- [@nltopflat()](#nltopflat)
- [@nltobr()](#nltobr)


## @nltop()

Convert new lines into HTML paragraphs `<p>`.

```blade
@nltop("a text with \n new lines \n\n again \n\n\n and again")
```

Displays:

```html
<p>a text with <br> new lines </p><p> again </p><p> and again</p>
```

## @nltopflat()

Convert text to a single HTML paragraph, replacing all consecutive newlines with a single `<br>`.

```blade
@nltopflat("a text with \n new lines \n\n again \n\n\n and again")
```

Displays:

```html
<p>a text with <br> new lines <br> again <br> and again</p>
```

## @nltobr()

Convert new lines into HTML `<br>`

```blade
@nltobr("a text with \n new lines \n\n again \n\n\n and again")
```

Displays:

```html
a text with <br> new lines <br><br> again <br><br><br> and again
```
