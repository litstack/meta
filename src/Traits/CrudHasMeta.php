<?php

namespace Litstack\Meta\Traits;

use Ignite\Crud\Config\CrudConfig;
use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudUpdate;
use Litstack\Meta\Models\Meta;

trait CrudHasMeta
{
    protected function meta(CrudShow | CrudUpdate $page)
    {
        $page->card(function ($form) {
            if ($form instanceof CrudConfig) {
                $relation = $form->relation('meta');
            } else {
                $relation = $form->oneRelation('meta')->model(Meta::class);
            }

            $relation->title('Meta')
                ->preview(function ($preview) {
                    $preview->col(fa('info').' Edit Meta Fields');
                })
                ->createAndUpdateForm(function ($form) {
                    $form->input('title')->title('Meta-Title')->hint('Ein Title sollte maximal 524 Pixel lang sein. Das entspricht in etwa 58-65 Zeichen. Eine Description sollte mindestens ca. 100 Zeichen und maximal ca. 145 Zeichen lang sein.')->max(256);
                    $form->input('description')->title('Meta-Description')->hint('Eine Description sollte mindestens ca. 100 Zeichen und maximal ca. 145 Zeichen lang sein. Ist eine Description kürzer als ca. 100 Zeichen, wird sie wahrscheinlich nur als eine Zeile dargestellt. Dadurch verlierst Du Platz und Aufmerksamkeit.')->max(256);
                    $form->textarea('keywords')->title('Meta-Keywords')->hint('Kommaseparierte Schlagwortliste');
                    // $form->image('image')->crop(1200 / 630)->expand()->title('OG Image')->hint('Vorschaubild für Facebook und Twitter verlinkungen. Damit ein Bild in der Facebook-Vorschau auch auf hochauflösenden Geräten optimal zur Geltung kommt, sollte es mindestens 1.200 x 630 Pixel groß und im Format 1,91:1 angelegt sein.')->maxFiles(1);
                    $form->component('lit-meta');
                });
        });
    }
}
