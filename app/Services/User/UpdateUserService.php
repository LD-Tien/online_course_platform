<?php

namespace App\Services\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class UpdateUserService extends BaseService
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle()
    {
        try {
            if (isset($this->data['avatar'])) {
                $avatar = $this->data['avatar'];
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path('avatars'), $avatarName);

                if (isset($this->data['old_avatar_url'])) {
                    $oldAvatarPath = public_path($this->data['old_avatar_url']);

                    if (\File::exists($oldAvatarPath)) {
                        \File::delete($oldAvatarPath);
                    }
                }

                $this->data['profile_photo_url'] = '/avatars/' . $avatarName;
            }

            return $this->userRepository->update($this->data, $this->data['id']);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

