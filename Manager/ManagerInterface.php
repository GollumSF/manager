<?php
namespace GollumSF\Manager;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

interface ManagerInterface {
	
	public function getEntityClass() : string;
	
	public function getRepository(): ?ObjectRepository;
	
	/**
	 * @param mixed $entity
	 * @return mixed
	 */
	public function delete($entity);
	
	/**
	 * @param mixed $entity
	 * @return mixed
	 */
	public function update($entity);
	
	/**
	 * @param mixed $id
	 * @return null|mixed
	 */
	public function find($id);
	
	/**
	 * @param array $criteria
	 * @param array|null $orderBy
	 * @param null $limit
	 * @param null $offset
	 * @return array
	 */
	public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
	
	/**
	 * @param array $criteria
	 * @return null|object
	 */
	public function findOneBy(array $criteria);
	
}