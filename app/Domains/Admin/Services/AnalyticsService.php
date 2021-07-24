<?php
namespace App\Domains\Admin\Services;

use App\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class AnalyticsService
{
    /** @var Carbon */
    protected $start;

    /** @var Carbon */
    protected $end;

    /** @var Builder */
    protected $builder;

    public function __construct(Carbon $start, Carbon $end)
    {
        $this->start = $start;
        $this->end = $end;

        $this->builder = Order::confirmed()
            ->with('quick_sales')
            ->where('confirmed_at', '>=', $this->start)
            ->where('confirmed_at', '<=', $this->end);
    }

    public function count() : int
    {
        return $this->builder->count();
    }

    public function total() : float
    {
        return $this->builder->sum('final_total');
    }

    public function mean() : float
    {
        if ($this->count() === 0) {
            return 0;
        }

        return number_format($this->total() / $this->count(), 2);
    }

    public function table() : array
    {
        $orders = $this
            ->builder
            ->get()
            ->mapToGroups(function (Order $order) {
                return [
                    $order->getDescription() => $order->final_total,
                ];
            });

        return array_values($orders->map(function ($item, $key) {
            return [
                'key'   => $key,
                'count' => count($item),
                'sum'   => number_format($item->sum(), 2),
            ];
        })->toArray());
    }
}
