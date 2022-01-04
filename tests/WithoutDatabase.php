<?php

namespace Tests;

trait WithoutDatabase
{
    public function withoutDatabase()
    {
        // Force not using database connection on unit tests
        config(['database.default' => 'foobar']);
    }
}
