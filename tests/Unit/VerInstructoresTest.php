<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class VerInstructoresTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_see_instructors_list()
    {
        $response = $this->get('/instructores/index');
        $response->assertSeeText("Lista de Instructores");
        $response->assertStatus(200);
    }
}
