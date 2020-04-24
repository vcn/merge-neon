# Merge-neon

Merge [NEON](https://ne-on.org/) files. 

NEON files are known for being used by [PHPStan](https://github.com/phpstan/phpstan).

## requirements

- PHP
- Composer

## installation

```
composer create-project vcn/merge-neon
```

## Usage:

```
./merge-neon [--multiline] one.neon two.neon > result.neon
```

The merge is recursive. Later values overwrite earlier ones.
