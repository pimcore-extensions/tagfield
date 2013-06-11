<?php
class Tagfield_AdminController extends Pimcore_Controller_Action_Admin {
    
    public function init(){
        parent::init();
        
        
    }
    
    public function gettagsAction(){
       $key= $this->_getParam("key");
       $table = new Tagfield_Tagfield();

       $tags = $table->getTagsByKey($key);
       $datas = array();
       foreach($tags as $tag){
           $datas[]=array("value"=>$tag["tag"]);
       }
       
       $this->_helper->json(array("datas"=>$datas));
        
    }
    
    
}
?>
