<?php

namespace App\Filament\Resources\EventResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika user adalah admin (misalnya role_id 1), set status menjadi 2 (Approved)
        // Selain itu, set status menjadi 1 (Pending)
        $data['status'] = Auth::user()->id === 1 ? 2 : 1;

        // Set user_id ke ID pengguna yang sedang login
        $data['user_id'] = Auth::id();

        // dd($data);

        return $data;
    }
}
