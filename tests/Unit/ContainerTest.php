<?php

use Core\Container;

test('it can resolve something out of the container', function () {
    // arrange
    $container = new Container;

    $container->bind('foo', fn() => 'bar');
    // act
    $result = $container->resolve('foo');
    // aasert/expect
    expect($result)->toBe('barr');
});

test('it can resolve something out of the container2', function () {
    // arrange
    $container = new Container;

    $container->bind('foo', fn() => 'bar');
    // act
    $result = $container->resolve('foo');
    // aasert/expect
    expect($result)->toBe('barr');
});
