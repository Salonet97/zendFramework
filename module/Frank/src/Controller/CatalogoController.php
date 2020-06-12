<?php

namespace Frank\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Frank\Model\Dao\ICatalogoDao;
use Frank\Model\Entity\Catalogo;
use Frank\Form\Catalogo as CatalogoForm;
use Frank\Form\CatalogoValidator;

class CatalogoController extends AbstractActionController {

	private $ctologoDao;

	public function __construct(ICatalogoDao $catalogoDao) {
		$this->ctologoDao = $catalogoDao;
	}

	public function indexAction() {
		return[
			'titulo' => 'Lista del Catalogo',
			'catalogos' => $this->ctologoDao->obtenerTodos()
		];
	}

	public function editAction() {
		$id = (int) $this->params()->fromRoute('id', 0);

		if (!$id) {
			return $this->redirect()->toRoute('catalogo');
		}

		//$form = new CatalogoForm("catalogo");
		$form = $this->getForm();

		$catalogo = $this->ctologoDao->obtenerPorId($id);

		$form->bind($catalogo);
		$form->get('guardar')->setAttribute('value', 'Editar');

		$modelView = new ViewModel(['titulo' => 'Editar Catalogo', 'form' => $form]);
		$modelView->setTemplate('frank/catalogo/create');
		return $modelView;
	}

	public function createAction() {
		//$form = new CatalogoForm("catalogo");
		$modelView = new ViewModel(['titulo' => 'Crear elemento para el catalogo', 'form' => $this->getForm()]);
		$modelView->setTemplate('frank/catalogo/create');
		return $modelView;
	}

	public function guardarAction() {
		if (!$this->request->isPost()) {
			return $this->redirect()->toRoute('catalogo');
		}
		
		//$form = new CatalogoForm("catalogo");
		$form = $this->getForm();
		$form->setInputFilter(new CatalogoValidator());
// Obtenemos los datos desde el Formulario con POST data:
		$data = $this->request->getPost();
		$form->setData($data);
		
// Validando el form
		if (!$form->isValid()) {
			$modelView = new ViewModel(['titulo' => 'Validando Elemento', 'form' => $form]);
			$modelView->setTemplate('frank/catalogo/create');
			return $modelView;
		}
		$dataForm=$form->getData();
		$dataForm['actividad_id'] = $dataForm['actividad'];
		$dataForm['evento_id'] = $dataForm['evento'];
		
		$catalogo = new Catalogo();
		//print_r($dataForm);
		$catalogo->exchangeArray($dataForm);
		//print_r($catalogo);
		$this->ctologoDao->guardar($catalogo);
		return $this->redirect()->toRoute('catalogo');
	}

	public function eliminarAction() {
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('catalogo');
		}
		$catalogo = new Catalogo();
		$catalogo->setId($id);

		$this->ctologoDao->eliminar($catalogo);
		return $this->redirect()->toRoute('catalogo');
	}

	public function registrarAction() {
		if (!$this->getRequest()->isPost()) {
			$this->redirect()->toRoute('catalogo', ['action' => 'create']);
		}
		$postParams = $this->request->getPost();


		$form = $this->getForm();

		$form->setInputFilter(new CatalogoValidator());


		$form->setData($postParams);


		if (!$form->isValid()) {

			$modelView = new ViewModel(['form' => $form, 'titulo' => "Validando campos del elemento"]);

			$modelView->setTemplate('frank/catalogo/create');
			return $modelView;
		}

		$values = $form->getData();

		$catalogo = new Catalogo();


		$catalogo->exchangeArray($values);


		return new ViewModel(['titulo' => "Detalle del elemento", 'catalogo' => $catalogo]);
	}

	private function getForm() {
		$form = new CatalogoForm("catalogo");
		$form->get('evento')->setValueOptions($this->ctologoDao->obtenerActividadSelect());
		$form->get('actividad')->setValueOptions($this->ctologoDao->obtenerEventoSelect());
		
		return $form;
	}

}
