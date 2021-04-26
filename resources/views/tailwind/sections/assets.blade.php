<!-- Css classes -->
<style>
    .pulse-vertical-align{top:30%}.pulse{width:80px;height:80px;position:fixed;left:50%;margin-left:-50px;top:50%;margin-top:-50px;}.double-bounce1,.double-bounce2{width:100%;height:100%;border-radius:50%;background-color:{{ belichConfig('belich.tables.loading.color', 'belich-tables.loadingColor') }};opacity:.6;position:absolute;top:0;left:0;-webkit-animation:sk-bounce 2s infinite ease-in-out;animation:sk-bounce 2s infinite ease-in-out}.double-bounce2{-webkit-animation-delay:-1s;animation-delay:-1s}@-webkit-keyframes sk-bounce{0%,100%{-webkit-transform:scale(0)}50%{-webkit-transform:scale(1)}}@keyframes sk-bounce{0%,100%{transform:scale(0);-webkit-transform:scale(0)}50%{transform:scale(1);-webkit-transform:scale(1)}}
    [x-cloak]{display:none;}
</style>

<!-- Css if needed -->
@stack('belich-css')

<!-- Javascript if needed -->
@stack('belich-javascript')
