<?php

use Illuminate\Support\Debug\Dumper;
use Symfony\Component\VarDumper\VarDumper;

/*
 * Pour que le rendu HTML du dumper de Symfony (symfony/var-dumper) soit aux
 * couleurs de Laravel.
 */
VarDumper::setHandler(function($var) {
    (new Dumper)->dump($var);
});
