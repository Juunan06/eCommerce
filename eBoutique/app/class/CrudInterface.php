<?php

interface CrudInterface{

	public function read($bdd, $id);
	public function add($bdd);
	public function update($bdd);
	public function delete($bdd, $id);
	
}