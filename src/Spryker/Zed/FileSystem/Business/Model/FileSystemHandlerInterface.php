<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\FileSystem\Business\Model;

interface FileSystemHandlerInterface
{

    /**
     * @param string $fileSystemName
     * @param string $path
     *
     * @return string|false The file contents or false on failure.
     */
    public function delete($fileSystemName, $path);

    /**
     * @param string $fileSystemName
     * @param string $path
     *
     * @return bool
     */
    public function has($fileSystemName, $path);

    /**
     * @param string $fileSystemName
     * @param string $path
     * @param string $content
     * @param array $config
     *
     * @return bool True on success, false on failure.
     */
    public function put($fileSystemName, $path, $content, array $config = []);

    /**
     * @param string $fileSystemName
     * @param string $path
     *
     * @return string|false The file contents or false on failure.
     */
    public function read($fileSystemName, $path);

    /**
     * @param string $fileSystemName
     * @param string $newpath
     * @param string $path
     *
     * @return string|false The file contents or false on failure.
     */
    public function rename($fileSystemName, $path, $newpath);

    /**
     * @param string $fileSystemName
     * @param string $path
     * @param string $content
     * @param array $config
     *
     * @return bool True on success, false on failure.
     */
    public function update($fileSystemName, $path, $content, array $config = []);

    /**
     * @param string $fileSystemName
     * @param string $path
     * @param string $content
     * @param array $config
     *
     * @return bool True on success, false on failure.
     */
    public function write($fileSystemName, $path, $content, array $config = []);

}
