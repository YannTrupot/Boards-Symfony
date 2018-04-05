<?php

namespace App\Controller;

use App\Repository\StoryRepository;
use App\Repository\TaskRepository;
use App\Services\semantic\TasksGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class TasksController extends CrudController{
    function __construct(TasksGui $gui, TaskRepository $taskRepo)
    {
        $this->gui=$gui;
        $this->repository=$taskRepo;
        $this->type="tasks";
        $this->subHeader="task list";
        $this->icon="tasks";
    }

    /**
     * @Route("/tasks", name="tasks")
     */
    public function index(){
        return $this->_index();
    }

    /**
     * @Route("/tasks/refresh", name="tasks_refresh")
     */
    public function refresh(){
        return $this->_refresh();
    }

    /**
     * @Route("/tasks/edit/{id}", name="tasks_edit")
     */
    public function edit($id,StoryRepository $repo){
        $stories=$repo->getAll();
        return $this->_edit($id,$stories);
    }

    /**
     * @Route("/tasks/new", name="tasks_new")
     */
    public function add(StoryRepository $repo){
        $stories=$repo->getAll();
        return $this->_add("\App\Entity\Task",$stories);
    }

    /**
     * @Route("/tasks/update", name="tasks_update")
     */
    public function update(Request $request){
        return $this->_update($request, "\App\Entity\Task");
    }

    protected function _setValues($instance, Request $request){
        parent::_setValues($instance, $request);
        $entityManager = $this->getDoctrine()->getManager();
        $storyRepo=$entityManager->getRepository("\App\Entity\Story");

        if($request->get("idStory")!=null){

            $story=$storyRepo->find($request->get("idStory"));
            $instance->setStory($story);
        }
    }

    /**
     * @Route("/tasks/confirmDelete/{id}", name="tasks_confirm_delete")
     */
    public function deleteConfirm($id){
        return $this->_deleteConfirm($id);
    }

    /**
     * @Route("/tasks/delete/{id}", name="tasks_delete")
     */
    public function delete($id,Request $request){
        return $this->_delete($id, $request);
    }

}

