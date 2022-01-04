<?php

namespace Tests;

class UnitTestCase extends TestCase
{
    use WithoutDatabase;

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        parent::setUpTraits();
        $this->withoutDatabase();
    }
}
