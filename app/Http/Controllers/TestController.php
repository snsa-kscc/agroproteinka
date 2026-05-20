<?php

namespace App\Http\Controllers;

use GTCrais\GTCMS\Resources\EntityConfig;
use GTCrais\GTCMS\Services\EntityConfigProvider;
use Illuminate\Http\Request;

class TestController extends Controller
{
	public function test(Request $request, EntityConfigProvider $entityConfigProvider)
	{
		/*$entityConfigProvider->buildEntityConfigs();*/

		/** @var EntityConfig $entityConfig */
		/*$entityConfig = $entityConfigProvider->getEntityConfig('page');

		dump($entityConfig->structure('depth.test.more'));*/

		return "testing";
    }
}
