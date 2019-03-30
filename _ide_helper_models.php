<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Page
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

namespace App{
/**
 * Class Subscription
 *
 * @property int                       user_id
 * @property int                       coupon_id
 * @property string                    profileid
 * @property bool                      is_active
 * @property Carbon                    cancelled_at
 * @property int                       tries
 * @property float                     amount
 * @property-read Carbon              valid_until
 * @property-read User                 user
 * @property-read Coupon               coupon
 * @property-read Collection|Payment[] payments
 * @method-static Builder|Subscription active()
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $valid_until
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $cancelled_at
 * @property int $tries
 * @property string|null $token
 * @property float $amount
 * @property int|null $coupon_id
 * @property-read \App\Coupon|null $coupon
 * @property-read mixed $final_total
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereTries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereValidUntil($value)
 */
	class Subscription extends \Eloquent {}
}

namespace App{
/**
 * App\Video
 *
 * @property int $id
 * @property string $filename
 * @property string $hash
 * @property string $url
 * @property string $thumb
 * @property string|null $embed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereEmbed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereUrl($value)
 */
	class Video extends \Eloquent {}
}

namespace App{
/**
 * App\Question
 *
 * @property int $id
 * @property int $quiz_id
 * @property int $type
 * @property string $title
 * @property string $content
 * @property int $points
 * @property int $position
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \[type] $type_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\QuestionOption[] $options
 * @property-read \App\Quiz $quiz
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereUpdatedAt($value)
 */
	class Question extends \Eloquent {}
}

namespace App{
/**
 * App\Item
 *
 * @property int $lesson_id
 * @property int $items_id
 * @property string $items_type
 * @property int $position
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Lesson[] $lesson
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereItemsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereItemsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item wherePosition($value)
 */
	class Item extends \Eloquent {}
}

namespace App{
/**
 * App\Course
 *
 * @property int $id
 * @property string $slug
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property float $price
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int|null $image_id
 * @property int $difficulty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $video_id
 * @property int $position
 * @property int $delay Liczba dni
 * @property int $cumulative_delay
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Access[] $access
 * @property-read \App\Certificate $certificate
 * @property-read mixed $avg_rating
 * @property-read mixed $duration
 * @property-read mixed $excerpt
 * @property-read mixed $rating
 * @property-read mixed $ratings_count
 * @property-read mixed $real_delay
 * @property-read \[type] $user_certificate
 * @property-read \[type] $users_count
 * @property-read \App\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Lesson[] $lessons
 * @property-read \App\Video $movie
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Quiz[] $quizzes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Rating[] $ratings
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserCertificate[] $user_certificates
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \App\Video|null $video
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCumulativeDelay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDelay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereVideoId($value)
 */
	class Course extends \Eloquent {}
}

namespace App{
/**
 * Class Payment
 *
 * @property string            subscription_id
 * @property string            title
 * @property float             amount
 * @property string            external_id
 * @property Carbon            cancelled_at
 * @property Carbon            confirmed_at
 * @property bool              is_recurrent
 * @property string|null       cancel_reason
 * @property-read Subscription subscription
 * @property-read string       reason
 * @method Builder|Payment forUser(User $user)
 * @method Builder|Payment confirmed()
 * @property int $id
 * @property int $subscription_id
 * @property string $title
 * @property float $amount
 * @property string|null $external_id
 * @property \Illuminate\Support\Carbon|null $confirmed_at
 * @property \Illuminate\Support\Carbon|null $cancelled_at
 * @property string|null $cancel_reason
 * @property int $is_recurrent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $reason
 * @property-read \App\Subscription $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereIsRecurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App{
/**
 * App\Answer
 *
 * @property int $id
 * @property int $user_id
 * @property int $question_id
 * @property array $answer
 * @property int $is_correct
 * @property int $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Question $question
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereIsCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereUserId($value)
 */
	class Answer extends \Eloquent {}
}

namespace App{
/**
 * App\Email
 *
 * @property int $id
 * @property string $from
 * @property int $to_id
 * @property string $to_type
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon $send_at
 * @property int $is_sent
 * @property int $type
 * @property string|null $attachment
 * @property string|null $unsubscribe_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $newsletter_id
 * @property \Illuminate\Support\Carbon|null $opened_at
 * @property \Illuminate\Support\Carbon|null $clicked_at
 * @property \Illuminate\Support\Carbon|null $unsubscribed_at
 * @property-read \App\Newsletter|null $newsletter
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $to
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email due()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email planned()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereClickedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereIsSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereNewsletterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereOpenedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereToType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUnsubscribeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUnsubscribedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUpdatedAt($value)
 */
	class Email extends \Eloquent {}
}

namespace App{
/**
 * Class QuestionOption
 *
 * @package App
 * @property bool          is_correct
 * @property-read Question question
 * @method Builder|QuestionOption correct()
 * @property int $id
 * @property int $question_id
 * @property string $title
 * @property int $is_correct
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereIsCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionOption whereUpdatedAt($value)
 */
	class QuestionOption extends \Eloquent {}
}

namespace App{
/**
 * Class Order
 *
 * @package App
 * @property string|null external_payment_id
 * @property Carbon      confirmed_at
 * @property int         duration
 * @property-read User   user
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $confirmed_at
 * @property int $is_full_access
 * @property string|null $external_payment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $final_total
 * @property float|null $price
 * @property int|null $duration
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Coupon[] $coupons
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order confirmed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereExternalPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereFinalTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereIsFullAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App{
/**
 * Class AccessDay
 *
 * @package App
 * @property int       user_id
 * @property Carbon    date
 * @property-read User user
 * @method Builder|AccessDay current()
 * @method Builder|AccessDay past()
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccessDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccessDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccessDay query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccessDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccessDay whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccessDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccessDay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccessDay whereUserId($value)
 */
	class AccessDay extends \Eloquent {}
}

namespace App{
/**
 * Class Proof
 *
 * @package App
 * @property string      name
 * @property string|null city
 * @property string      body
 * @property bool        is_registered
 * @property string      url
 * @property int         user_id
 * @property Carbon      created_at
 * @property Carbon      updated_at
 * @property int $id
 * @property string $name
 * @property string|null $city
 * @property string|null $url
 * @property string $body
 * @property int $is_registered
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereIsRegistered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proof whereUserId($value)
 */
	class Proof extends \Eloquent {}
}

namespace App{
/**
 * App\ItemImage
 *
 * @property int $id
 * @property string $title
 * @property int $image_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Image $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Lesson[] $lesson
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemImage whereUpdatedAt($value)
 */
	class ItemImage extends \Eloquent {}
}

namespace App{
/**
 * App\NewsletterSubscriber
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Email[] $emails
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\NewsletterSubscriber onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsletterSubscriber whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewsletterSubscriber withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\NewsletterSubscriber withoutTrashed()
 */
	class NewsletterSubscriber extends \Eloquent {}
}

namespace App{
/**
 * App\Quiz
 *
 * @property int $id
 * @property int $course_id
 * @property string $name
 * @property int $is_certified
 * @property int $is_random
 * @property int $pass_threshold
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Course $course
 * @property-read mixed $max_points
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereIsCertified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereIsRandom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz wherePassThreshold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Quiz whereUpdatedAt($value)
 */
	class Quiz extends \Eloquent {}
}

namespace App{
/**
 * App\Access
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $accessable_type
 * @property int|null $accessable_id
 * @property \Illuminate\Support\Carbon $expires
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $accessable
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access valid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereAccessableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereAccessableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereUserId($value)
 */
	class Access extends \Eloquent {}
}

namespace App{
/**
 * App\UserCertificate
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $certificate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Certificate $certificate
 * @property-read \App\Course $course
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereCertificateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCertificate whereUserId($value)
 */
	class UserCertificate extends \Eloquent {}
}

namespace App{
/**
 * App\FullAccessOption
 *
 * @property int $id
 * @property int $duration
 * @property float $price
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FullAccessOption whereUpdatedAt($value)
 */
	class FullAccessOption extends \Eloquent {}
}

namespace App{
/**
 * Class Point
 *
 * @package App
 * @property int       user_id
 * @property int       points
 * @property Carbon    created_at
 * @property Carbon    updated_at
 * @property-read User user
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point query()
 */
	class Point extends \Eloquent {}
}

namespace App{
/**
 * App\Image
 *
 * @property int $id
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $filename
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUrl($value)
 */
	class Image extends \Eloquent {}
}

namespace App{
/**
 * App\Script
 *
 * @property int $id
 * @property string $title
 * @property string $script
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereScript($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Script whereUpdatedAt($value)
 */
	class Script extends \Eloquent {}
}

namespace App{
/**
 * App\Followup
 *
 * @property int $id
 * @property int $followup_content_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $send_at
 * @property int $is_sent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\FollowupContent $followupContent
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereFollowupContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereIsSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Followup whereUserId($value)
 */
	class Followup extends \Eloquent {}
}

namespace App{
/**
 * App\Certificate
 *
 * @property int $id
 * @property int $course_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Certificate whereUpdatedAt($value)
 */
	class Certificate extends \Eloquent {}
}

namespace App{
/**
 * App\Newsletter
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property \Illuminate\Support\Carbon $send_at
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Email[] $emails
 * @property-read \[type] $clicked
 * @property-read \[type] $opened
 * @property-read \[type] $unsubscribed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter due()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereUpdatedAt($value)
 */
	class Newsletter extends \Eloquent {}
}

namespace App{
/**
 * App\MenuItem
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property int $is_new_window
 * @property int $menu_id
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereIsNewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereUrl($value)
 */
	class MenuItem extends \Eloquent {}
}

namespace App{
/**
 * App\ItemText
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Lesson[] $lesson
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemText whereUpdatedAt($value)
 */
	class ItemText extends \Eloquent {}
}

namespace App{
/**
 * App\Rating
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Course $course
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereUserId($value)
 */
	class Rating extends \Eloquent {}
}

namespace App{
/**
 * App\FollowupContent
 *
 * @property int $id
 * @property string $event
 * @property string $delay
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Followup[] $followups
 * @property-read mixed $interval
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereDelay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FollowupContent whereUpdatedAt($value)
 */
	class FollowupContent extends \Eloquent {}
}

namespace App{
/**
 * App\ItemFile
 *
 * @property int $id
 * @property string $title
 * @property string $path
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $hash
 * @property int $host
 * @property string|null $size
 * @property string $name
 * @property string $mime
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Lesson[] $lesson
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemFile whereUpdatedAt($value)
 */
	class ItemFile extends \Eloquent {}
}

namespace App{
/**
 * App\ItemMovie
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $video_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Lesson[] $lesson
 * @property-read \App\Video $video
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItemMovie whereVideoId($value)
 */
	class ItemMovie extends \Eloquent {}
}

namespace App{
/**
 * App\Option
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereValue($value)
 */
	class Option extends \Eloquent {}
}

namespace App{
/**
 * Class User
 *
 * @property string                   name
 * @property string                   email
 * @property string                   password
 * @property-read Carbon              full_access_expires
 * @property Carbon                   last_proof_at
 * @property integer                  last_proof_id
 * @property integer                  days_bought
 * @property Carbon                   expires_at
 * @property string                   card_token
 * @property Carbon                   changed_password_at
 * @property Carbon                   unsubscribed_at
 * @property string                   first_name
 * @property string                   last_name
 * @property string                   address
 * @property-read string              full_name
 * @property-read HasOne|Subscription subscription
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $isadmin
 * @property \Illuminate\Support\Carbon|null $full_access_expires
 * @property \Illuminate\Support\Carbon|null $unsubscribed_at
 * @property int|null $last_proof_id
 * @property \Illuminate\Support\Carbon|null $last_proof_at
 * @property int $days_bought
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property string|null $card_token
 * @property \Illuminate\Support\Carbon $changed_password_at
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Answer[] $answers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Course[] $courses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AccessDay[] $days
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Email[] $emails
 * @property-read mixed $current_day
 * @property-read mixed $full_name
 * @property-read mixed $remaining_days
 * @property-read \App\Proof|null $last_proof
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Lesson[] $lessons
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Quiz[] $quizzes
 * @property-read \App\Subscription $subscription
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Subscription[] $subscriptions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User followups()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereChangedPasswordAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDaysBought($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFullAccessExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsadmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastProofAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastProofId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUnsubscribedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * Class Lesson
 *
 * @property string                   title
 * @property string                   description
 * @property string                   seo_title
 * @property string                   seo_description
 * @property float                    price
 * @property int                      difficulty
 * @property string                   slug
 * @property int                      image_id
 * @property int                      video_id
 * @property int                      user_id
 * @property string                   introduction
 * @property int                      duration
 * @property-read Image               image
 * @property-read Video               video
 * @property-read Collection|Course[] courses
 * @property int $id
 * @property int $user_id
 * @property string $slug
 * @property string $title
 * @property string $introduction
 * @property string $description
 * @property float $price
 * @property int $duration
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int|null $image_id
 * @property int $difficulty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $video_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Course[] $courses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ItemFile[] $files
 * @property-read \App\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ItemImage[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ItemText[] $texts
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \App\Video|null $video
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ItemMovie[] $videos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson except($id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Lesson whereVideoId($value)
 */
	class Lesson extends \Eloquent {}
}

namespace App{
/**
 * Class Coupon
 *
 * @package App
 * @property string      code
 * @property int         uses_left
 * @property int         type
 * @property-read string type_text
 * @property int $id
 * @property string $code
 * @property int $type
 * @property float $amount
 * @property int $uses_left
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $type_text
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereUsesLeft($value)
 */
	class Coupon extends \Eloquent {}
}

