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

namespace OrderAdditionalInformation\Loop;

use OrderAdditionalInformation\Model\Base\OrderAdditionalInformationQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Element\SearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;

use Thelia\Model\CustomerQuery;
use Thelia\Model\Map\CustomerTableMap;
use Thelia\Model\Map\OrderAddressTableMap;
use Thelia\Model\OrderAddressQuery;
use Thelia\Model\OrderQuery;
use Thelia\Type;
use Thelia\Type\TypeCollection;

/**
 *
 * @package Thelia\Core\Template\Loop
 *
 * @author Franck Allimant <franck@cqfdev.fr>
 * @author Etienne Roudeix <eroudeix@openstudio.fr>
 */
class OrderAdditionalInformation extends BaseLoop implements PropelSearchLoopInterface
{
    protected $countable = true;

    public function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntListTypeArgument('order_id', null, true)
        );
    }

    public function buildModelCriteria()
    {
        return OrderAdditionalInformationQuery::create()
            ->filterByOrderId($this->getOrderId());
    }

    public function parseResults(LoopResult $loopResult)
    {
        /**  @var \OrderAdditionalInformation\Model\OrderAdditionalInformation $orderAdditionalInformation */
        foreach ($loopResult->getResultDataCollection() as $orderAdditionalInformation) {
            $loopResultRow = new LoopResultRow($orderAdditionalInformation);
            $loopResultRow
                ->set('ID', $orderAdditionalInformation->getId())
                ->set('ORDER_ID', $orderAdditionalInformation->getOrderId())
                ->set('INFORMATION', $orderAdditionalInformation->getInformation())
            ;

            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }
}
