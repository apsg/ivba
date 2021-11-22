<?php
namespace App;

use App\Helpers\VimeoHelper;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * App\Video.
 *
 * @property int         $id
 * @property string      $filename
 * @property string      $hash
 * @property string      $url
 * @property string      $thumb
 * @property string|null $embed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Video extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        /**
         * Usuń fizyczny plik związany z tym filmem.
         */
        static::deleting(function ($model) {
            Vimeo::request('/videos/' . $model->hash, [], 'DELETE');
        });
    }

    /**
     * Zwróć link do miniatury o podanych wymiarach.
     * @param int $width szerokość
     * @param int $height wysokość
     * @return [string]          url do pliku
     */
    public function thumb($width = 200, $height = 200)
    {
        if (empty($this->thumb)) {
            $this->getThumbId();
        }

        $size = VimeoHelper::getThumbSize($width);

        return 'https://i.vimeocdn.com/video/'
            . $this->thumb . '_' . implode('x', $size)
            . '.jpg?r=pad';
    }

    /**
     * Pobierz na nowo id dla miniatur.
     * @return [type] [description]
     */
    public function getThumbId()
    {
        $this->thumb = VimeoHelper::getThumb($this->hash);
        $this->save();
    }

    /**
     * Wyślij nowy plik.
     * @param  [type] $path [description]
     * @return [type]       [description]
     */
    public static function upload($filePath, $filename, $title = null)
    {
        return self::create(VimeoHelper::uploadVideo($filePath, $filename, $title));
    }

    /**
     * Wygeneruj kod do zagnieżdżania filmu.
     * @param int $width [description]
     * @param int $height [description]
     * @return [type]          [description]
     */
    public function embed($width = 400, $height = 300)
    {
        return str_replace([
            'width="400"',
            'height="300"',
        ], [
            'width="' . $width . '"',
            'height="' . $height . '"',
        ], $this->embed);
    }

    public function embedSrc() : string
    {
        $result = '';
        preg_match('/src=["\']+(.*?)["\']+/i', $this->embed, $result);

        if (!empty($result)) {
            return $result[1];
        }

        return '';
    }
}
