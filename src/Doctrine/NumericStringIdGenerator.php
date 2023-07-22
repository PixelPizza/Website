<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Exception;

class NumericStringIdGenerator extends AbstractIdGenerator
{
	private const MIN_VALUE = 0;
	private const MAX_VALUE = 999;
	private const MAX_ATTEMPTS = 100;
	
	/**
	 * @throws Exception
	 */
	public function generateId(EntityManagerInterface $em, $entity): string
	{
		$entityName = $em->getClassMetadata(get_class($entity))->getName();
		
		$attempt = 0;
		
		while (true) {
			$id = mt_rand(self::MIN_VALUE, self::MAX_VALUE);
			$id = $this->toStringAndPadId($id);
			$item = $em->find($entityName, $id);
			
			if (!$item) {
				$persisted = $em->getUnitOfWork()->getScheduledEntityInsertions();
				$ids = array_map(fn($item) => $item->getId(), $persisted);
				$item = array_search($id, $ids);
			}
			
			if (!$item) {
				return $id;
			}
			
			if (++$attempt > self::MAX_ATTEMPTS) {
				throw new Exception('Unable to generate unique ID');
			}
		}
	}
	
	private function toStringAndPadId(int $id) {
		return str_pad(strval($id), 3, '0', STR_PAD_LEFT);
	}
}