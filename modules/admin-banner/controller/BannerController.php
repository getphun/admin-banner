<?php
/**
 * Banner management
 * @package admin-banner
 * @version 0.0.1
 * @upgrade true
 */

namespace AdminBanner\Controller;
use Banner\Model\Banner;

class BannerController extends \AdminController
{
    private function _defaultParams(){
        return [
            'title'             => 'Banner',
            'nav_title'         => 'Component',
            'active_menu'       => 'component',
            'active_submenu'    => 'banner',
            'total'             => 0
        ];
    }
    
    public function editAction(){
        if(!$this->user->login)
            return $this->show404();
        
        $id = $this->param->id;
        if(!$id && !$this->can_i->create_banner)
            return $this->show404();
        elseif($id && !$this->can_i->update_banner)
            return $this->show404();
        
        $old = null;
        $params = $this->_defaultParams();
        $params['title'] = 'Create New Banner';
        $params['jses'] = ['js/banner.js'];
        $params['ref'] = $this->req->getQuery('ref') ?? $this->router->to('adminBanner');
        
        // get all placements
        $params['placements'] = [];
        $placements = Banner::countGroup('placement');
        if($placements)
            $params['placements'] = array_keys($placements);
        
        if($id){
            $params['title'] = 'Edit Banner';
            $object = Banner::get($id, false);
            if(!$object)
                return $this->show404();
            $old = $object;
        }else{
            $object = new \stdClass();
            $object->user = $this->user->id;
            $object->type = 1;
        }
        
        if(false === ($form=$this->form->validate('admin-banner', $object)))
            return $this->respond('component/banner/edit', $params);

        $object = object_replace($object, $form);
        
        $event = 'updated';
        
        if(!$id){
            $event = 'created';
            if(false === ($id = Banner::create($object)))
                throw new \Exception(Banner::lastError());
        }else{
            $object->updated = null;
            if(false === Banner::set($object, $id))
                throw new \Exception(Banner::lastError());
        }
        
        $this->fire('banner:'. $event, $object, $old);
        
        return $this->redirect($params['ref']);
    }
    
    public function indexAction(){
        if(!$this->user->login)
            return $this->loginFirst('adminLogin');
        if(!$this->can_i->read_banner)
            return $this->show404();
        
        $params = $this->_defaultParams();
        $params['banners'] = Banner::get([], true, false, 'placement ASC, expired DESC, name ASC');
        $params['total'] = Banner::count();
        $params['reff']  = $this->req->url;
        
        return $this->respond('component/banner/index', $params);
    }
    
    public function removeAction(){
        if(!$this->user->login)
            return $this->show404();
        if(!$this->can_i->remove_banner)
            return $this->show404();
        
        $id = $this->param->id;
        $object = Banner::get($id, false);
        if(!$object)
            return $this->show404();
        
        $this->fire('banner:deleted', $object);
        Banner::remove($id);
        
        $ref = $this->req->getQuery('ref');
        if($ref)
            return $this->redirect($ref);
        
        return $this->redirectUrl('adminBanner');
    }
}