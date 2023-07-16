<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
	public function testCanGetAndSetData(): void
	{
		$currentTime = new \DateTime();
		$currentTimeImmutable = new \DateTimeImmutable();
		
		$order = new Order();
		$order
			->setOrderText('This is a test order')
			->setCookedAt($currentTimeImmutable)
			->setDeliveredAt($currentTimeImmutable)
			->setImage('https://www.example.com/image.png')
			->setCustomer('12345678901234567890')
			->setGuild('09876543210987654321')
			->setChannel('45678901234567890123')
			->setChef('78901234567890123456')
			->setDeliverer('34567890123456789012')
			->setCreatedAt($currentTime)
			->setUpdatedAt($currentTime)
		;
		
		self::assertSame('This is a test order', $order->getOrderText());
		self::assertSame($currentTimeImmutable, $order->getCookedAt());
		self::assertSame($currentTimeImmutable, $order->getDeliveredAt());
		self::assertSame('https://www.example.com/image.png', $order->getImage());
		self::assertSame('12345678901234567890', $order->getCustomer());
		self::assertSame('09876543210987654321', $order->getGuild());
		self::assertSame('45678901234567890123', $order->getChannel());
		self::assertSame('78901234567890123456', $order->getChef());
		self::assertSame('34567890123456789012', $order->getDeliverer());
		self::assertSame($currentTime, $order->getCreatedAt());
		self::assertSame($currentTime, $order->getUpdatedAt());
		self::assertSame(null, $order->getId());
	}
}