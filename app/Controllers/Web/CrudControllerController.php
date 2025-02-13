<?php

class CrudControllerController
{
    public function index()
    {
        // Code for listing resources
        echo "This is the index method of CrudControllerController.";
    }

    public function create()
    {
        // Code for showing a create form
        echo "This is the create method of CrudControllerController.";
    }

    public function store()
    {
        // Code for storing new resources
        echo "This is the store method of CrudControllerController.";
    }

    public function edit($id)
    {
        // Code for showing an edit form
        echo "This is the edit method of CrudControllerController for ID: $id.";
    }

    public function update($id)
    {
        // Code for updating resources
        echo "This is the update method of CrudControllerController for ID: $id.";
    }

    public function delete($id)
    {
        // Code for deleting resources
        echo "This is the delete method of CrudControllerController for ID: $id.";
    }
}