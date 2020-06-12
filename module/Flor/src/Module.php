<?php
namespace Flor;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

//debes de ir agregando modelos de cada tabla como Categoria
use Flor\Model\Dao\ICategoriaDao;
use Flor\Model\Dao\CategoriaDao;
use Flor\Model\Entity\Categoria;


class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    //Table gateway es un objeto que representa un objeto de base de datos
	public function getServiceConfig() {
		return [
			'factories' => [
				//Registramos en el service manager, el ActividadTableGateway
				//para la tabla Categoria en la base de datos
				'CategoriaTableGateway' => function ($sm) {
					//necesitamos un adaptador y lo jalamos a través del service manager (adapterinterface)
					//con el atributo clase
					$dbAdapter = $sm->get(AdapterInterface::class);
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Categoria());
					//creamos un tablegateway, les pasamos el nombre de la tabla('categoria'), la conexión($dbAdapter)
					//nos permite mapear a una clase($resultSetPrototype)
					return new TableGateway('categoria', $dbAdapter, null, $resultSetPrototype);
				},
				ICategoriaDao::class => function($sm) {
					$tableGateway = $sm->get('CategoriaTableGateway');
					$dao = new CategoriaDao($tableGateway);
					return $dao;
				},
				
			],
		];
	}
}
