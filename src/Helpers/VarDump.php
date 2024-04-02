<?php

namespace Thejenos\Laradump\Helpers;

use Symfony\Component\VarDumper\Caster\ReflectionCaster;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class VarDump
{
    public static function customDumper($data)
    {
        $cloner = new VarCloner();
        $cloner->addCasters(ReflectionCaster::UNSET_CLOSURE_FILE_INFO);
        $dumper = new HtmlDumper();
        $dumper->setTheme('light');

        return $dumper->dump($cloner->cloneVar($data), true);
    }
}
