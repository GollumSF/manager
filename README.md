# Manager

Simple manager abstract class service for entity

## Installation:

```shell
composer require gollumsf/manager
```

## Usage:

Register service by autowire.

```php
namespace App\Manager;

use GolumSF\Manager\Manager;

class UserManager extends Manager {
}
```
```php
namespace App\Controler;

use App\Manager\UserManager;

class MyControler {
	
	myAction(UserManager $userManager) {
		return Response($userManager->getEntityClass());
	}
	
}
```

Display:
```
App\Entity\User
```


## Methods:

```php
 * public getEntityClass(): string                // Return class name fo entity
 * protected getEntityManager(): string           // Return entity manager
 * public getRepository(): ?ObjectRepository      // Return repository of entity
 * public delete($entity): Entity                 // Delete the doctrine entity
 * public update($entity): Entity                 // Persist and flush the entity 
 * public find($id): Entity|null                  // Return the entity of id (wrapper of repository->find)
 * public findOneBy(array $criteria): Entity|null // Return the entity of criteria (wrapper of repository->findOneBy)
 * public findBy(                                 // Return the entities of criteria (wrapper of repository->findBy)
        array $criteria, 
        array $orderBy = null, 
        $limit = null, 
        $offset = null
	): Entity[]
```