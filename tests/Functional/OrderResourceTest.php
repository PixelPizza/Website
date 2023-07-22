<?php

namespace App\Tests\Functional;

use App\Factory\OrderFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Browser\Json;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Test\ResetDatabase;

class OrderResourceTest extends KernelTestCase
{
	use HasBrowser;
	use ResetDatabase;
	
	public function testGetCollectionOfOrders(): void
	{
		OrderFactory::createMany(5);
		
		$this->browser()
			->get('/api/orders')
			->assertJson()
			->assertJsonMatches('"hydra:totalItems"', 5)
			->use(function(Json $json) {
				$json->assertMatches('keys("hydra:member"[0])', [
					'@id',
					'@type',
					'id',
					'order',
					'cookedAt',
					'deliveredAt',
					'image',
					'customer',
					'guild',
					'channel',
					'chef',
					'deliverer',
					'orderedAt'
				]);
			})
		;
	}
}