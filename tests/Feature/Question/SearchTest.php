<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should br able to search a question by text', function () {
    $user = User::factory()->create();
    Question::factory()->create(['question' => 'Somethin else?']);
    Question::factory()->create(['question' => 'My question is?']);

    actingAs($user);

    $response = get(route('dashboard', ['search' => 'question']));

    $response->assertDontSee('Somethin else?');
    $response->assertSee('My question is?');
});
