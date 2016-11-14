<?php

namespace War\BlogBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class CommentAdminController extends Controller
{
/*    public function batchActionExtend(ProxyQueryInterface $selectedModelQuery)
    {
        if ($this->admin->isGranted('EDIT') === false || $this->admin->isGranted('DELETE') === false) 
        { throw new AccessDeniedException(); }
        $modelManager = $this->admin->getModelManager();
        $selectedModels = $selectedModelQuery->execute();

        try {
            foreach ($selectedModels as $selectedModel) 
                {
                $selectedModel->extend();
                $modelManager->update($selectedModel);
                }
            } 
        catch (\Exception $e) 
            {
            $this->get('session')->getFlashBag()->add('sonata_flash_error', $e->getMessage());
            return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));
            }
        $this->get('session')->getFlashBag()->add('sonata_flash_success',  sprintf('Ok.'));
        return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
    }*/
}
