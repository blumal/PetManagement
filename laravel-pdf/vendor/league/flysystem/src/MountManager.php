<?php

<<<<<<< HEAD
declare(strict_types=1);

namespace League\Flysystem;

use Throwable;

use function sprintf;

class MountManager implements FilesystemOperator
{
    /**
     * @var array<string, FilesystemOperator>
     */
    private $filesystems = [];

    /**
     * MountManager constructor.
     *
     * @param array<string,FilesystemOperator> $filesystems
=======
namespace League\Flysystem;

use InvalidArgumentException;
use League\Flysystem\Plugin\PluggableTrait;
use League\Flysystem\Plugin\PluginNotFoundException;

/**
 * Class MountManager.
 *
 * Proxies methods to Filesystem (@see __call):
 *
 * @method AdapterInterface getAdapter($prefix)
 * @method Config getConfig($prefix)
 * @method array listFiles($directory = '', $recursive = false)
 * @method array listPaths($directory = '', $recursive = false)
 * @method array getWithMetadata($path, array $metadata)
 * @method Filesystem flushCache()
 * @method void assertPresent($path)
 * @method void assertAbsent($path)
 * @method Filesystem addPlugin(PluginInterface $plugin)
 */
class MountManager implements FilesystemInterface
{
    use PluggableTrait;

    /**
     * @var FilesystemInterface[]
     */
    protected $filesystems = [];

    /**
     * Constructor.
     *
     * @param FilesystemInterface[] $filesystems [:prefix => Filesystem,]
     *
     * @throws InvalidArgumentException
>>>>>>> origin/New-FakeMain
     */
    public function __construct(array $filesystems = [])
    {
        $this->mountFilesystems($filesystems);
    }

<<<<<<< HEAD
    public function fileExists(string $location): bool
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->fileExists($path);
        } catch (Throwable $exception) {
            throw UnableToCheckFileExistence::forLocation($location, $exception);
        }
    }

    public function has(string $location): bool
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->fileExists($path) || $filesystem->directoryExists($path);
        } catch (Throwable $exception) {
            throw UnableToCheckExistence::forLocation($location, $exception);
        }
    }

    public function directoryExists(string $location): bool
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->directoryExists($path);
        } catch (Throwable $exception) {
            throw UnableToCheckDirectoryExistence::forLocation($location, $exception);
        }
    }

    public function read(string $location): string
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->read($path);
        } catch (UnableToReadFile $exception) {
            throw UnableToReadFile::fromLocation($location, $exception->reason(), $exception);
        }
    }

    public function readStream(string $location)
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->readStream($path);
        } catch (UnableToReadFile $exception) {
            throw UnableToReadFile::fromLocation($location, $exception->reason(), $exception);
        }
    }

    public function listContents(string $location, bool $deep = self::LIST_SHALLOW): DirectoryListing
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path, $mountIdentifier] = $this->determineFilesystemAndPath($location);

        return
            $filesystem
                ->listContents($path, $deep)
                ->map(
                    function (StorageAttributes $attributes) use ($mountIdentifier) {
                        return $attributes->withPath(sprintf('%s://%s', $mountIdentifier, $attributes->path()));
                    }
                );
    }

    public function lastModified(string $location): int
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->lastModified($path);
        } catch (UnableToRetrieveMetadata $exception) {
            throw UnableToRetrieveMetadata::lastModified($location, $exception->reason(), $exception);
        }
    }

    public function fileSize(string $location): int
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->fileSize($path);
        } catch (UnableToRetrieveMetadata $exception) {
            throw UnableToRetrieveMetadata::fileSize($location, $exception->reason(), $exception);
        }
    }

    public function mimeType(string $location): string
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->mimeType($path);
        } catch (UnableToRetrieveMetadata $exception) {
            throw UnableToRetrieveMetadata::mimeType($location, $exception->reason(), $exception);
        }
    }

    public function visibility(string $location): string
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            return $filesystem->visibility($path);
        } catch (UnableToRetrieveMetadata $exception) {
            throw UnableToRetrieveMetadata::visibility($location, $exception->reason(), $exception);
        }
    }

    public function write(string $location, string $contents, array $config = []): void
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            $filesystem->write($path, $contents, $config);
        } catch (UnableToWriteFile $exception) {
            throw UnableToWriteFile::atLocation($location, $exception->reason(), $exception);
        }
    }

    public function writeStream(string $location, $contents, array $config = []): void
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);
        $filesystem->writeStream($path, $contents, $config);
    }

    public function setVisibility(string $path, string $visibility): void
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($path);
        $filesystem->setVisibility($path, $visibility);
    }

    public function delete(string $location): void
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            $filesystem->delete($path);
        } catch (UnableToDeleteFile $exception) {
            throw UnableToDeleteFile::atLocation($location, '', $exception);
        }
    }

    public function deleteDirectory(string $location): void
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            $filesystem->deleteDirectory($path);
        } catch (UnableToDeleteDirectory $exception) {
            throw UnableToDeleteDirectory::atLocation($location, '', $exception);
        }
    }

    public function createDirectory(string $location, array $config = []): void
    {
        /** @var FilesystemOperator $filesystem */
        [$filesystem, $path] = $this->determineFilesystemAndPath($location);

        try {
            $filesystem->createDirectory($path, $config);
        } catch (UnableToCreateDirectory $exception) {
            throw UnableToCreateDirectory::dueToFailure($location, $exception);
        }
    }

    public function move(string $source, string $destination, array $config = []): void
    {
        /** @var FilesystemOperator $sourceFilesystem */
        /* @var FilesystemOperator $destinationFilesystem */
        [$sourceFilesystem, $sourcePath] = $this->determineFilesystemAndPath($source);
        [$destinationFilesystem, $destinationPath] = $this->determineFilesystemAndPath($destination);

        $sourceFilesystem === $destinationFilesystem ? $this->moveInTheSameFilesystem(
            $sourceFilesystem,
            $sourcePath,
            $destinationPath,
            $source,
            $destination
        ) : $this->moveAcrossFilesystems($source, $destination);
    }

    public function copy(string $source, string $destination, array $config = []): void
    {
        /** @var FilesystemOperator $sourceFilesystem */
        /* @var FilesystemOperator $destinationFilesystem */
        [$sourceFilesystem, $sourcePath] = $this->determineFilesystemAndPath($source);
        [$destinationFilesystem, $destinationPath] = $this->determineFilesystemAndPath($destination);

        $sourceFilesystem === $destinationFilesystem ? $this->copyInSameFilesystem(
            $sourceFilesystem,
            $sourcePath,
            $destinationPath,
            $source,
            $destination
        ) : $this->copyAcrossFilesystem(
            $config['visibility'] ?? null,
            $sourceFilesystem,
            $sourcePath,
            $destinationFilesystem,
            $destinationPath,
            $source,
            $destination
        );
    }

    private function mountFilesystems(array $filesystems): void
    {
        foreach ($filesystems as $key => $filesystem) {
            $this->guardAgainstInvalidMount($key, $filesystem);
            /* @var string $key */
            /* @var FilesystemOperator $filesystem */
            $this->mountFilesystem($key, $filesystem);
        }
    }

    /**
     * @param mixed $key
     * @param mixed $filesystem
     */
    private function guardAgainstInvalidMount($key, $filesystem): void
    {
        if ( ! is_string($key)) {
            throw UnableToMountFilesystem::becauseTheKeyIsNotValid($key);
        }

        if ( ! $filesystem instanceof FilesystemOperator) {
            throw UnableToMountFilesystem::becauseTheFilesystemWasNotValid($filesystem);
        }
    }

    private function mountFilesystem(string $key, FilesystemOperator $filesystem): void
    {
        $this->filesystems[$key] = $filesystem;
=======
    /**
     * Mount filesystems.
     *
     * @param FilesystemInterface[] $filesystems [:prefix => Filesystem,]
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function mountFilesystems(array $filesystems)
    {
        foreach ($filesystems as $prefix => $filesystem) {
            $this->mountFilesystem($prefix, $filesystem);
        }

        return $this;
    }

    /**
     * Mount filesystems.
     *
     * @param string              $prefix
     * @param FilesystemInterface $filesystem
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function mountFilesystem($prefix, FilesystemInterface $filesystem)
    {
        if ( ! is_string($prefix)) {
            throw new InvalidArgumentException(__METHOD__ . ' expects argument #1 to be a string.');
        }

        $this->filesystems[$prefix] = $filesystem;

        return $this;
    }

    /**
     * Get the filesystem with the corresponding prefix.
     *
     * @param string $prefix
     *
     * @throws FilesystemNotFoundException
     *
     * @return FilesystemInterface
     */
    public function getFilesystem($prefix)
    {
        if ( ! isset($this->filesystems[$prefix])) {
            throw new FilesystemNotFoundException('No filesystem mounted with prefix ' . $prefix);
        }

        return $this->filesystems[$prefix];
    }

    /**
     * Retrieve the prefix from an arguments array.
     *
     * @param array $arguments
     *
     * @throws InvalidArgumentException
     *
     * @return array [:prefix, :arguments]
     */
    public function filterPrefix(array $arguments)
    {
        if (empty($arguments)) {
            throw new InvalidArgumentException('At least one argument needed');
        }

        $path = array_shift($arguments);

        if ( ! is_string($path)) {
            throw new InvalidArgumentException('First argument should be a string');
        }

        list($prefix, $path) = $this->getPrefixAndPath($path);
        array_unshift($arguments, $path);

        return [$prefix, $arguments];
    }

    /**
     * @param string $directory
     * @param bool   $recursive
     *
     * @throws InvalidArgumentException
     * @throws FilesystemNotFoundException
     *
     * @return array
     */
    public function listContents($directory = '', $recursive = false)
    {
        list($prefix, $directory) = $this->getPrefixAndPath($directory);
        $filesystem = $this->getFilesystem($prefix);
        $result = $filesystem->listContents($directory, $recursive);

        foreach ($result as &$file) {
            $file['filesystem'] = $prefix;
        }

        return $result;
    }

    /**
     * Call forwarder.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @throws InvalidArgumentException
     * @throws FilesystemNotFoundException
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        list($prefix, $arguments) = $this->filterPrefix($arguments);

        return $this->invokePluginOnFilesystem($method, $arguments, $prefix);
    }

    /**
     * @param string $from
     * @param string $to
     * @param array  $config
     *
     * @throws InvalidArgumentException
     * @throws FilesystemNotFoundException
     * @throws FileExistsException
     *
     * @return bool
     */
    public function copy($from, $to, array $config = [])
    {
        list($prefixFrom, $from) = $this->getPrefixAndPath($from);

        $buffer = $this->getFilesystem($prefixFrom)->readStream($from);

        if ($buffer === false) {
            return false;
        }

        list($prefixTo, $to) = $this->getPrefixAndPath($to);

        $result = $this->getFilesystem($prefixTo)->writeStream($to, $buffer, $config);

        if (is_resource($buffer)) {
            fclose($buffer);
        }

        return $result;
    }

    /**
     * List with plugin adapter.
     *
     * @param array  $keys
     * @param string $directory
     * @param bool   $recursive
     *
     * @throws InvalidArgumentException
     * @throws FilesystemNotFoundException
     *
     * @return array
     */
    public function listWith(array $keys = [], $directory = '', $recursive = false)
    {
        list($prefix, $directory) = $this->getPrefixAndPath($directory);
        $arguments = [$keys, $directory, $recursive];

        return $this->invokePluginOnFilesystem('listWith', $arguments, $prefix);
    }

    /**
     * Move a file.
     *
     * @param string $from
     * @param string $to
     * @param array  $config
     *
     * @throws InvalidArgumentException
     * @throws FilesystemNotFoundException
     *
     * @return bool
     */
    public function move($from, $to, array $config = [])
    {
        list($prefixFrom, $pathFrom) = $this->getPrefixAndPath($from);
        list($prefixTo, $pathTo) = $this->getPrefixAndPath($to);

        if ($prefixFrom === $prefixTo) {
            $filesystem = $this->getFilesystem($prefixFrom);
            $renamed = $filesystem->rename($pathFrom, $pathTo);

            if ($renamed && isset($config['visibility'])) {
                return $filesystem->setVisibility($pathTo, $config['visibility']);
            }

            return $renamed;
        }

        $copied = $this->copy($from, $to, $config);

        if ($copied) {
            return $this->delete($from);
        }

        return false;
    }

    /**
     * Invoke a plugin on a filesystem mounted on a given prefix.
     *
     * @param string $method
     * @param array  $arguments
     * @param string $prefix
     *
     * @throws FilesystemNotFoundException
     *
     * @return mixed
     */
    public function invokePluginOnFilesystem($method, $arguments, $prefix)
    {
        $filesystem = $this->getFilesystem($prefix);

        try {
            return $this->invokePlugin($method, $arguments, $filesystem);
        } catch (PluginNotFoundException $e) {
            // Let it pass, it's ok, don't panic.
        }

        $callback = [$filesystem, $method];

        return call_user_func_array($callback, $arguments);
>>>>>>> origin/New-FakeMain
    }

    /**
     * @param string $path
     *
<<<<<<< HEAD
     * @return array{0:FilesystemOperator, 1:string}
     */
    private function determineFilesystemAndPath(string $path): array
    {
        if (strpos($path, '://') < 1) {
            throw UnableToResolveFilesystemMount::becauseTheSeparatorIsMissing($path);
        }

        /** @var string $mountIdentifier */
        /** @var string $mountPath */
        [$mountIdentifier, $mountPath] = explode('://', $path, 2);

        if ( ! array_key_exists($mountIdentifier, $this->filesystems)) {
            throw UnableToResolveFilesystemMount::becauseTheMountWasNotRegistered($mountIdentifier);
        }

        return [$this->filesystems[$mountIdentifier], $mountPath, $mountIdentifier];
    }

    private function copyInSameFilesystem(
        FilesystemOperator $sourceFilesystem,
        string $sourcePath,
        string $destinationPath,
        string $source,
        string $destination
    ): void {
        try {
            $sourceFilesystem->copy($sourcePath, $destinationPath);
        } catch (UnableToCopyFile $exception) {
            throw UnableToCopyFile::fromLocationTo($source, $destination, $exception);
        }
    }

    private function copyAcrossFilesystem(
        ?string $visibility,
        FilesystemOperator $sourceFilesystem,
        string $sourcePath,
        FilesystemOperator $destinationFilesystem,
        string $destinationPath,
        string $source,
        string $destination
    ): void {
        try {
            $visibility = $visibility ?? $sourceFilesystem->visibility($sourcePath);
            $stream = $sourceFilesystem->readStream($sourcePath);
            $destinationFilesystem->writeStream($destinationPath, $stream, compact('visibility'));
        } catch (UnableToRetrieveMetadata | UnableToReadFile | UnableToWriteFile $exception) {
            throw UnableToCopyFile::fromLocationTo($source, $destination, $exception);
        }
    }

    private function moveInTheSameFilesystem(
        FilesystemOperator $sourceFilesystem,
        string $sourcePath,
        string $destinationPath,
        string $source,
        string $destination
    ): void {
        try {
            $sourceFilesystem->move($sourcePath, $destinationPath);
        } catch (UnableToMoveFile $exception) {
            throw UnableToMoveFile::fromLocationTo($source, $destination, $exception);
        }
    }

    private function moveAcrossFilesystems(string $source, string $destination): void
    {
        try {
            $this->copy($source, $destination);
            $this->delete($source);
        } catch (UnableToCopyFile | UnableToDeleteFile $exception) {
            throw UnableToMoveFile::fromLocationTo($source, $destination, $exception);
        }
=======
     * @throws InvalidArgumentException
     *
     * @return string[] [:prefix, :path]
     */
    protected function getPrefixAndPath($path)
    {
        if (strpos($path, '://') < 1) {
            throw new InvalidArgumentException('No prefix detected in path: ' . $path);
        }

        return explode('://', $path, 2);
    }

    /**
     * Check whether a file exists.
     *
     * @param string $path
     *
     * @return bool
     */
    public function has($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->has($path);
    }

    /**
     * Read a file.
     *
     * @param string $path The path to the file.
     *
     * @throws FileNotFoundException
     *
     * @return string|false The file contents or false on failure.
     */
    public function read($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->read($path);
    }

    /**
     * Retrieves a read-stream for a path.
     *
     * @param string $path The path to the file.
     *
     * @throws FileNotFoundException
     *
     * @return resource|false The path resource or false on failure.
     */
    public function readStream($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->readStream($path);
    }

    /**
     * Get a file's metadata.
     *
     * @param string $path The path to the file.
     *
     * @throws FileNotFoundException
     *
     * @return array|false The file metadata or false on failure.
     */
    public function getMetadata($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->getMetadata($path);
    }

    /**
     * Get a file's size.
     *
     * @param string $path The path to the file.
     *
     * @throws FileNotFoundException
     *
     * @return int|false The file size or false on failure.
     */
    public function getSize($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->getSize($path);
    }

    /**
     * Get a file's mime-type.
     *
     * @param string $path The path to the file.
     *
     * @throws FileNotFoundException
     *
     * @return string|false The file mime-type or false on failure.
     */
    public function getMimetype($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->getMimetype($path);
    }

    /**
     * Get a file's timestamp.
     *
     * @param string $path The path to the file.
     *
     * @throws FileNotFoundException
     *
     * @return string|false The timestamp or false on failure.
     */
    public function getTimestamp($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->getTimestamp($path);
    }

    /**
     * Get a file's visibility.
     *
     * @param string $path The path to the file.
     *
     * @throws FileNotFoundException
     *
     * @return string|false The visibility (public|private) or false on failure.
     */
    public function getVisibility($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->getVisibility($path);
    }

    /**
     * Write a new file.
     *
     * @param string $path     The path of the new file.
     * @param string $contents The file contents.
     * @param array  $config   An optional configuration array.
     *
     * @throws FileExistsException
     *
     * @return bool True on success, false on failure.
     */
    public function write($path, $contents, array $config = [])
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->write($path, $contents, $config);
    }

    /**
     * Write a new file using a stream.
     *
     * @param string   $path     The path of the new file.
     * @param resource $resource The file handle.
     * @param array    $config   An optional configuration array.
     *
     * @throws InvalidArgumentException If $resource is not a file handle.
     * @throws FileExistsException
     *
     * @return bool True on success, false on failure.
     */
    public function writeStream($path, $resource, array $config = [])
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->writeStream($path, $resource, $config);
    }

    /**
     * Update an existing file.
     *
     * @param string $path     The path of the existing file.
     * @param string $contents The file contents.
     * @param array  $config   An optional configuration array.
     *
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function update($path, $contents, array $config = [])
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->update($path, $contents, $config);
    }

    /**
     * Update an existing file using a stream.
     *
     * @param string   $path     The path of the existing file.
     * @param resource $resource The file handle.
     * @param array    $config   An optional configuration array.
     *
     * @throws InvalidArgumentException If $resource is not a file handle.
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function updateStream($path, $resource, array $config = [])
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->updateStream($path, $resource, $config);
    }

    /**
     * Rename a file.
     *
     * @param string $path    Path to the existing file.
     * @param string $newpath The new path of the file.
     *
     * @throws FileExistsException   Thrown if $newpath exists.
     * @throws FileNotFoundException Thrown if $path does not exist.
     *
     * @return bool True on success, false on failure.
     */
    public function rename($path, $newpath)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->rename($path, $newpath);
    }

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function delete($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->delete($path);
    }

    /**
     * Delete a directory.
     *
     * @param string $dirname
     *
     * @throws RootViolationException Thrown if $dirname is empty.
     *
     * @return bool True on success, false on failure.
     */
    public function deleteDir($dirname)
    {
        list($prefix, $dirname) = $this->getPrefixAndPath($dirname);

        return $this->getFilesystem($prefix)->deleteDir($dirname);
    }

    /**
     * Create a directory.
     *
     * @param string $dirname The name of the new directory.
     * @param array  $config  An optional configuration array.
     *
     * @return bool True on success, false on failure.
     */
    public function createDir($dirname, array $config = [])
    {
        list($prefix, $dirname) = $this->getPrefixAndPath($dirname);

        return $this->getFilesystem($prefix)->createDir($dirname);
    }

    /**
     * Set the visibility for a file.
     *
     * @param string $path       The path to the file.
     * @param string $visibility One of 'public' or 'private'.
     *
     * @throws FileNotFoundException
     *
     * @return bool True on success, false on failure.
     */
    public function setVisibility($path, $visibility)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->setVisibility($path, $visibility);
    }

    /**
     * Create a file or update if exists.
     *
     * @param string $path     The path to the file.
     * @param string $contents The file contents.
     * @param array  $config   An optional configuration array.
     *
     * @return bool True on success, false on failure.
     */
    public function put($path, $contents, array $config = [])
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->put($path, $contents, $config);
    }

    /**
     * Create a file or update if exists.
     *
     * @param string   $path     The path to the file.
     * @param resource $resource The file handle.
     * @param array    $config   An optional configuration array.
     *
     * @throws InvalidArgumentException Thrown if $resource is not a resource.
     *
     * @return bool True on success, false on failure.
     */
    public function putStream($path, $resource, array $config = [])
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->putStream($path, $resource, $config);
    }

    /**
     * Read and delete a file.
     *
     * @param string $path The path to the file.
     *
     * @throws FileNotFoundException
     *
     * @return string|false The file contents, or false on failure.
     */
    public function readAndDelete($path)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->readAndDelete($path);
    }

    /**
     * Get a file/directory handler.
     *
     * @deprecated
     *
     * @param string  $path    The path to the file.
     * @param Handler $handler An optional existing handler to populate.
     *
     * @return Handler Either a file or directory handler.
     */
    public function get($path, Handler $handler = null)
    {
        list($prefix, $path) = $this->getPrefixAndPath($path);

        return $this->getFilesystem($prefix)->get($path);
>>>>>>> origin/New-FakeMain
    }
}
