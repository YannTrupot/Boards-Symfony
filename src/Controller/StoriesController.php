<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\StoryRepository;
use App\Services\semantic\StoriesGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Story;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class StoriesController extends CrudController{
    function __construct(StoriesGui $gui, StoryRepository $storyRepo)
    {
        $this->gui=$gui;
        $this->repository=$storyRepo;
        $this->type="stories";
        $this->subHeader="story list";
        $this->icon="stories";
    }

    /**
     * @Route("/stories", name="stories")
     */
    public function index(){
        return $this->_index();
    }

    /**
     * @Route("/stories/refresh", name="stories_refresh")
     */
    public function refresh(){
        return $this->_refresh();
    }

    /**
     * @Route("/stories/edit/{id}", name="stories_edit")
     */
    public function edit($id,ProjectRepository $repo){
        $projects=$repo->getAll();
        return $this->_edit($id,$projects);
    }

    /**
     * @Route("/stories/new", name="stories_new")
     */
    public function add(ProjectRepository $repo){
        $projects=$repo->getAll();
        return $this->_add("\App\Entity\Story",$projects);
    }

    protected function _setValues($instance, Request $request){
        parent::_setValues($instance, $request);
        $entityManager = $this->getDoctrine()->getManager();
        $projectRepo=$entityManager->getRepository("\App\Entity\Project");
        if($request->get("idProject")!=null){
            $project=$projectRepo->find($request->get("idProject"));
            $instance->setProject($project);
        }
    }

    /**
     * @Route("/stories/update", name="stories_update")
     */
    public function update(Request $request){
        return $this->_update($request, "\App\Entity\Story");
    }

    /**
     * @Route("/stories/confirmDelete/{id}", name="stories_confirm_delete")
     */
    public function deleteConfirm($id){
        return $this->_deleteConfirm($id);
    }

    /**
     * @Route("/stories/delete/{id}", name="stories_delete")
     */
    public function delete($id,Request $request){
        return $this->_delete($id, $request);
    }

}

