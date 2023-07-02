<?php

namespace App\Services;

use App\Models\Share;

class ShareService
{
    public function create(int $userIdShared, string $access): void
    {
        $user = auth()->user();

        Share::create([
            'owner_id' => $user->id,
            'shared_user_id' => $userIdShared,
            'access' => $access,
        ]);
    }
}
