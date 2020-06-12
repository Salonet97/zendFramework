<?php

namespace Frank\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Frank\Model\Entity\Estudiante;
use Frank\Form\Estudiante as EstudianteForm;
use Frank\Form\EstudianteValidator;

class EstudianteController extends AbstractActionController {
	
	/*
	public function indexAction() {
		return new ViewModel();
	}

	public function editAction() {
		return new ViewModel();
	}

	public function createAction() {
		return new ViewModel();
	}
	 */

    public function indexAction() {
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
    }

    public function registrarAction() {
        if (!$this->getRequest()->isPost()) {
            $this->redirect()->toRoute('estudiante', ['action' => 'index']);
        }

        // Obtenemos los parámetros del formulario es similar a $_POST
        $postParams = $this->request->getPost();

        $form = $this->getForm();
        $form->setInputFilter(new EstudianteValidator());

        $form->setData($postParams);

        if (!$form->isValid()) {
            // Falla la validación; volvemos a generar el formulario 
            $modelView = new ViewModel(['form' => $form, 'titulo' => "Validando campos del estudiante"]);
            $modelView->setTemplate('frank/estudiante/index');
            return $modelView;
        }

        $values = $form->getData();

        $estudiante = new Estudiante();
        $estudiante->exchangeArray($values);

        return new ViewModel(['titulo' => "Detalle del Estudiante", 'estudiante' => $estudiante]);
    }

    private function getForm() {
        $form = new EstudianteForm();
        
        $form->get('pais')->setValueOptions($this->llenarPaises());
        $form->get('experienciaZend')->setValueOptions($this->llenarListaExperienciaZend());
        $form->get('temas')->setValueOptions($this->llenarListaTemas());
        $form->get('genero')->setValueOptions(["H" => "Hombre", "M" => "Mujer"]);
        $form->get('numeroFavorito')->setValueOptions($this->llenarListaNumeros());
        return $form;
    }

    private function llenarListaTemas() {

        // Data reference de temas para llenar checkboxes
        $listaTemas = array();
        $listaTemas[1] = "Matemáticas";
        $listaTemas[2] = "Ciencia";
        $listaTemas[3] = "Arte";
        $listaTemas[4] = "Musica";
        $listaTemas[5] = "Deporte";

        return $listaTemas;
    }

    private function llenarListaNumeros() {

        // Data reference de números para radiobuttons
        $numeros = array();
        $numeros[1] = "Numero 1";
        $numeros[2] = "Numero 2";
        $numeros[3] = "Numero 3";
        $numeros[4] = "Numero 4";
        $numeros[5] = "Numero 5";
        $numeros[6] = "Numero 6";
        $numeros[7] = "Numero 7";

        return $numeros;
    }

    private function llenarListaExperienciaZend() {

        // Data reference de experiencias Zend para list box
        $experienciaZend = array();
        $experienciaZend["Zend Db"] = "Zend Db";
        $experienciaZend["Zend Form"] = "Zend Form";
        $experienciaZend["Zend MVC"] = "Zend MVC";
        $experienciaZend["Zend Auth"] = "Zend Auth";

        return $experienciaZend;
    }

    private function llenarPaises() {

        // Data reference de paises para list box
        $paises = array();
        $paises["CL"] = "Chile";
        $paises["ES"] = "España";
        $paises["MX"] = "México";
        $paises["US"] = "United Stated";
        $paises["AR"] = "Argentina";

        return $paises;
    }

}
