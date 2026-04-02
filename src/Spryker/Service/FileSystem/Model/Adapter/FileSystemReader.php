<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\FileSystem\Model\Adapter;

use Generated\Shared\Transfer\FileSystemListTransfer;
use Generated\Shared\Transfer\FileSystemQueryTransfer;
use Spryker\Service\FileSystem\Model\FileSystemReaderInterface;
use Spryker\Service\FileSystemExtension\Dependency\Exception\FileSystemReadException;
use Spryker\Service\FileSystemExtension\Dependency\Plugin\FileSystemPublicUrlGeneratorPluginInterface;
use Spryker\Service\FileSystemExtension\Dependency\Plugin\FileSystemReaderPluginInterface;

class FileSystemReader implements FileSystemReaderInterface
{
    public function __construct(protected FileSystemReaderPluginInterface $fileSystemReaderPlugin)
    {
    }

    /**
     * @param \Generated\Shared\Transfer\FileSystemQueryTransfer $fileSystemQueryTransfer
     *
     * @return string
     */
    public function getMimeType(FileSystemQueryTransfer $fileSystemQueryTransfer)
    {
        return $this->fileSystemReaderPlugin->getMimeType($fileSystemQueryTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FileSystemQueryTransfer $fileSystemQueryTransfer
     *
     * @return int|null
     */
    public function getTimestamp(FileSystemQueryTransfer $fileSystemQueryTransfer)
    {
        return $this->fileSystemReaderPlugin->getTimestamp($fileSystemQueryTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FileSystemQueryTransfer $fileSystemQueryTransfer
     *
     * @return int
     */
    public function getSize(FileSystemQueryTransfer $fileSystemQueryTransfer)
    {
        return $this->fileSystemReaderPlugin->getSize($fileSystemQueryTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FileSystemQueryTransfer $fileSystemQueryTransfer
     *
     * @return bool
     */
    public function isPrivate(FileSystemQueryTransfer $fileSystemQueryTransfer)
    {
        return $this->fileSystemReaderPlugin->isPrivate($fileSystemQueryTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FileSystemQueryTransfer $fileSystemQueryTransfer
     *
     * @return string
     */
    public function read(FileSystemQueryTransfer $fileSystemQueryTransfer)
    {
        return $this->fileSystemReaderPlugin->read($fileSystemQueryTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FileSystemListTransfer $fileSystemListTransfer
     *
     * @return array<\Generated\Shared\Transfer\FileSystemResourceTransfer>
     */
    public function listContents(FileSystemListTransfer $fileSystemListTransfer)
    {
        return $this->fileSystemReaderPlugin->listContents($fileSystemListTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FileSystemQueryTransfer $fileSystemQueryTransfer
     *
     * @return bool
     */
    public function has(FileSystemQueryTransfer $fileSystemQueryTransfer)
    {
        return $this->fileSystemReaderPlugin->has($fileSystemQueryTransfer);
    }

    public function getPublicUrl(FileSystemQueryTransfer $fileSystemQueryTransfer): string
    {
        if (!$this->fileSystemReaderPlugin instanceof FileSystemPublicUrlGeneratorPluginInterface) {
            throw new FileSystemReadException(sprintf(
                'Plugin %s does not implement %s.',
                $this->fileSystemReaderPlugin::class,
                FileSystemPublicUrlGeneratorPluginInterface::class,
            ));
        }

        return $this->fileSystemReaderPlugin->getPublicUrl($fileSystemQueryTransfer);
    }
}
