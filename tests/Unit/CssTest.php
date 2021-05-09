<?php

namespace Daguilarm\BelichTables\Tests\Unit;

use Daguilarm\BelichTables\Tests\TestCase;
use Illuminate\Support\Facades\Blade;

// test --filter=CssTest
class CssTest extends TestCase
{
    // test --filter=test_blade_directive_css
    public function test_blade_directive_css(): void
    {
        $blade = Blade::compileString('@belichTablesCss');
        $expected = '<style>/*Belich Tables Css*/.pulse-vertical-align{top:30%}.pulse{width:80px;height:80px;position:fixed;left:50%;margin-left:-50px;top:50%;margin-top:-50px;}.double-bounce1,.double-bounce2{width:100%;height:100%;border-radius:50%;background-color:'.config('belich-tables.loadingColor').';opacity:.6;position:absolute;top:0;left:0;-webkit-animation:sk-bounce 2s infinite ease-in-out;animation:sk-bounce 2s infinite ease-in-out}.double-bounce2{-webkit-animation-delay:-1s;animation-delay:-1s}@-webkit-keyframes sk-bounce{0%,100%{-webkit-transform:scale(0)}50%{-webkit-transform:scale(1)}}@keyframes sk-bounce{0%,100%{transform:scale(0);-webkit-transform:scale(0)}50%{transform:scale(1);-webkit-transform:scale(1)}}[x-cloak]{display:none;}</style>';
        // Solving rendering errors
        $expectedFilter = str_replace(['@keyframes sk-bounce'], ['@keyframes  sk-bounce'], $expected);

        $this->assertEquals($expectedFilter, Blade::compileString($blade));
    }
}
