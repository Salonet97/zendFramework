<?php
namespace Frank;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

//debes de ir agregando modelos de cada tabla como Actividad y catalogo
use Frank\Model\Dao\IActividadDao;
use Frank\Model\Dao\ActividadDao;
use Frank\Model\Entity\Actividad;

use Frank\Model\Dao\ICatalogoDao;
use Frank\Model\Dao\CatalogoDao;
use Frank\Model\Entity\Catalogo;

use Frank\Model\Entity\Evento;

//use Frank\Model\Entity\Categoria;
//use Frank\Model\Entity\Organizador;

class Module {

	public function getConfig() {
		return include __DIR__ . '/../config/module.config.php';
	}

	//Table gateway es un objeto que representa un objeto de base de datos
	public function getServiceConfig() {
		return [
			'factories' => [
				//Registramos en el service manager, el ActividadTableGateway
				//para la tabla Actividad en la base de datos
				'ActividadTableGateway' => function ($sm) {
					//necesitamos un adaptador y lo jalamos a través del service manager (adapterinterface)
					//con el atributo clase
					$dbAdapter = $sm->get(AdapterInterface::class);
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Actividad());
					//creamos un tablegateway, les pasamos el nombre de la tabla('actividad'), la conexión($dbAdapter)
					//nos permite mapear a una clase($resultSetPrototype)
					return new TableGateway('actividad', $dbAdapter, null, $resultSetPrototype);
				},
				IActividadDao::class => function($sm) {
					$tableGateway = $sm->get('ActividadTableGateway');
					$dao = new ActividadDao($tableGateway);
					return $dao;
				},
				'CatalogoTableGateway' => function ($sm) {
					$dbAdapter = $sm->get(AdapterInterface::class);
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Catalogo());
					return new TableGateway('catalogo', $dbAdapter, null, $resultSetPrototype);
				},
				ICatalogoDao::class => function($sm) {
					$tableGateway = $sm->get('CatalogoTableGateway');
					$tableActividad = $sm->get('ActividadTableGateway');
					$tableEvento = $sm->get('EventoTableGateway');
					$dao = new CatalogoDao($tableGateway,$tableEvento,$tableActividad);
					return $dao;
				},
				'EventoTableGateway' => function ($sm) {
					$dbAdapter = $sm->get(AdapterInterface::class);
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Evento());
					return new TableGateway('evento', $dbAdapter, null, $resultSetPrototype);
				},
			],
		];
	}

}
