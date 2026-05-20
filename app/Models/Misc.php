<?php

namespace App\Models;

use GTCrais\GTCMS\Resources\Field;
use GTCrais\GTCMS\Services\ArrayHelper;
use Illuminate\Database\Eloquent\Model;

class Misc extends Model
{
    protected $table = 'misc';
    protected $fillable = [
    	'key', 'value'
	];

	public static function localizedValues()
	{
		$keyValueMap = self::all()->flatMap(function($object) {
			return [$object->key => $object->value];
		});

		return
			collect(config('gtcms.entities.misc.fields'))->map(function($field) {
				return app(ArrayHelper::class)->arrayToObject($field, Field::class);
			})->flatMap(function($field) use ($keyValueMap) {
				/** @var Field $field */
				return [$field->property => $keyValueMap[$field->localizedProperty(app()->getLocale())]];
			});
    }
}
