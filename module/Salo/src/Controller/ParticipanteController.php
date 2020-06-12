<?php


namespace Salo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ParticipanteController extends AbstractActionController {

	public function indexAction() {
		return new ViewModel();
	}

	public function editAction() {
		return new ViewModel();
	}

	public function createAction() {
		$form = $this->getForm();
		
		$participante = new Participante();
		$participante ->setNombre("");
		$evento ->setDescripcion("");
		$evento ->setFechainicio("");
		$evento ->setFechafin("");
		$evento ->setObservaciones("");
		$evento ->setLogotipo("");
		$evento ->setEslogan("");
		$evento ->setLugar("");
		$evento ->setCategoriaid("");
		$evento ->setInicioregistro("");
		$evento ->setCierreregistro("");
		$evento ->setOrganizadorid("");
		
		$form->bind($participante);
		
		return new ViewModel([/*'titulo' => "Error de Validación",*/ 'form' => $form]);
    }
	

}
