<?php
namespace Frank\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Frank\Model\Dao\IActividadDao;
use Frank\Model\Dao\ICatalogoDao;

class ControllerFactory implements FactoryInterface {
	

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		//echo $requestedName;
        $controller = null;
		/*print_r("Esto trae el actividadDao: ");
		print_r($actividadDao);*/
		
		//si sale un error de que no pasaron argumentos, checa que no haya ningun IndexController
		//o algo parecido, tienen que salir los controladores correctos
        switch ($requestedName) {
            case ActividadController::class :
                $actividadDao = $container->get(IActividadDao::class );
                $controller = new ActividadController($actividadDao);
                break;
			case CatalogoController::class:
				$catalogoDao = $container->get(ICatalogoDao::class);
                $controller = new CatalogoController($catalogoDao);
                break;
            default:
                return (null === $options) ? new $requestedName : new $requestedName($options);
        }
        return $controller;
    }

}