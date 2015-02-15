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

namespace OrderAdditionalInformation\Form;

use OrderAdditionalInformation\OrderAdditionalInformation;
use Thelia\Form\OrderPayment;

class OrderPaymentExtended extends OrderPayment
{
    protected function buildForm()
    {
        parent::buildForm();

        $this->formBuilder
            ->add(
                'comment',
                'text',
                [
                    'constraints' => [ ],
                    'label' => $this->translator->trans(
                        'Additional information',
                        [],
                        OrderAdditionalInformation::DOMAIN_NAME
                    ),
                    'label_attr' => [
                        'for' => 'pricefield',
                        'help' => $this->translator->trans(
                            'Enter here any information for our order processing team',
                            [],
                            OrderAdditionalInformation::DOMAIN_NAME
                        ),
                    ],
                ]
            )
        ;
    }

    public function getName()
    {
        return "thelia_order_payment_extended";
    }
}