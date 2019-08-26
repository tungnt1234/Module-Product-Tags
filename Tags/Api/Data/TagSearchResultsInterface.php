<?php

namespace TungNguyen\Tags\Api\Data;

interface TagSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Tag list.
     * @return \TungNguyen\Tags\Api\Data\TagInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \TungNguyen\Tags\Api\Data\TagInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}