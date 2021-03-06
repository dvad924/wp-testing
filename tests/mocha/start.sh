#!/usr/bin/env bash

# Exit immediately if a command exits with a non-zero status.
set -e

# Define vars
HERE=$(dirname $(realpath $0))
TRAVIS_BUILD_DIR=$(realpath $HERE/../..)

# Prepare environment
cd $TRAVIS_BUILD_DIR
tests/integration-environment/create.sh
cd $TRAVIS_BUILD_DIR/tests/mocha
npm install
export PATH=$PATH:./node_modules/.bin/
export TZ="UTC"

# Reset shared cookies
rm -f /tmp/cookies.*.txt

# Run tests
mocha-casperjs --grep=deactivation --invert --timeout=360000
