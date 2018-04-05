<?php

namespace App\Services\semantic;

use Ajax\semantic\html\elements\HtmlLabel;
use App\Entity\Tag;
use Ajax\semantic\html\base\constants\Color;

class TagsGui extends SemanticGui{
	public function dataTable($tags,$type){

        $dt=$this->_semantic->dataTable("dt-".$type, "App\Entity\Tag", $tags);
        $dt->setIdentifierFunction("getId");
        $dt->setFields(["title"]);
        $dt->setCaptions(["Title"]);
        $dt->addEditDeleteButtons(false, [ "ajaxTransition" => "random","hasLoader"=>false ], function ($bt) {
            $bt->addClass("circular");
        }, function ($bt) {
            $bt->addClass("circular");
        });
        $dt->onPreCompile(function () use (&$dt) {
            $dt->getHtmlComponent()->colRight(1);
        });
        $dt->setUrls(["edit"=>"tags/edit","delete"=>"tags/confirmDelete"]);
        $dt->setTargetSelector("#frm");
        return $dt;
	}

    public function dataForm($tag,$type,$di=null){
        $colors=Color::getConstants();
        $df=$this->_semantic->dataForm("frm-".$type,$tag);
        $df->setFields(["title\n","id\n","title","color"]);
        $df->setCaptions(["Modification","","Title","Color"]);
        $df->fieldAsMessage(0,["icon"=>"info circle"]);
        $df->fieldAsHidden(1);
        $df->fieldAsInput("title",["rules"=>"empty"]);
        $df->fieldAsDropDown("color",\array_combine($colors,$colors));
        $df->setValidationParams(["on"=>"blur","inline"=>true]);
        $df->setSubmitParams("tags/update","#frm",["attr"=>"","hasLoader"=>false]);
        $df->addSeparatorAfter("color");
        return $df;
    }

}

