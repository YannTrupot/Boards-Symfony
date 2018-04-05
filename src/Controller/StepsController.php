<?php

namespace App\Controller;

use App\Repository\StepRepository;
use App\Services\semantic\StepsGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StepsController extends CrudController{
    function __construct(StepsGui $gui, StepRepository $stepRepo)
    {
        $this->gui=$gui;
        $this->repository=$stepRepo;
        $this->type="steps";
        $this->subHeader="step list";
        $this->icon="step forward";
    }

    /**
     * @Route("/steps", name="steps")
     */
    public function index(){
        return $this->_index();
    }

    /**
     * @Route("/steps/refresh", name="steps_refresh")
     */
    public function refresh(){
        return $this->_refresh();
    }

    /**
     * @Route("/steps/edit/{id}", name="steps_edit")
     */
    public function edit($id,StepRepository $stepRepo){
        $steps=$stepRepo->getAll();
        return $this->_edit($id,$steps);
    }

    /**
     * @Route("/steps/new", name="steps_new")
     */
    public function add(StepRepository $stepRepo){
        $steps=$stepRepo->getAll();
        return $this->_add("\App\Entity\Step",$steps);
    }

    /**
     * @Route("/steps/update", name="steps_update")
     */
    public function update(Request $request){
        return $this->_update($request, "\App\Entity\Step");
    }

    /**
     * @Route("/steps/confirmDelete/{id}", name="steps_confirm_delete")
     */
    public function deleteConfirm($id){
        return $this->_deleteConfirm($id);
    }

    /**
     * @Route("/steps/delete/{id}", name="steps_delete")
     */
    public function delete($id,Request $request){
        return $this->_delete($id, $request);
    }

}
