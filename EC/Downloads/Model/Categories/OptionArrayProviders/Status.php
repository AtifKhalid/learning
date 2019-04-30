<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 4/15/19
 * Time: 8:32 PM
 */

namespace EC\Downloads\Model\Categories\OptionArrayProviders;


class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var array
     */
    protected $options;

    public function getOptions()
    {
        return [
            "0" 	=> "Disabled",
            "1" 	=> "Enabled",
        ];
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }

        $options = [];
        foreach ($this->getOptions() as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        $this->options = $options;
        return $this->options;
    }

}