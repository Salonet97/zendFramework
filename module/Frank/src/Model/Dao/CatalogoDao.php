<?php
namespace Frank\Model\Dao;

use Zend\Db\TableGateway\TableGateway;

use Frank\Model\Entity\Catalogo;
use RuntimeException;


class CatalogoDao implements ICatalogoDao {

	protected $tableGateway;
	protected $tableActividad;
	protected $tableEvento;

	public function __construct(TableGateway $tableGateway, TableGateway $tableActividad, TableGateway $tableEvento) {
        $this->tableGateway = $tableGateway;
		$this->tableActividad = $tableActividad;
		$this->tableEvento = $tableEvento;
    }
	
	public function obtenerPorId($id) {
        $rowset = $this->tableGateway->select(['id' => (int)$id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException("No se pudo encontrar en el Catalogo: $id");
        }
        return $row;
    }

	//regresa un objeto de tipo Arreglo de Producto, un objeto de colección, 
	//que nos permitirá interactuar con los registros obtenidos en el template 
	//de nuestro archivo vista phtml:
    public function obtenerTodos() {
        $select = $this->tableGateway->getSql()->select();
		//		      |sinonimo  tabla   | |sinonimo.for = cata.fora| |los campos de la subtabla                                   |
		$select->join(['act'=>'actividad'], 'act.id = catalogo.actividad_id', ['actividadId' => 'id', 'actividadDescripcion'=>'descripcion'])
			   ->join(['eve'=>'evento'], 'eve.id = catalogo.evento_id', ['eventoId' => 'id', 'eventoTitulo'=>'titulo', 'eventoDescripcion'=>'descripcion', 
				   'eventoFechaInicio'=>'fechainicio','eventoFechaFin'=>'fechafin', 'eventoObservaciones'=>'observaciones', 'eventoLogotipo'=>'logotipo', 
				   'eventoEslogan'=>'eslogan', 'eventoLugar'=>'lugar', 'eventoCategoríaID'=>'categoria_id', 'eventoInicio'=>'inicioregistro', 
				   'eventoCierre'=>'cierreregistro', 'eventoOrganizadorId'=>'organizador_id']);
		
		$select->order("id");
		
		//esto es solo para ver como es la consulta sql
		//echo $select->getSqlString();
		//die;
		
		//print_r($select);
		//el selectWith sirve para traer todos los campos incluyendo los del join
		return $this->tableGateway->selectWith($select);
    }

    public function eliminar(Catalogo $catalogo) {
        $this->tableGateway->delete(['id' => $catalogo->getId()]);
    }

    public function guardar(Catalogo $catalogo) {		
        $data = [
            'titulo' => $catalogo->getTitulo(),
			'costo' => $catalogo->getCosto(),
			'totalhoras' => $catalogo->getTotalhoras(),
			'cupolimite' => $catalogo ->getCupolimite(),
			'actividad_id'=>$catalogo->getActividad_id(),
			'evento_id'=>$catalogo->getEvento_id(),
        ];
		
				
        $id = (int) $catalogo->getId();

        if ($id == 0) {
			//print_r($data);
			//exit();
            $this->tableGateway->insert($data);
			
        } else {
            if ($this->obtenerPorId($id)){
                $this->tableGateway->update($data, ['id' => $id]);
            } else {
                throw new RuntimeException("Id en el Catalogo no existe: $id");
            }
        }
		
    }
	
	public function obtenerActividad(){
		return $this->tableActividad->select();
	}
	
	public function obtenerEvento(){
		return $this->tableEvento->select();
	}
	
	//de aquí sale lo del select de actividad, pero usa la tabla de eventos
	public function obtenerActividadSelect(){
		$actividad = $this->obtenerActividad();
		$result = [];
		foreach ($actividad as $act){
			$result[$act->getId()] = $act->getTitulo();
		}
		return $result;
	}
	
	//de aquí sale lo del select de evento, pero usa la tabla de actividad
	public function obtenerEventoSelect(){
		$evento = $this->obtenerEvento();
		$result = [];
		foreach ($evento as $eve){
			$result[$eve->getId()] = $eve->getDescripcion();
		}
		return $result;
	}
}
