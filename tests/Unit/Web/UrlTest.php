<?php

namespace Tests\Unit\Web;

use Afpinedac\CommonValueObjects\Web\Url;

describe('Url Value Object', function () {

    it('can create an instance of Url', function () {
        $url = new Url('https://example.com');
        expect($url->value)->toBe('https://example.com');
    });

    it('throws an exception for invalid URLs', function () {
        expect(fn () => new Url('invalid_url'))->toThrow(\InvalidArgumentException::class);
    });

    it('returns null for a null URL', function () {
        $url = new Url(null);

        expect($url->getDomain())->toBeNull();
        expect($url->getScheme())->toBeNull();
        expect($url->getPath())->toBeNull();
        expect($url->getQueryString())->toBeNull();
        expect($url->getFragment())->toBeNull();
        expect($url->getPort())->toBeNull();
        expect($url->getUser())->toBeNull();
        expect($url->getPassword())->toBeNull();
    });

    it('gets the scheme of a URL', function () {
        $url = new Url('https://example.com');
        expect($url->getScheme())->toBe('https');
    });

    it('gets the domain of a URL', function () {
        $url = new Url('https://sub.example.com');
        expect($url->getDomain())->toBe('sub.example.com');
    });

    it('gets the top-level domain (TLD) of a URL', function () {
        $url = new Url('https://sub.example.com');
        expect($url->getTopLevelDomain())->toBe('com');
    });

    it('gets the subdomain of a URL', function () {
        $url = new Url('https://sub.example.com');
        expect($url->getSubdomain())->toBe('sub');
    });

    it('returns null for subdomain if none exists', function () {
        $url = new Url('https://example.com');
        expect($url->getSubdomain())->toBeNull();
    });

    it('checks if URL is HTTP', function () {
        $url = new Url('http://example.com');
        expect($url->isHttp())->toBeTrue();
        expect($url->isHttps())->toBeFalse();
    });

    it('checks if URL is HTTPS', function () {
        $url = new Url('https://example.com');
        expect($url->isHttps())->toBeTrue();
        expect($url->isHttp())->toBeFalse();
    });

    it('gets the path of a URL', function () {
        $url = new Url('https://example.com/some/path');
        expect($url->getPath())->toBe('/some/path');
    });

    it('returns null for path if none exists', function () {
        $url = new Url('https://example.com');
        expect($url->getPath())->toBeNull();
    });

    it('gets the query string of a URL', function () {
        $url = new Url('https://example.com/path?key=value&other=example');
        expect($url->getQueryString())->toBe('key=value&other=example');
    });

    it('returns null for query string if none exists', function () {
        $url = new Url('https://example.com/path');
        expect($url->getQueryString())->toBeNull();
    });

    it('gets the fragment of a URL', function () {
        $url = new Url('https://example.com/path#section');
        expect($url->getFragment())->toBe('section');
    });

    it('returns null for fragment if none exists', function () {
        $url = new Url('https://example.com/path');
        expect($url->getFragment())->toBeNull();
    });

    it('gets the port of a URL', function () {
        $url = new Url('https://example.com:8080');
        expect($url->getPort())->toBe(8080);
    });

    it('returns null for port if none is specified', function () {
        $url = new Url('https://example.com');
        expect($url->getPort())->toBeNull();
    });

    it('gets the user and password from a URL', function () {
        $url = new Url('https://user:password@example.com');
        expect($url->getUser())->toBe('user');
        expect($url->getPassword())->toBe('password');
    });

    it('returns null for user and password if none exists', function () {
        $url = new Url('https://example.com');
        expect($url->getUser())->toBeNull();
        expect($url->getPassword())->toBeNull();
    });

    it('returns empty string when casting null URL to string', function () {
        $url = new Url(null);
        expect((string) $url)->toBe('');
    });

    it('returns the full URL when casting to string', function () {
        $url = new Url('https://example.com');
        expect((string) $url)->toBe('https://example.com');
    });

});