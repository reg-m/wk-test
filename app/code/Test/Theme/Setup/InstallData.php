<?php
namespace Test\Theme\Setup;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Store\Model\Store;

class InstallData implements InstallDataInterface
{
    protected WriterInterface $writer;

    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context): void
    {
        $setup->startSetup();

        $this->writer->save(
            'design/theme/theme_id',
            'Test/default',
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            Store::DEFAULT_STORE_ID
        );

        $setup->endSetup();
    }
}
