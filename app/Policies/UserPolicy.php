<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GTCMS\Entities\User as UserEntity;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	public function index(User $user)
	{
		return true;
    }

	public function create(User $user)
	{
		return true;
    }

	public function edit(User $user, UserEntity $userObject)
	{
		return $this->preventRegularUserFromManipulatingSuperadmin($user, $userObject);
	}

	public function store(User $user)
	{
		return true;
	}

	public function update(User $user, UserEntity $userObject)
	{
		return $this->preventRegularUserFromManipulatingSuperadmin($user, $userObject);
	}

	public function destroy(User $user, UserEntity $userObject)
	{
		return $this->preventRegularUserFromManipulatingSuperadmin($user, $userObject);
	}

	protected function preventRegularUserFromManipulatingSuperadmin(User $user, UserEntity $userObject)
	{
		if ($userObject->role == 'superadmin' && $user->role != 'superadmin') {
			return false;
		}

		return true;
	}
}
