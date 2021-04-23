# Custom Assets 

You can send `CSS` or `Javascript` code from any view to the main container in order to be located correctly.

In the main container, two storage groups are defined:

```html
<!-- Css classes -->
<style>
    [x-cloak]{display:none;}
    .pulse-vertical-align{top:30%}.pulse{width:80px;height:80px;position:fixed;left:50%;margin-left:-50px;top:50%;margin-top:-50px;}.double-bounce1,.double-bounce2{width:100%;height:100%;border-radius:50%;background-color:{{ config('livewire-tables.loadingColor') }};opacity:.6;position:absolute;top:0;left:0;-webkit-animation:sk-bounce 2s infinite ease-in-out;animation:sk-bounce 2s infinite ease-in-out}.double-bounce2{-webkit-animation-delay:-1s;animation-delay:-1s}@-webkit-keyframes sk-bounce{0%,100%{-webkit-transform:scale(0)}50%{-webkit-transform:scale(1)}}@keyframes sk-bounce{0%,100%{transform:scale(0);-webkit-transform:scale(0)}50%{transform:scale(1);-webkit-transform:scale(1)}}
    
    /* Your custom CSS */
    @stack('belich-tables-css')
</style>

<!-- Your custom Javascript -->
<script>
    @stack('belich-tables-javascript')
</script>
```

So you can send your code directly there from any view.
