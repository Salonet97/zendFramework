<?php

namespace Flor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Flor\Model\Dao\ICategoriaDao;
use Flor\Model\Entity\Categoria;
use Flor\Form\Categoria as CategoriaForm;
use Flor\Form\CategoriaValidator;

class CategoriaController extends AbstractActionController {

	private $categoriaDao;

    public function __construct(ICategoriaDao $categoriaDao) {
        $this->categoriaDao = $categoriaDao;
    }

    public function indexAction() {
//return new ViewModel();
        return [
            'titulo' => 'Lista de Categorias',
            'categorias' => $this->categoriaDao->obtenerTodos()
        ];
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('categoria');
        }

        $form = new CategoriaForm("categoria");

        $categoria = $this->categoriaDao->obtenerPorId($id);

        $form->bind($categoria);
        $form->get('guardar')->setAttribute('value', 'Editar');

        $modelView = new ViewModel([ 'titulo' => 'Editar Categoria', 'form' => $form]);
        $modelView->setTemplate('flor/categoria/create');
        return $modelView;
    }

    public function createAction() {
        $form = new CategoriaForm("categoria");
        $modelView = new ViewModel([ 'titulo' => 'Crear Categoria', 'form' => $form]);
        $modelView->setTemplate('flor/categoria/create');
        return $modelView;
    }

    public function guardarAction() {
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute('categoria');
        }
        $form = new CategoriaForm("categoria");
        $form->setInputFilter(new CategoriaValidator());
// Obtenemos los datos desde el Formulario con POST data:
        $data = $this->request->getPost();
        $form->setData($data);
// Validando el form
        if (!$form->isValid()) {
            $modelView = new ViewModel([ 'titulo' => 'Validando Categoria',  'form' => $form]);
            $modelView->setTemplate('flor/categoria/create');
            return $modelView;
        }
        $categoria = new Categoria();
        $categoria->exchangeArray($form->getData());

        $this->categoriaDao->guardar($categoria);
        return $this->redirect()->toRoute('categoria');
    }

    public function eliminarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('categoria');
        }
        $categoria = new Categoria();
        $categoria->setId($id);
        
        $this->categoriaDao->eliminar($categoria);
        return $this->redirect()->toRoute('categoria');
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
            $this->redirect()->toRoute('categoria', ['action' => 'create']);
        }

// Obtenemos los parámetros del formulario es similar a $_POST
        $postParams = $this->request->getPost();

//obtenemos el formulario
        $form = $this->getForm();
//asignamos el validador
        $form->setInputFilter(new CategoriaValidator());

//asignamos los datos del post
        $form->setData($postParams);

//validamos el formulario, si es distinto a Valido
        if (!$form->isValid()) {
// Falla la validación; volvemos a generar el formulario 
            $modelView = new ViewModel(['form' => $form, 'titulo' => "Validando campos de la Categoria"]);
//asignamos el template o la vista
            $modelView->setTemplate('flor/categoria/create');
            return $modelView;
        }
//si todo se valida sin problemas, 
//obtenemos los valores
        $values = $form->getData();
//print_r($values);
//exit;
//poblamos con los valores del formulario al estudiante
        $categoria = new Categoria();

//mandamos al metodo exchangeArray de la clase Categoria, los valores del formulario con la ayuda del objeto $categoria
        $categoria->exchangeArray($values);


        return new ViewModel(['titulo' => "Detalle de la Categoria", 'categoria' => $categoria]);
    }

    private function getForm() {
        $form = new CategoriaForm();

        $form->get('descripcion')/* ->setValue(""/*$this->llenarPaises()) */;
        return $form;
    }

	
}