<?php

namespace App\Services\semantic;

use Ajax\semantic\html\elements\HtmlLabel;
use Ajax\service\JArray;
use App\Entity\Task;

class StoriesGui extends SemanticGui{
    public function dataTable($stories,$type){

        $dt=$this->_semantic->dataTable("dt-".$type, "App\Entity\Story", $stories);
        $dt->setIdentifierFunction("getId");
        $dt->setFields(["code","descriptif","project"]);
        $dt->setCaptions(["Code","Descriptif","Project"]);
        $dt->addEditDeleteButtons(false, [ "ajaxTransition" => "random","hasLoader"=>false ], function ($bt) {
            $bt->addClass("circular");
        }, function ($bt) {
            $bt->addClass("circular");
        });
        $dt->onPreCompile(function () use (&$dt) {
            $dt->getHtmlComponent()->colRight(3);
        });
        $dt->setUrls(["edit"=>"stories/edit","delete"=>"stories/confirmDelete"]);
        $dt->setTargetSelector("#frm");
        return $dt;
    }

    public function dataForm($story,$type,$di=null){

        $df=$this->_semantic->dataForm("frm-".$type,$story);
        if($story->getProject()!=null){
            $story->idProject=$story->getProject()->getId();
        }

        $df->setFields(["code\n","id\n","code\n","descriptif\n","idProject"]);
        $df->setCaptions(["Modification","","Code","Descriptif","Project"]);
        $df->fieldAsMessage(0,["icon"=>"info circle"]);
        $df->fieldAsHidden(1);
        $df->fieldAsInput(2,["rules"=>"empty"]);
        $df->fieldAsTextarea(3,["rules"=>"empty"]);
        $df->fieldAsDropDown(4,JArray::modelArray($di,"getId","getName"));
        $df->setValidationParams(["on"=>"blur","inline"=>true]);
        $df->setSubmitParams("stories/update","#frm",["attr"=>"","hasLoader"=>false]);
        return $df;
    }

}
