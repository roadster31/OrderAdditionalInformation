<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace OrderAdditionalInformation\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;


/**
 * Class CarouselHook
 * @package Carousel\Hook
 * @author  Franck Allimant <franck@cqfdev.fr>
 */
class HookProcessing extends BaseHook
{

    public function displayAdditionalInfo(HookRenderEvent $event)
    {
        $event->add(
            $this->render('additional-order-info.html')
        );
    }

    public function displayPdfAdditionalInfo(HookRenderEvent $event)
    {
        $event->add(
            $this->render('additional-pdf-order-info.html')
        );
    }
}