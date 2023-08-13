<?php
namespace App\Domains\Admin;

use App\MenuItem;

class MenuRepository
{
    public function update(int $id, int $position, int $parentId = null): MenuItem
    {
        $menuItem = MenuItem::findOrFail($id);

        $menuItem->update([
            'position'  => $position,
            'parent_id' => $parentId
        ]);

        return $menuItem;
    }
}
