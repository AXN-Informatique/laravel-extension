Components
==========

## Required Field Marker

To display a required field marker (e.g. in a label tag):

```blade
<x-required-field-marker />
```

Displays:

```html
<span class="required-field-marker">
   &#x2a;<span>required</span>
</span>
```

You can change the default symbol "&#x2a;" (an asterisk) by the marker symbol of your choice:

```blade
<x-required-field-marker :symbol="⚠" />
```

You can style it for example like this:

```css
.required-field-marker {
    color: #da1313;
}
.required-field-marker > span {
   /* Bootstrap styles of .visually-hidden class */
   position: absolute !important;
   width: 1px !important;
   height: 1px !important;
   padding: 0 !important;
   margin: -1px !important;
   overflow: hidden !important;
   clip: rect(0, 0, 0, 0) !important;
   white-space: nowrap !important;
   border: 0 !important;
}
```

In your forms you can indicate the required fields for example in this way:

```blade
{!! trans('misc.info_required_fields'); !!} <x-required-field-marker />
```
