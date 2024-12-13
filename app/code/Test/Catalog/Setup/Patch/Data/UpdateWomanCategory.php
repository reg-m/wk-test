<?php
namespace Test\Catalog\Setup\Patch\Data;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class UpdateWomanCategory implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private CategoryRepositoryInterface $categoryRepository;
    private CategoryFactory $categoryFactory;
    private Filesystem $filesystem;

    const IMAGE_PATH = 'catalog/category/desktop-background.jpg';
    const TOPS_CATEGORY_ID = 21;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategoryRepositoryInterface $categoryRepository,
        CategoryFactory $categoryFactory,
        Filesystem $filesystem
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categoryRepository = $categoryRepository;
        $this->categoryFactory = $categoryFactory;
        $this->filesystem = $filesystem;
    }

    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $categoryId = self::TOPS_CATEGORY_ID;

        try {
            $category = $this->categoryRepository->get($categoryId, null);
        } catch (NoSuchEntityException $e) {
            $this->moduleDataSetup->getConnection()->endSetup();
            return;
        }

        if ($category->getId()) {
            $category->setName('Category Title');
            $category->setData('subtitle', 'Subtitle for Category');
            $category->setData('description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.');

            if ($this->saveImage()) {
                $category->setImage(self::IMAGE_PATH);
            }

            $this->categoryRepository->save($category);
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    private function saveImage() : bool {
        $mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);

        try {
            $mediaDirectory->writeFile(
                self::IMAGE_PATH,
                file_get_contents(__DIR__ . '/../Media/desktop-background.jpg')
            );
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
