<?php
/**
 * Hello World
    *
    * @category    QaisarSatti
    * @package     QaisarSatti_HelloWorld
    * @author      Muhammad Qaisar Satti
    * @Email       qaisarssatti@gmail.com
    *
 */
namespace Mag\Form\Block\Adminhtml\Form\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class BackButton
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", 
                $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

   
}