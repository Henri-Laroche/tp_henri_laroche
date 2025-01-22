<?php

namespace Tests\Feature;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ShortLinkControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_dashboard_with_user_links()
    {
        $user = User::factory()->create();
        ShortLink::factory()->count(5)->create(['users_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertStatus(200)
            ->assertViewIs('dashboard')
            ->assertViewHas('shortLinks');
    }

    /** @test */
    public function it_creates_a_new_short_link()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('short-links.store'), [
                'original_url' => 'https://example.com',
            ])
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('short_links', [
            'users_id' => $user->id,
            'original_url' => 'https://example.com',
        ]);
    }

    /** @test */
    public function it_fails_to_create_short_link_without_authentication()
    {
        $this->post(route('short-links.store'), [
            'original_url' => 'https://example.com',
        ])->assertRedirect(route('login'));
    }

    /** @test */
    public function it_deletes_a_short_link()
    {
        $user = User::factory()->create();
        $link = ShortLink::factory()->create(['users_id' => $user->id]);

        $this->actingAs($user)
            ->delete(route('short-links.destroy', $link->id))
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('short_links', ['id' => $link->id]);
    }

    /** @test */
    public function it_redirects_to_original_url()
    {
        $link = ShortLink::factory()->create(['short_url' => 'abc123', 'original_url' => 'https://example.com']);

        $this->get('/' . $link->short_url)
            ->assertRedirect($link->original_url);

        $this->assertEquals(1, $link->fresh()->click_count);
    }

    /** @test */
    public function it_returns_404_if_short_url_not_found()
    {
        $this->get('/nonexistent')
            ->assertStatus(302)
            ->assertViewIs('redirect.redirect');
    }
}
