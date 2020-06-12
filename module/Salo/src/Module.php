<?php

namespace Salo;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

//debes de ir agregando modelos de cada tabla como Actividad y catalogo
use Salo\Model\Dao\IActividadDao;
use Salo\Model\Dao\ActividadDao;
use Salo\Model\Entity\Actividad;

use Salo\Model\Dao\ICatalogoDao;
use Salo\Model\Dao\CatalogoDao;
use Salo\Model\Entity\Catalogo;

use Salo\Model\Entity\Evento;

//use Salo\Model\Entity\Categoria;
//use Salo\Model\Entity\Organizador;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
