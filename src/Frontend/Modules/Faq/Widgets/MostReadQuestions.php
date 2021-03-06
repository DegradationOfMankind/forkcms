<?php

namespace Frontend\Modules\Faq\Widgets;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Frontend\Modules\Faq\Engine\Model as FrontendFaqModel;

/**
 * This is a widget with most read faq-questions
 */
class MostReadQuestions extends FrontendBaseWidget
{
    public function execute(): void
    {
        // call parent
        parent::execute();

        $this->loadTemplate();
        $this->parse();
    }

    private function parse(): void
    {
        $this->template->assign(
            'widgetFaqMostRead',
            FrontendFaqModel::getMostRead($this->get('fork.settings')->get('Faq', 'most_read_num_items', 10))
        );
    }
}
