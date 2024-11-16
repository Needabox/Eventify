<?php

namespace App\Filament\Resources\BlogResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika user adalah admin (misalnya role_id 1), set status menjadi 2 (Approved)
        // Selain itu, set status menjadi 1 (Pending)
        $data['status'] = Auth::user()->id === 1 ? 2 : 1;

        // Set user_id ke ID pengguna yang sedang login
        $data['user_id'] = Auth::id();

        return $data;
    }
}
