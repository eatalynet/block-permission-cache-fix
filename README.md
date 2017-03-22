# Block Permission Cache Fix - Magento Module

## Overview

Since SUPEE-6788 the block types usable in the CMS pages must be whitelisted in the admin console. Unfortunately, this patch is bugged and in certain conditions all the blocks will be blocked even if you whitelisted them.

This happens if you're using a cache that does not guarantess read after write consistency.


## Requirements

Magento EE >1.13 / CE >1.9 and patch SUPEE-6788 installed.

## Installation

### Composer

In your `composer.json`, in the section `repositories`, add this repository:

    {
        "type": "vcs",
        "url": "git@github.com:eatalynet/block-permission-cache-fix.git"
    }

Then open a terminal in the folder containing the `composer.json` and run:

    composer require eataly/block-permission-cache-fix:1.0.0

### Modman

Go in your project root folder and run

    git submodule add git@github.com:eatalynet/block-permission-cache-fix.git .modman/Eataly_BlockPermissionCacheFix
    modman deploy Eataly_BlockPermissionCacheFix

Clean the cache

### Manually

* Download latest version [here](https://github.com/eatalynet/block-permission-cache-fix/archive/1.0.0.zip)
* Unzip in Magento root folder
* Clean the cache