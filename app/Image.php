<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use ImageHelper;
use Intervention\Image\Exception\NotReadableException;
use Throwable;

/**
 * App\Image.
 *
 * @property int $id
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $filename
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereFilename($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @method static Builder|Image whereUrl($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    protected $fillable = ['url', 'hash', 'filename'];

    /**
     * Podaj URL do miniaturki o zadanym rozmiarze.
     * @param  int $width [description]
     * @param  int $height [description]
     * @return [type]          [description]
     */
    public function thumb($width = 200, $height = 200)
    {
        // return str_replace(".bin", ".jpg", $this->url)."?image_crop_resized=".$width."x".$height;
        $filename = pathinfo($this->path(), PATHINFO_FILENAME);
        $extension = pathinfo($this->path(), PATHINFO_EXTENSION);

        $thumb = $filename . '_' . $width . 'x' . $height . '.' . $extension;

        if (file_exists(storage_path('app/public/images/' . $thumb))) {
            return url('storage/images/' . $thumb);
        } else {
            return $this->makeThumb($width, $height);
        }
    }

    /**
     * Wygeneruj miniaturę o podanych wymiarach.
     * @param  int $width [description]
     * @param  int $height [description]
     * @return [type]          [description]
     */
    public function makeThumb($width = 200, $height = 200)
    {
        $filename = pathinfo($this->path(), PATHINFO_FILENAME);
        $extension = pathinfo($this->path(), PATHINFO_EXTENSION);
        $thumb = $filename . '_' . $width . 'x' . $height . '.' . $extension;

        try {
            if (! file_exists(storage_path('app/public/images/' . $thumb))) {
                $img = ImageHelper::make($this->path());
                $img->fit($width, $height);
                $img->save(storage_path('app/public/images/' . $thumb));
            }

            return url('storage/images/' . $thumb);
        } catch (NotReadableException $exception) {
            return $this->placeholder();
        } catch (Throwable $exception) {
            return $this->placeholder();
        }
    }

    /**
     * Ścieżka do pliku.
     * @return [type] [description]
     */
    public function path()
    {
        return storage_path('app/public/images/' . $this->filename);
    }

    protected function placeholder()
    {
        return 'data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22600%22%20height%3D%22300%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16823f6019d%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16823f6019d%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22106.3984375%22%20y%3D%2296.3%22%3E' . config('app.name') . '%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E';
    }
}
