<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Feedback;

class FeedbackFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_feedback_page()
    {
        $response = $this->get('/feedback');

        $response->assertStatus(200);
        $response->assertSee('System Evaluation Form');
        $response->assertSee('A. Effectiveness');
        $response->assertSee('F. Flexibility');
    }

    public function test_can_submit_valid_feedback()
    {
        $response = $this->post('/feedback', [
            'effectiveness' => 5,
            'efficiency' => 4,
            'satisfaction_usefulness' => 5,
            'satisfaction_trust' => 4,
            'satisfaction_pleasure' => 3,
            'satisfaction_comfort' => 5,
            'risk_economic' => 4,
            'risk_health_safety' => 5,
            'risk_environmental' => 4,
            'context_coverage' => 4,
            'flexibility' => 5,
            'comments' => 'Great system!',
        ]);

        $response->assertRedirect('/feedback');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('feedbacks', [
            'effectiveness' => 5,
            'efficiency' => 4,
            'satisfaction_usefulness' => 5,
            'satisfaction_trust' => 4,
            'satisfaction_pleasure' => 3,
            'satisfaction_comfort' => 5,
            'risk_economic' => 4,
            'risk_health_safety' => 5,
            'risk_environmental' => 4,
            'context_coverage' => 4,
            'flexibility' => 5,
            'comments' => 'Great system!',
        ]);
    }

    public function test_cannot_submit_invalid_feedback()
    {
        $response = $this->post('/feedback', [
            'effectiveness' => 6, // invalid, must be 1-5
            'efficiency' => 'invalid',
        ]);

        $response->assertSessionHasErrors(['effectiveness', 'efficiency', 'satisfaction', 'freedom_from_risk', 'context_coverage', 'flexibility']);
    }
}
