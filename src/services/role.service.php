<?php

require_once __DIR__ . '/../models/Role.php';

class RoleService
{
	private $entityManager;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function create(
		$data =	[
			"name" => "",
			"id"	 => 0
		]
	) {
		$existingRole = $this->entityManager->getRepository('Role')->findOneBy([
			"id"	=> $data["id"]
		]);
		if ($existingRole) {
			return $existingRole;
		}
		$role = new Role($data);
		$this->entityManager->persist($role);
		$this->entityManager->flush();
		return $role;
	}

	public function getRoles()
	{
		$roleRepository = $this->entityManager->getRepository("Role");
		$roles = $roleRepository->findAll();
		return $roles;
	}

	public function getRole($id)
	{
		$roleRepository = $this->entityManager->getRepository("Role");
		$role = $roleRepository->find($id);
		return $role;
	}

	public function updateRole($role)
	{
		$this->entityManager->merge($role);
		$this->entityManager->flush();
	}

	public function deleteRole($role)
	{
		$this->entityManager->remove($role);
		$this->entityManager->flush();
	}
}
