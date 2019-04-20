<?php
namespace Tests\Feature\Controllers;

use App\Certificate;
use App\Course;
use App\User;
use App\UserCertificate;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CertificateControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @var Certificate */
    protected $certificate;

    /** @var User */
    protected $user;

    /** @var Course */
    protected $course;

    protected function setUp()
    {
        parent::setUp();

        $this->course = factory(Course::class)->create();
        $this->certificate = factory(Certificate::class)
            ->create([
                'course_id' => $this->course->id,
            ]);

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function user_can_access_his_certificate()
    {
        // Given
        $userCertificate = UserCertificate::create([
            'user_id'        => $this->user->id,
            'certificate_id' => $this->certificate->id,
            'course_id'      => $this->course->id,
        ]);

        // When
        $result = $this->user->can('view', $userCertificate);

        // Then
        $this->assertTrue($result);
    }

    /** @test */
    public function user_cannot_access_not_his_certificate()
    {
        // Given
        $userCertificate = UserCertificate::create([
            'user_id'        => $this->user->id,
            'certificate_id' => $this->certificate->id,
            'course_id'      => $this->course->id,
        ]);

        $otherUser = factory(User::class)->create();

        // When
        $result = $otherUser->can('view', $userCertificate);

        // Then
        $this->assertFalse($result);
    }

    /** @test */
    public function user_can_view_download_endpoint_of_his_certificate()
    {
        // Given
        $userCertificate = UserCertificate::create([
            'user_id'        => $this->user->id,
            'certificate_id' => $this->certificate->id,
            'course_id'      => $this->course->id,
        ]);

        // When
        $response = $this
            ->actingAs($this->user)
            ->get($userCertificate->getDownloadUrl());

        // Then
        $response->assertStatus(200);
    }

    /** @test */
    public function user_cannot_view_download_endpoint_of_someones_else_certificate()
    {
        // Given
        $userCertificate = UserCertificate::create([
            'user_id'        => $this->user->id,
            'certificate_id' => $this->certificate->id,
            'course_id'      => $this->course->id,
        ]);

        $otherUser = factory(User::class)->create();

        // When
        $response = $this
            ->actingAs($otherUser)
            ->get($userCertificate->getDownloadUrl());

        // Then
        $response->assertStatus(403);
    }
}