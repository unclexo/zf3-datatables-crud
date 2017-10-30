<?php
namespace Application\Mapper;

interface UserMapperInterface 
{
	/**
	 * Get user by ID
	 *
	 * @param int $id
	 * @return UserInterface
	 */
	public function getById($id);

	/**
	 * Get user by email
	 *
	 * @param string $email
	 * @return UserInterface
	 */
	public function getByEmail($email);

	/**
	 * Get all users or by filter
	 *
	 * @param Where|\Closure|string|array $where
	 * @param array|string $order
	 * @param int $limit
	 * @param int $offset
	 * @return UserInterface
	 */
	public function getByFilter($where, $order, $limit, $offset);

	/**
	 * Insert data
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function insert($data);	

	/**
	 * Update data
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return bool
	 */
	public function update($data, $where);

	/**
	 * Delete
	 *
	 * @param Where|\Closure|string|array $where
	 * @param bool
	 */
	public function delete($where);			
}

