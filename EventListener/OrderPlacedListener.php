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

namespace OrderAdditionalInformation\EventListener;

use OrderAdditionalInformation\Model\OrderAdditionalInformation as OrderAdditionalInformationModel;
use OrderAdditionalInformation\OrderAdditionalInformation as OrderAdditionalInformationModule;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\Order\OrderEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\Event\TheliaFormEvent;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Core\Translation\Translator;
use Thelia\Form\OrderPayment;

class OrderPlacedListener extends BaseAction implements EventSubscriberInterface
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getCustomerComment(OrderEvent $event)
    {
        /** @var OrderPayment $orderPaymentForm */
        //$orderPaymentForm = new OrderPayment($this->request);

        //$comment = trim($orderPaymentForm->getForm()->get("comment")->getData());
        //$comment_id = trim($orderPaymentForm->getForm()->get("comment_id")->getData());

        // We do not have an order ID at the moment, juste store the comment in the user session.
        $comments = $this->request->get('comment', []);

        $this->request->getSession()->set('additional_order_comment', $comments);
    }

    public function storeCustomerComment(OrderEvent $event)
    {
        // Now, we have an order ID. Store the customer comment in the session.
        $sessionComments = $this->request->getSession()->get('additional_order_comment', []);

        foreach ($sessionComments as $identifier => $comment) {
            if (empty($comment)) {
                continue;
            }

            $oai = new OrderAdditionalInformationModel();
            $oai
                ->setOrderId($event->getOrder()->getId())
                ->setInformation($comment)
                ->setIdentifier($identifier)
                ->save();
        }
    }

    public function addCommentField(TheliaFormEvent $event)
    {
        $form = $event->getForm();

        $form->getFormBuilder()->add(
            'comment',
            'text',
            [
                'constraints' => [ ],
                'label' => Translator::getInstance()->trans(
                    'Additional information',
                    [],
                    OrderAdditionalInformationModule::DOMAIN_NAME
                ),
                'label_attr' => [
                    'for' => 'pricefield',
                    'help' => Translator::getInstance()->trans(
                        'Enter here any information for our order processing team',
                        [],
                        OrderAdditionalInformationModule::DOMAIN_NAME
                    ),
                ],
            ]
        )->add(
            'comment_id',
            'hidden',
            [
                'required' => false
            ]
        );
    }

    public static function getSubscribedEvents()
    {
        return [
            TheliaEvents::ORDER_SET_INVOICE_ADDRESS => array("getCustomerComment", 10),
            TheliaEvents::ORDER_BEFORE_PAYMENT => array("storeCustomerComment", 10),
            // TheliaEvents::FORM_BEFORE_BUILD . ".thelia_order_payment" => array("addCommentField", 130),
        ];
    }
}
