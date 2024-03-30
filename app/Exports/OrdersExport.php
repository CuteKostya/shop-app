<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromQuery, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\LaravelIdea\Helper\App\Models\_IH_Order_QB
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Order::query()->where('user_id', $this->id);
    }

    public function headings(): array
    {
        return [
            'Order_id',
            'User_id',
            'create_at',
            'update_at',
        ];
    }
}
