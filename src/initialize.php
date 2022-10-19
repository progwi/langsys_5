<?php
require_once "bootstrap.php";
require_once __DIR__ . '/services/role.service.php';
require_once __DIR__ . '/services/user.service.php';

if (!isset($entityManager)) {
	echo "Entity manager is not set.\n";
	return;
}

$roleService = new RoleService($entityManager);
$userService = new UserService($entityManager);

$initialRoles = json_decode(file_get_contents(__DIR__ . '/models/roles.json'), true);

foreach ($initialRoles as $role) {
	$roleService->create($role);
}

$initialUsers = json_decode(file_get_contents(__DIR__ . '/models/users.json'), true);

foreach ($initialUsers as $user) {
	$u = $userService->create($user);
}

$usersList = $userService->query(1);
$i = 0;
foreach ($usersList as $user) {
	echo ++$i . " " . $user->getName() . " - " . $user->getEmail() . "\n";
}