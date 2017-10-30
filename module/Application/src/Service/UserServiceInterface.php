<?php
namespace Application\Service;

interface UserServiceInterface 
{
	/**
	 * Gets user by ID
	 *
	 * @param int $id
	 * @return UserInterface
	 */
	public function getUserById($id);

	/**
	 * Gets user by email
	 *
	 * @param string $email
	 * @return UserInterface
	 */
	public function getUserByEmail($email);

	/**
	 * Gets all users or by filter
	 *
	 * @return UserInterface
	 */
	public function getUserByFilter();

	/**
	 * Registers new user
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function registerUser($data);

	/**
	 * Updates user
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return bool
	 */
	public function updateUser($data, $where);

	/**
	 * Deletes user
	 *
	 * @param Where|\Closure|string|array $where
	 * @param bool
	 */
	public function deleteUser($where);				
}

