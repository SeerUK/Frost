Frost [![](https://travis-ci.org/SeerUK/Frost.svg?branch=master)](https://travis-ci.org/SeerUK/Frost)
=====

A feature toggle decision library for PHP.

Frost initially set out with the aim to help alleviate some of the issues caused by having multiple, potentially long-running streams of work. It can also be used to provide multivariate branching features (e.g. A/B(/C/D...) testing).

The main goal of this library was to make controlling feature toggling decisions structured, and make it easy to invert the control of decision making so that code doesn't know about the feature toggling process, just the end result. Parts of the library are easily extendable so that you have complete control of your feature toggling needs.

See the examples folder for different ways you can use the library.

License
-------

MIT
