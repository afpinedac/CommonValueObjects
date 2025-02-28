<?php

namespace Test\Unit\Filesystem;

use Afpinedac\CommonValueObjects\Filesystem\File;
use InvalidArgumentException;

describe('File Value Object', function () {

    it('can create a file object without checking if it exists', function () {
        $filePath = __DIR__ . '/anyfile.txt';
        $file = File::from($filePath);

        expect((string)$file)->toBe($filePath);
    });

    it('can validate if a file exists and throws an exception if it does not', function () {
        $nonExistentFile = __DIR__ . '/nonexistentfile.txt';
        $file = File::from($nonExistentFile);

        expect(fn() => $file->validateExists())->toThrow(InvalidArgumentException::class, "The file does not exist");
    });

    it('throws an exception during validation if the path is not a file', function () {
        $directory = __DIR__;
        $file = File::from($directory);

        expect(fn() => $file->validateExists())->toThrow(InvalidArgumentException::class, "The provided path is not a file");
    });

    it('can get the basename of a file', function () {
        $filePath = __DIR__ . '/testfile.txt';
        $file = File::from($filePath);

        expect($file->getBasename())->toBe('testfile.txt');
    });

    it('can get the filename without extension', function () {
        $filePath = __DIR__ . '/testfile.txt';
        $file = File::from($filePath);

        expect($file->getFilename())->toBe('testfile');
    });

    it('can get the extension of a file', function () {
        $filePath = __DIR__ . '/testfile.txt';
        $file = File::from($filePath);

        expect($file->getExtension())->toBe('txt');
    });

    it('returns null if a file has no extension', function () {
        $filePath = __DIR__ . '/testfile';
        $file = File::from($filePath);

        expect($file->getExtension())->toBeNull();
    });

    it('can get the directory of a file', function () {
        $filePath = __DIR__ . '/testfile.txt';
        $file = File::from($filePath);

        expect($file->getDirectory())->toBe(__DIR__);
    });

    it('checks if two file objects are equal', function () {
        $filePath1 = __DIR__ . '/file1.txt';
        $filePath2 = __DIR__ . '/file1.txt';

        $file1 = File::from($filePath1);
        $file2 = File::from($filePath2);

        expect($file1->equals($file2))->toBeTrue();
    });

    it('checks if two file objects are not equal', function () {
        $filePath1 = __DIR__ . '/file1.txt';
        $filePath2 = __DIR__ . '/file2.txt';

        $file1 = File::from($filePath1);
        $file2 = File::from($filePath2);

        expect($file1->equals($file2))->toBeFalse();
    });

});