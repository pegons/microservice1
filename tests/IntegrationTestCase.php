<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IntegrationTestCase extends TestCase
{
    /*
	 * According to the documentation use RefreshDatabase;
	 * not compatible with the library at the moment.
	 *
	 * https://github.com/jenssegers/laravel-mongodb#testing
	 */
    use RefreshDatabase;
    use WithoutMiddleware;
}
