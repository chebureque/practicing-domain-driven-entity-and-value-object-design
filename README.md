# PHP testing playground

[![Build Status](https://travis-ci.org/matthiasnoback/practicing-domain-driven-entity-and-value-object-design.svg?branch=master)](https://travis-ci.org/matthiasnoback/practicing-domain-driven-entity-and-value-object-design)

## Option 1: Use with locally installed PHP

### Requirements

- PHP (>= 7.4)
- Composer

### Getting started

- Clone this repository and `cd` into it.
- Run `composer install --prefer-dist` to install the project's dependencies.

### Usage

- Run `./run_tests.sh` to run the tests.

## Option 2: Use with Docker

### Requirements

- [Docker Engine](https://docs.docker.com/engine/installation/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Getting started

- Make sure the `HOST_UID` and `HOST_GUID` environment variables have been defined:

    ```bash
    export HOST_GID=$(id -g)
    export HOST_UID=$(id -u)
    ```

- Clone this repository and `cd` into it.
- Run `docker-compose pull`.
- Run `bin/composer.sh install --prefer-dist` to install the project's dependencies.

### Usage

- Run `bin/composer.sh` to use Composer (e.g. `bin/composer.sh require --dev symfony/var-dumper`).
- Run `bin/run_tests.sh` to run the tests.

## Sharing patches

If you want to share your work with the group, make sure you _stage_ any file you want to share. You can do this with `git add [filename]` on the command line. Make sure to also stage renamed and deleted files that you want to share. When you're done, run:

```bash
git diff > [name-of-the-patch].patch
```

Now share this patch via email ([matthiasnoback@gmail.com](mailto:matthiasnoback@gmail.com)), Slack, or whatever.

Someone else who has push rights (the workshop leader?) should apply this patch to the latest version of the code:

```bash
git apply [name-of-the-patch].patch
```

They should then add everything, commit it, and push it to the main branch.
