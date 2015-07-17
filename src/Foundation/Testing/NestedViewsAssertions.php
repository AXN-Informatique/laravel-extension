<?php

namespace Axn\Illuminate\Foundation\Testing;

trait NestedViewsAssertions
{
    /**
     * Variables des vues imbriquées.
     *
     * @var array
     */
    protected $nestedViewsData = [];

    /**
     * Enregistre une vue imbriquée dans le composeur de vues.
     *
     * À utiliser lors de tests sur les contrôleurs si ceux-ci appellent une vue
     * qui imbrique d'autres vues (ex : layout).
     *
     * Permet d'utiliser les méthode assertNestedViewHas et assertNestedViewHasAll.
     *
     * @param  string $viewName
     * @return void
     */
    public function registerNestedView($viewName)
    {
        $this->app['view']->composer($viewName, function($view) {
            $this->nestedViewsData[$view->getName()] = $view->getData();
        });
    }

    /**
     * Vérifie si la vue imbriquée contient une certaine variable.
     *
     * @param  string       $viewName
     * @param  string|array $key
     * @param  mixed        $value
     * @return void
     */
    public function assertNestedViewHas($viewName, $key, $value = null)
    {
        if (is_array($key)) {
            $this->assertNestedViewHasAll($viewName, $key);
        }
        elseif (!isset($this->nestedViewsData[$viewName])) {
            $this->assertTrue(false, 'The view was not called.');
        }
        else {
            $data = $this->nestedViewsData[$viewName];

            if (is_null($value)) {
                $this->assertArrayHasKey($key, $data);
            }
            elseif (isset($data[$key])) {
                $this->assertEquals($value, $data[$key]);
            }
            else {
                $this->assertTrue(false, 'The view has no bound data with this key.');
            }
        }
    }

    /**
     * Vérifie si la vue contient une certaine liste de variables.
     *
     * @param  string $viewName
     * @param  array  $data
     * @return void
     */
    public function assertNestedViewHasAll($viewName, array $data)
    {
        foreach ($data as $key => $value) {
            if (is_int($key)) {
                $this->assertNestedViewHas($viewName, $value);
            } else {
                $this->assertNestedViewHas($viewName, $key, $value);
            }
        }
    }

    /**
     * Vérifie si la vue est enregistrée en tant que vue imbriquée.
     *
     * @param  string $viewName
     * @return void
     */
    public function assertIsNestedView($viewName)
    {
        $this->assertArrayHasKey($viewName, $this->nestedViewsData);
    }
}
