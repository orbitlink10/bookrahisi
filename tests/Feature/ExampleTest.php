<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_homepage_renders_book_rahisi_content(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSeeText('Book your next self-care session')
            ->assertSeeText('Daily Deals')
            ->assertSeeText('Find a Service in a City Near You')
            ->assertSeeText('For Business');
    }
}
