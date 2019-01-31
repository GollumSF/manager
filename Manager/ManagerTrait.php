<?php
namespace GollumSF\Manager;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

trait ManagerTrait {
	
	/**
	 * @var EntityManagerInterface
	 */
	private $em;
	
	/**
	 * @required
	 */
	public function setEntityManager(EntityManagerInterface $em) {
		$this->em = $em;
	}
	
	protected function getEntityManager(): EntityManagerInterface {
		return $this->em;
	}
	
	public function getEntityClass(): string {
		$className = get_class($this);
		$namespace = substr($className, 0, strrpos($className, '\\'));
		
		$entityNS    = substr($namespace, 0, -strlen('\Manager')).'\\Entity';
		$entityClass =  substr(str_replace($namespace, '', $className), 0, -strlen('Manager'));
		
		return $entityNS.$entityClass;
	}
	
	
	public function getRepository(): ?ObjectRepository {
		return $this->getEntityManager()->getRepository($this->getEntityClass());
	}
	
	/**
	 * @param mixed $entity
	 * @return mixed
	 */
	public function delete($entity) {
		if (is_array($entity)) {
			foreach ($entity as $e) {
				$this->delete($e);
			}
		} else {
			if (is_object($entity)) {
				$em = $this->getEntityManager();
				$em->remove($entity);
				$em->flush($entity);
			}
		}
		return $entity;
	}
	
	/**
	 * @param mixed $entity
	 * @return mixed
	 */
	public function update($entity) {
		if (is_object($entity)) {
			$em = $this->getEntityManager();
			$em->persist($entity);
			$em->flush($entity);
		}
		return $entity;
	}
	
	/**
	 * @param mixed $id
	 * @return null|mixed
	 */
	public function find($id) {
		return  $this->getRepository()->find($id);
	}
	
	/**
	 * @param array $criteria
	 * @param array|null $orderBy
	 * @param null $limit
	 * @param null $offset
	 * @return array
	 */
	public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) {
		return  $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
	}
	
	/**
	 * @param array $criteria
	 * @return null|object
	 */
	public function findOneBy(array $criteria) {
		return  $this->getRepository()->findOneBy($criteria);
	}
	
}