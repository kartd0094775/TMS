<?php
class ControllerProducerCrud extends ControllerProducer{

	//default action--------------------------------------------------------------------------------------------

	public $isItemRead = false;

	//default item read
	public function actionRead() {
		$this -> checkPermission('read');
		$this -> isItemRead = true;
		$this -> getItem();

	}

	//default item update
	public function actionUpdate() {
		$this -> checkPermission('update');
		$this -> isItemRead = false;
		$this -> getItem();
	}

	//default item
	public function actionItem() {
		// $this -> checkPermission('update');
		$this -> isItemRead = false;
		$this -> getItem();
	}

	//default list
	public function actionList() {
		$this -> checkPermission('read');
		$this -> render();
	}

	//default create
	public function actionCreate() {
		$this -> checkPermission('create');
		// $this -> render(null, 'item');
		$this -> getItem();

	}

	//default index - go to list
	public function actionIndex() {
		$this -> toPage('list');
	}

	//default action--------------------------------------------------------------------------------------------

}
