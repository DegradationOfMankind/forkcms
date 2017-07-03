<?php

namespace Backend\Modules\Pages\Ajax;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Backend\Core\Engine\Base\AjaxAction as BackendBaseAJAXAction;
use Backend\Core\Language\Language as BL;
use Backend\Modules\Pages\Engine\Model as BackendPagesModel;
use Symfony\Component\HttpFoundation\Response;

/**
 * This edit-action will reorder moved pages using Ajax
 */
class Move extends BackendBaseAJAXAction
{
    public function execute(): void
    {
        // call parent
        parent::execute();

        // get parameters
        $id = $this->getRequest()->request->getInt('id');
        $droppedOn = $this->getRequest()->request->getInt('dropped_on', -1);
        $typeOfDrop = $this->getRequest()->request->get('type', '');
        $tree = $this->getRequest()->request->get('tree');
        if (!in_array($tree, ['main', 'meta', 'footer', 'root'])) {
            $tree = '';
        }

        // init validation
        $errors = [];

        // validate
        if ($id === 0) {
            $errors[] = 'no id provided';
        }
        if ($droppedOn === -1) {
            $errors[] = 'no dropped_on provided';
        }
        if ($typeOfDrop == '') {
            $errors[] = 'no type provided';
        }
        if ($tree == '') {
            $errors[] = 'no tree provided';
        }

        // got errors
        if (!empty($errors)) {
            $this->output(self::BAD_REQUEST, ['errors' => $errors], 'not all fields were filled');
        } else {
            // get page
            $success = BackendPagesModel::move($id, $droppedOn, $typeOfDrop, $tree);

            // build cache
            BackendPagesModel::buildCache(BL::getWorkingLanguage());

            // output
            if ($success) {
                $this->output(self::OK, BackendPagesModel::get($id), 'page moved');
            } else {
                $this->output(self::ERROR, null, 'page not moved');
            }
        }
    }
}
