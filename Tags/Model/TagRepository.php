<?php
namespace TungNguyen\Tags\Model;

use TungNguyen\Tags\Api\Data;
use TungNguyen\Tags\Api\TagRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use TungNguyen\Tags\Model\ResourceModel\Tag as ResourceTag;
use TungNguyen\Tags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;
/**
 * Class PostRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class TagRepository implements TagRepositoryInterface
{
    /**
     * @var ResourcePost
     */
    protected $resource;

    /**
     * @var PostFactory
     */
    protected $tagFactory;

    /**
     * @var PostCollectionFactory
     */
    protected $TagCollectionFactory;

    /**
     * @var Data\PostSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @param ResourcePost $resource
     * @param PostFactory $PostFactory
     * @param Data\PostInterfaceFactory $dataPostFactory
     * @param PostCollectionFactory $PostCollectionFactory
     * @param Data\PostSearchResultsInterfaceFactory $searchResultsFactory
     */
    private $collectionProcessor;

    public function __construct(
        ResourceTag $resource,
        tagFactory $tagFactory,
        Data\TagInterfaceFactory $dataTagFactory,
        TagCollectionFactory $TagCollectionFactory
    ) {
        $this->resource = $resource;
        $this->tagFactory = $tagFactory;
        $this->TagCollectionFactory = $TagCollectionFactory;
        // $this->searchResultsFactory = $searchResultsFactory;
        // $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Post data
     *
     * @param \AHT\Blog\Api\Data\PostInterface $Post
     * @return Post
     * @throws CouldNotSaveException
     */
    public function save(\TungNguyen\Tags\Api\Data\TagInterface $Tag)
    {
       
        try {
            $this->resource->save($Tag);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Tag: %1', $exception->getMessage()),
                $exception
            );
        }
        return $Tag;
    }

    /**
     * Load Post data by given Post Identity
     *
     * @param string $PostId
     * @return Post
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($TagId)
    {
        $Tag = $this->tagFactory->create();
        $Tag->load($TagId);
        if (!$Tag->getId()) {
            throw new NoSuchEntityException(__('The CMS Tag with the "%1" ID doesn\'t exist.', $TagId));
        }
        return $Tag;
    }

    /**
     * Load Post data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \AHT\Blog\Api\Data\PostSearchResultsInterface
     */
    public function getList()
    {
        /** @var \AHT\Blog\Model\ResourceModel\Post\Collection $collection */
        $collection = $this->TagCollectionFactory->create();
        return $collection;
    }

    /**
     * Delete Post
     *
     * @param \AHT\Blog\Api\Data\PostInterface $Post
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\TungNguyen\Tags\Api\Data\TagInterface $Tag)
    {
        try {
            $this->resource->delete($Tag);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Tag: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * Delete Post by given Post Identity
     *
     * @param string $PostId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($TagId)
    {
        return $this->delete($this->getById($TagId));
    }
}