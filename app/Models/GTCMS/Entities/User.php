<?php

namespace App\Models\GTCMS\Entities;

use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use GTCrais\GTCMS\Resources\Entity;

class User extends UserModel
{
	use Entity;

	public static function getUserRoles()
	{
		$roles = [
			'admin' => 'Administrator'
		];

		if (auth()->user()->role == 'superadmin') {
			$roles['superadmin'] = 'Super Administrator';
		}

		return $roles;
	}

	public function getAdminEmailAttribute()
	{
		return $this->email ?: '--- No email entered ---';
	}

	public function getRoleNameAttribute()
	{
		return self::getUserRoles()[$this->role] ?? null;
	}

	public function getFullNameAttribute()
	{
		return $this->name . ' (' . $this->adminEmail . ')';
	}

	public function setPasswordAttribute($value)
	{
		if ($value) {
			$this->attributes['password'] = \Hash::make(request()->get('password'));
		}
	}

	public function scopeIndexQuery($query)
	{
		if (optional(auth()->user())->role != 'superadmin') {
			/** @var Builder $query */
			$query = $query->where(function(Builder $query2) {
				$query2->where('role', '!=', 'superadmin')->orWhereNull('role');
			});
		}
	}

	public function postActionMutations(Request $request, $filteredInput, $originalObject = null)
	{
		if (
			optional($originalObject)->role != 'superadmin' &&
			$this->role == 'superadmin'
		) {
			$this->role = 'admin';
			$this->save();
		}

		return $this;
	}
}
