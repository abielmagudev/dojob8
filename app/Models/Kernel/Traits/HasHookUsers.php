<?php

namespace App\Models\Kernel\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait HasHookUsers
{
    // Validators

    public function hasCreator()
    {
        return ! empty($this->created_by) && is_a($this->creator, User::class);
    }

    public function hasUpdater()
    {
        return ! empty($this->updated_by) && is_a($this->updater, User::class);
    }

    public function hasDeleter()
    {
        return ! empty($this->deleted_by) && is_a($this->deleter, User::class);
    }


    // Relationships

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }


    // Update from Observers

    public function updateCreator()
    {
        self::where('id', $this->id)->update([
            'created_by' => Auth::id(),
        ]);
    }

    public function updateUpdater()
    {
        return self::where('id', $this->id)->update([
            'updated_by' => Auth::id(),
        ]);
    }

    public function updateDeleter()
    {
        return self::where('id', $this->id)->update([
            'deleted_by' => Auth::id(),
        ]);
    }

    public function updateCreatorUpdater()
    {
        return self::where('id', $this->id)->update([
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
    }
}
