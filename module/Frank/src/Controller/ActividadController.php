<?php

namespace Frank\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Frank\Model\Dao\IActividadDao;
use Frank\Model\Entity\Actividad;
use Frank\Form\Actividad as ActividadForm;
use Frank\Form\ActividadValidator;

//LOS toRoute('actividad') redireccionan a la vista de las actividades

class ActividadController extends AbstractActionController {

	private $atividadDao;

	public function __construct(IActividadDao $actividadDao) {
		$this->atividadDao = $actividadDao;
	}

	public function indexAction() {
//return new ViewModel();
		return [
			'titulo' => 'Lista de Actividades',
			'actividades' => $this->atividadDao->obtenerTodos()
		];
	}

	public function editAction() {
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('actividad');
		}

		$form = new ActividadForm("actividad");

		$actividad = $this->atividadDao->obtenerPorId($id);

		$form->bind($actividad);
		$form->get('guardar')->setAttribute('value', 'Editar');

		$modelView = new ViewModel([ 'titulo' => 'Editar Actividad', 'form' => $form]);
		$modelView->setTemplate('frank/actividad/create');
		return $modelView;
	}

	public function createAction() {
		$form = new ActividadForm("actividad");
		$modelView = new ViewModel([ 'titulo' => 'Crear Actividad', 'form' => $form]);
		$modelView->setTemplate('frank/actividad/create');
		return $modelView;
	}

	public function guardarAction() {
		if (!$this->request->isPost()) {
			return $this->redirect()->toRoute('actividad');
		}
		$form = new ActividadForm("actividad");
		$form->setInputFilter(new ActividadValidator());
// Obtenemos los datos desde el Formulario con POST data:
		$data = $this->request->getPost();
		$form->setData($data);
// Validando el form
		if (!$form->isValid()) {
			$modelView = new ViewModel([ 'titulo' => 'Validando Actividad',  'form' => $form]);
			$modelView->setTemplate('frank/actividad/create');
			return $modelView;
		}
		$actividad = new Actividad();
		$actividad->exchangeArray($form->getData());

		$this->atividadDao->guardar($actividad);
		return $this->redirect()->toRoute('actividad');
	}

	public function eliminarAction() {
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('actividad');
		}
		$actividad = new Actividad();
		$actividad->setId($id);
		
		$this->atividadDao->eliminar($actividad);
		return $this->redirect()->toRoute('actividad');
	}

//comando para crear el controlador de las vistas
//zfcreate action create ActividadController

	/* public function indexAction() {
	  $form = $this->getForm();

	  $estudiante = new Estudiante();
	  $estudiante->setDireccion("Avenida Keneddy");
	  $estudiante->setTemas([1, 4]);
	  $estudiante->setGenero("H");
	  $estudiante->setRecibeNewsletter(true);
	  $estudiante->setExperienciaZend(["Zend MVC", "Zend Auth"]);
	  $estudiante->setValorSecreto("Algún valor oculto");

	  $form->bind($estudiante);

	  return new ViewModel(['titulo' => "Ejemplo de elementos form de Zend - Formulario Estudiante", 'form' => $form]);
	  } */

//recibe el formulario
	public function registrarAction() {

//si es distinto a post nos regresa a create
		if (!$this->getRequest()->isPost()) {
			$this->redirect()->toRoute('actividad', ['action' => 'create']);
		}

// Obtenemos los parámetros del formulario es similar a $_POST
		$postParams = $this->request->getPost();

//obtenemos el formulario
		$form = $this->getForm();
//asignamos el validador
		$form->setInputFilter(new ActividadValidator());

//asignamos los datos del post
		$form->setData($postParams);

//validamos el formulario, si es distinto a Valido
		if (!$form->isValid()) {
// Falla la validación; volvemos a generar el formulario 
			$modelView = new ViewModel(['form' => $form, 'titulo' => "Validando campos de la Actividad"]);
//asignamos el template o la vista
			$modelView->setTemplate('frank/actividad/create');
			return $modelView;
		}
//si todo se valida sin problemas, 
//obtenemos los valores
		$values = $form->getData();
//print_r($values);
//exit;
//poblamos con los valores del formulario al estudiante
		$actividad = new Actividad();

//mandamos al metodo exchangeArray de la clase Actividad, los valores del formulario con la ayuda del objeto $actividad
		$actividad->exchangeArray($values);


		return new ViewModel(['titulo' => "Detalle de la Actividad", 'actividad' => $actividad]);
	}

	private function getForm() {
		$form = new ActividadForm();

		$form->get('descripcion')/* ->setValue(""/*$this->llenarPaises()) */;
		return $form;
	}

}
