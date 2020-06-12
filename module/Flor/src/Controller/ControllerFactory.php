<?php
namespace Flor\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Flor\Model\Dao\ICategoriaDao;


class ControllerFactory implements FactoryInterface {
	

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		//echo $requestedName;
        $controller = null;
		/*print_r("Esto trae el cataegoriaDao: ");
		print_r($categoriaDao);*/
		
		//si sale un error de que no pasaron argumentos, checa que no haya ningun IndexController
		//o algo parecido, tienen que salir los controladores correctos
        switch ($requestedName) {
            case CategoriaController::class :
                $categoriaDao = $container->get(ICategoriaDao::class );
                $controller = new CategoriaController($categoriaDao);
                break;
                
			    default:
                return (null === $options) ? new $requestedName : new $requestedName($options);
        }
        return $controller;
    }

}