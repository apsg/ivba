<?php

namespace Tests\Feature\Integrations;

use App\Http\Middleware\EncryptCookies;
use App\Services\PartnerProgramService;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Cookie;
use Tests\TestCase;

class PartnerProgramTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    use InteractsWithDatabase;

    /** @var User */
    public $user;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = factory(User::class)->create();
        $this->withoutMiddleware(EncryptCookies::class);
    }

    /** @test */
    public function user_has_not_empty_partner_key()
    {
        // given user

        // when
        $key = $this->user->partner_uniqid;
        $secondKey = $this->user->fresh()->partner_uniqid;

        // then
        $this->assertNotEmpty($key);
        $this->assertGreaterThan(1, strlen($key));
        $this->assertEquals($key, $secondKey);
    }

    /** @test */
    public function user_has_partner_program_link()
    {
        // given user

        // when
        $link = $this->user->partnerLink();

        // then
        $this->assertNotEmpty($link);
        $this->assertNotEquals(url('/p'), $link);
        $this->assertGreaterThan(strlen(url('/p')), strlen($link));
    }

    /** @test */
    public function visiting_partner_link_sets_cookies_and_redirects_to_homepage()
    {
        // given
        $url = $this->user->partnerLink();

        // when
        $response = $this->get($url);

        /** @var Cookie $cookie */
        $cookie = collect($response->headers->getCookies())
            ->filter(function (Cookie $cookie) {
                return $cookie->getName() === 'partner_id';
            })
            ->first();

        // then
        $response->assertStatus(302);

        $response->assertCookie('partner_id');

        $this->assertIsObject($cookie);
        $this->assertEquals($this->user->partner_key, $cookie->getValue());
    }

    /**
     * @test
     * @group slow
     */
    public function it_correctly_sets_partner_id_when_user_registers()
    {
        // given
        $cookie = cookie()->forever('partner_id', $this->user->partner_uniqid);
        $email = $this->faker->email;
        $password = $this->faker->password(8);

        \NoCaptcha::shouldReceive('verifyResponse')
            ->once()
            ->andReturn(true);

        // when
        $response = $this->call('post', url('/register'), [
            'name'                  => $this->faker->name,
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $password,
            'rules'                 => true,
            'g-recaptcha-response'  => 1,
        ], [$cookie]);

        // then
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('users', [
            'email'      => $email,
            'partner_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function it_returns_correct_data_in_partner_program_service()
    {
        // given
        $partner1 = factory(User::class)->create();
        $partner2 = factory(User::class)->create();

        $user1 = factory(User::class)->create([
            'partner_id' => $partner1->id,
        ]);
        $user2 = factory(User::class)->create([
            'partner_id' => $partner1->id,
        ]);
        $user3 = factory(User::class)->create([
            'partner_id' => $partner2->id,
        ]);
        $user4 = factory(User::class)->create([
            'partner_id' => $partner2->id,
        ]);
        $user5 = factory(User::class)->create([
            'partner_id' => $partner2->id,
        ]);
        $user5->created_at = Carbon::now()->subMonths(3);
        $user5->save();

        // when
        /** @var Collection $data */
        $data = app(PartnerProgramService::class)->all();
        $dataPartner1 = $data->where('id', '=', $partner1->id)->first();
        $dataPartner2 = $data->where('id', '=', $partner2->id)->first();

        // then
        $this->assertNotNull($dataPartner1);
        $this->assertNotNull($dataPartner2);

        $this->assertEquals(2, $dataPartner1->refs_month);
        $this->assertEquals(2, $dataPartner1->refs_year);

        $this->assertEquals(2, $dataPartner2->refs_month);
        $this->assertEquals(3, $dataPartner2->refs_year);
    }
}
