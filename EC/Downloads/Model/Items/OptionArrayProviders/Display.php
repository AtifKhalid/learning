<?php

namespace EC\Downloads\Model\Items\OptionArrayProviders;

class Display implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var array
     */
    protected $options;

    public function getOptions()
    {
        return [
            "1" 	=> "Display",
            "2" 	=> "Downloads",
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